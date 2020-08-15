import Vue from 'vue'
import VueRouter from 'vue-router'

// === UOM ===
import uom_index from './views/uom/index.vue'
import uom_create from './views/uom/create.vue'
import uom_edit from './views/uom/edit.vue'

// === Inventory Products ===
import product_index from './views/inventory/product/index.vue'
import product_create from './views/inventory/product/create.vue'
import product_edit from './views/inventory/product/edit.vue'

// === Inventory Categories ===
import category_index from './views/inventory/category/index.vue'
import category_create from './views/inventory/category/create.vue'
import category_edit from './views/inventory/category/edit.vue'

// === Inventory Categories ===
import warehouse_index from './views/inventory/warehouse/index.vue'
import warehouse_create from './views/inventory/warehouse/create.vue'
import warehouse_edit from './views/inventory/warehouse/edit.vue'

// === Sales ===
import sales_index from './views/sales/index.vue'
import sales_create from './views/sales/create.vue'
import sales_edit from './views/sales/edit.vue'
import sales_view from './views/sales/view.vue'

// === Customer ===
import customer_index from './views/contact/customer/index.vue'
import customer_create from './views/contact/customer/create.vue'
import customer_edit from './views/contact/customer/edit.vue'

// === Company ===
import company_index from './views/base/company/index.vue'
import company_create from './views/base/company/create.vue'

// === Logistic ===
import logistic_dasboard from './views/logistic/dasboard.vue'
import receipt_index from './views/logistic/receipt/index.vue'
import receipt_edit from './views/logistic/receipt/form.vue'
import delivery_index from './views/logistic/delivery/index.vue'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/uom/tree-view',
            name: 'uom_index',
            component: uom_index
        },
        {
            path: '/uom/create',
            name: 'uom_create',
            component: uom_create
        },
        {
            path: '/uom/edit/:id',
            name: 'uom_edit',
            component: uom_edit
        },
        {
            path: '/inventory/product/web/model=product.template&view_type=kanban,list&cids=&menu_id=159',
            name: 'product_index',
            component: product_index
        },
        {
            path: '/inventory/product/web/action=392&model=product.template&view_type=kanban,list&cids=&menu_id=159',
            name: 'product_create',
            component: product_create
        },
        {
            path: '/inventory/product/:id/web/action=394&model=product.template&view_type=kanban,list&cids=&menu_id=159',
            name: 'product_edit',
            component: product_edit
        },
        {
            path: '/inventory/category/tree-view',
            name: 'category_index',
            component: category_index
        },
        {
            path: '/inventory/category/create',
            name: 'category_create',
            component: category_create
        },
        {
            path: '/inventory/category/edit/:id',
            name: 'category_edit',
            component: category_edit
        },
        {
            path: '/inventory/warehouse/tree-view',
            name: 'warehouse_index',
            component: warehouse_index
        },
        {
            path: '/inventory/warehouse/create',
            name: 'warehouse_create',
            component: warehouse_create
        },
        {
            path: '/inventory/warehouse/edit/:id',
            name: 'warehouse_edit',
            component: warehouse_edit
        },
        {
            path: '/sales/web/model=sale.order&view_type=list&cids=&menu_id=160',
            name: 'sales_index',
            component: sales_index
        },
        {
            path: '/sales/web/action=292&model=sale.order&view_type=forms&cids=&menu_id=160',
            name: 'sales_create',
            component: sales_create
        },
        {
            path: '/sales/:id/web/action=273&model=sale.order&view_type=forms&cids=&menu_id=160',
            name: 'sales_edit',
            component: sales_edit
        },
        {
            path: '/sales/:id/web/action=249&model=sale.order&view_type=forms&cids=&menu_id=160',
            name: 'sales_view',
            component: sales_view
        },
        {
            path: '/contact/customer/web/model=res.partner&view_type=kanban,list&cids=&menu_id=170',
            name: 'customer_index',
            component: customer_index
        },
        {
            path: '/contact/customer/web/action=292&model=res.partner&view_type=forms&cids=&menu_id=170',
            name: 'customer_create',
            component: customer_create
        },
        {
            path: '/contact/customer/:id/web/action=292&model=res.partner&view_type=forms&cids=&menu_id=170',
            name: 'customer_edit',
            component: customer_edit
        },
        {
            path: '/setting/company/web/model=res.company&view_type=list&cids=&menu_id=294',
            name: 'company_index',
            component: company_index
        },
        {
            path: '/setting/company/web/action=861&model=res.company&view_type=list&cids=&menu_id=415',
            name: 'company_create',
            component: company_create
        },
        {
            path: '/logistic/web/action=109&model=stock.picking.type&view_type=kanban&cids=&menu_id=137',
            name: 'logistic_dasboard',
            component: logistic_dasboard
        },
        {
            path: '/logistic/:id/web/action=168&model=stock.picking&type=receipt&view_type=kanban&cids=&menu_id=197',
            name: 'receipt_index',
            component: receipt_index
        },
        {
            path: '/logistic/:id/web/action=168&model=stock.picking&type=receipt&view_type=kanban&cids=&menu_id=715',
            name: 'receipt_edit',
            component: receipt_edit
        },
        {
            path: '/logistic/:id/web/action=157&model=stock.picking&type=delivery&view_type=kanban&cids=&menu_id=175',
            name: 'delivery_index',
            component: delivery_index
        },

    ]
})

export default router
