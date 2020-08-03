import Vue from 'vue'
import VueRouter from 'vue-router'

// === UOM ===
import uom_index from './views/uom/index.vue'
import uom_create from './views/uom/create.vue'
import uom_edit from './views/uom/edit.vue'

// === Inventory ===
import product_index from './views/inventory/product/index.vue'

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
    ]
})

export default router
