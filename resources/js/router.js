import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from './views/uom/index.vue'
import About from './views/About.vue'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/uom/tree-view',
            name: 'home',
            component: Home
        },
        {
            path: '/about',
            name: 'about',
            component: About
        }
    ]
})

export default router