var value = 0
var app = new Vue({
  el: '#sales',
  data: {
    isProcessing: false,
    form: {},
    productlist: [],
    errors: {},
  },
  created: function () {
    Vue.set(this.$data, 'form', _form,'productlist',this.fetchproducts());
  },
  methods: {
    addLine: function() {
      value += 1
      this.form.products.push({index: value,name: '', price: 0, qty: 1});
      console.log(value)
    },
    fetchproducts(){
      axios.get('/api/Products/sale').then(response => {
        this.productlist = response.data.data;
        return this.productlist;
      }).catch(error => console.error(error));
    },
    onChange(product) {
      const params ={id : product.name};
      axios.get('/api/getProduct/id',{params}).then(response => {
        this.result = response.data.data;
        console.log(this.result.price);
        this.form.products.splice(product.index,1,{
          index:product.index,
          name: product.name, 
          price: this.result.price, 
          qty: 1
        });
      }).catch(error => console.error(error));
      console.log(product)
    },
    remove: function(product) {
      this.form.products.$remove(product);
    },
    create: function() {
      this.isProcessing = true;
      this.$http.post('/Sales', this.form)
        .then(function (response) {
          if(response.data.created != "error") {
            window.location = '/Sales';
          } else {
            this.isProcessing = false;
          }
        })
        .catch(function(response) {
          this.isProcessing = false;
          Vue.set(this.$data, 'errors', response.data);
        })
    },
    update: function() {
      this.isProcessing = true;
      this.$http.put('/Sales/update/' + this.form.id, this.form)
        .then(function(response) {
          if(response.data.updated != "error") {
            window.location = '/Sales/';
          } else {
            this.isProcessing = false;
          }
        })
        .catch(function(response) {
          this.isProcessing = false;
          Vue.set(this.$data, 'errors', response.data);
        })
    }
  },

  computed: {
    subTotal: function() {
      return this.form.products.reduce(function(carry, product) {
        return carry + (parseFloat(product.qty) * parseFloat(product.price));
      }, 0);
    },
    grandTotal: function() {
      return this.subTotal - parseFloat(this.form.discount);
    }
  }
})