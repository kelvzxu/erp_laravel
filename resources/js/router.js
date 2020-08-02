import Vue from 'vue'
import VueRouter from 'vue-router'

import uom_index from './views/uom/index.vue'
import uom_create from './views/uom/create.vue'
import uom_edit from './views/uom/edit.vue'

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
        }
    ]
})

export default router
