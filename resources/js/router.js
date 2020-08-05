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
// import category_edit from './views/inventory/category/edit.vue'


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
            path: '/inventory/product/tree-view',
            name: 'product_index',
            component: product_index
        },
        {
            path: '/inventory/product/create',
            name: 'product_create',
            component: product_create
        },
        {
            path: '/inventory/product/edit/:id',
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
    ]
})

export default router
