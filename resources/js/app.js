import './bootstrap'
import Vue from 'vue'
import router from './router'
import Swal from 'sweetalert2'
window.Swal = Swal;


const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.Toast = Toast;

import App from './layouts/App.vue'

new Vue({
    router,
    el: '#app',
    render: h => h(App)
})
