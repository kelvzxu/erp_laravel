
Vue.filter('currency', function (money) {
    return accounting.formatMoney(money, "Rp ", 2, ".", ",")
})
new Vue({
    el: '#pos',
    data: {
        product: {
            id: '',
            qty: '',
            price: '',
            name: '',
            photo: '',
            barcode:''
        }
    },
})