var app = new Vue({
  el: '#purchase',
  data: {
    isProcessing: false,
    form: {},
    errors: {}
  },
  created: function () {
    Vue.set(this.$data, 'form', _form);
  },
  methods: {
    addLine: function() {
      this.form.products.push({name: '', price: 0, qty: 1});
    },
    remove: function(product) {
      this.form.products.$remove(product);
    },
    create: function() {
      this.isProcessing = true;
      this.$http.post('/VendorBills', this.form)
        .then(function (response) {
          if(response.data.created != "error") {
            window.location = '/VendorBills';
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
      this.$http.put('/VendorBills/update/' + this.form.id, this.form)
        .then(function(response) {
          if(response.data.updated != "error") {
            window.location = '/VendorBills/';
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