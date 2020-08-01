let columns;
var app = new Vue({
    el: '#sales',
    data: {
        isProcessing: false,
        length: 3,
        form: {},
        search: '',
        SalesOrder: [],
        errors: {},
        sortOrders : {},
        sortKey: '',
        columns: [{
                label: 'Reference',
                name: 'order_no'
            },
            {
                label: 'Customer',
                name: 'partner'
            },
            {
                label: 'Order Date',
                name: 'order_date'
            },
            {
                label: 'Sales Representative',
                name: 'sales_person'
            },
            {
                label: 'Total',
                name: 'grand_total'
            },
            {
                label: 'Status',
                name: 'status'
            },
            {
                label: 'Created At',
                name: 'created_at'
            },
        ],
        pagination: {
            currentPage: 1,
            total: '0',
            nextPage: '',
            prevPage: '',
            from: '0',
            to: '0'
        },

    },
    created: function () {
        for (var index in this.columns) {
            key = this.columns[index].name;
            this.sortOrders[key] = -1;
        }
        Vue.filter(
            "formatNumber",
            function (value) {
                return numeral(value).format("0,0"); // displaying other groupings/separators is possible, look at the docs
            },
        );
        Vue.set(
            this.$data,
            'SalesOrder', this.fetchSalesOrder(),
            'columns', this.$data.columns,
            'pagination', this.$data.pagination,
            'length', this.$data, length,
            'sortOrders',this.$data.sortOrders,
        );
    },
    methods: {
        moment: function (date) {
            return moment(date);
        },

        show: function (SalesOrder) {
            const params = SalesOrder.id;
            const url = '/Sales/show/' + params;
            window.location = url;
        },

        paginate(array, length, pageNumber) {
            this.pagination.from = array.length ? ((pageNumber - 1) * length) + 1 : ' ';
            this.pagination.to = pageNumber * length > array.length ? array.length : pageNumber * length;
            this.pagination.prevPage = pageNumber > 1 ? pageNumber : '';
            this.pagination.nextPage = array.length > this.pagination.to ? pageNumber + 1 : '';
            return array.slice((pageNumber - 1) * length, pageNumber * length);
        },

        resetPagination() {
            this.pagination.currentPage = 1;
            this.pagination.prevPage = '';
            this.pagination.nextPage = '';
        },

        sortBy: function(key) {
            
            this.resetPagination();
            this.sortKey = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
        },

        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },

        fetchSalesOrder() {
            axios.get('/api/sale/list').then(response => {
                this.SalesOrder = response.data.data;
                this.pagination.total = this.SalesOrder.length;
            }).catch(error => console.error(error));
        },
    },
    filters: {
        moment: function (date) {
            return moment(date).fromNow();
        }
    },
    computed: {
        filteredSales() {
            let sale = this.SalesOrder;
            if (this.search) {
                console.log('search');
                sale = sale.filter((row) => {
                    return Object.keys(row).some((key) => {
                        return String(row[key]).toLowerCase().indexOf(this.search.toLowerCase()) > -1;
                    })
                });
            }
            let sortKey = this.sortKey 
            let order = this.sortOrders[sortKey] || 1;
            if (sortKey) {
                sale = sale.slice().sort(function(a, b) {
                    a = String(a[sortKey]).toLowerCase();
                    console.log(a)
                    b = String(b[sortKey]).toLowerCase();
                    console.log(b)
                    return (a === b ? 0 : a > b ? 1 : -1) * order;
                });
            }
            return sale
        },
        paginatedSales() {
            return this.paginate(this.filteredSales, this.length, this.pagination.currentPage);
        }
    }
})
$('a#sales_orders').addClass('mm-active');

if ($("#client_id").val() !== undefined) {
    $.ajax({
        url: "/api/customer/search",
        type: 'post',
        dataType: 'json',
        data: {
            'id': $("#client_id").val()
        },
        success: function (result) {
            $("#client").html(result.data.name);
            $("#client").val(result.data.name);
        }
    })
}
