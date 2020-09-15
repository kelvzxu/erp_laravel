import Vue from 'vue'
import VueRouter from 'vue-router'

// === UOM ===
import uom_index from './views/inventory/uom/index.vue'
import uom_create from './views/inventory/uom/create.vue'
import uom_edit from './views/inventory/uom/edit.vue'

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
import sales_index from './views/sales/form/index.vue'
import sales_create from './views/sales/form/create.vue'
import sales_edit from './views/sales/form/edit.vue'
import sales_view from './views/sales/form/view.vue'
import sales_analysis from './views/sales/report/graph.vue'

// === Purchases ===
import purchases_index from './views/purchases/form/index.vue'
import purchases_create from './views/purchases/form/create.vue'
import purchases_edit from './views/purchases/form/edit.vue'
import purchases_view from './views/purchases/form/view.vue'
import purchases_analysis from './views/purchases/report/graph.vue'

// === Customer ===
import customer_index from './views/contact/customer/index.vue'
import customer_create from './views/contact/customer/create.vue'
import customer_edit from './views/contact/customer/edit.vue'

// === vendor ===
import vendor_index from './views/contact/vendor/index.vue'
import vendor_create from './views/contact/vendor/create.vue'
import vendor_edit from './views/contact/vendor/edit.vue'

// === Company ===
import company_index from './views/base/company/index.vue'
import company_create from './views/base/company/create.vue'

// === Logistic ===
import logistic_dasboard from './views/logistic/dasboard.vue'
import receipt_index from './views/logistic/receipt/index.vue'
import receipt_form from './views/logistic/receipt/form.vue'
import delivery_index from './views/logistic/delivery/index.vue'
import delivery_form from './views/logistic/delivery/form.vue'

// === Employee ===
import employee_index from './views/human_resource/employee/index.vue'
import employee_create from './views/human_resource/employee/create.vue'

// === Contract ===
import contract_index from './views/human_resource/contract/index.vue'
import contract_create from './views/human_resource/contract/create.vue'

// === Department ===
import department_index from './views/human_resource/department/index.vue'
import department_create from './views/human_resource/department/create.vue'

// === Job ===
import job_index from './views/human_resource/jobs/index.vue'
import job_create from './views/human_resource/jobs/create.vue'

// === Attendance ===
import attendance from './views/attendance/checkin/index.vue'

// === General Settings ===
import general_setting from './views/base/setting/index.vue'

// === Language ===
import lang_index from './views/base/language/index.vue'
import lang_edit from './views/base/language/form.vue'

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
            path: '/sales/web/action=320&model=sale.report&view_type=graph&cids=&menu_id=213',
            name: 'sales_analysis',
            component: sales_analysis
        },
        {
            path: '/purchases/web/model=purchase.order&view_type=list&cids=&menu_id=150',
            name: 'purchases_index',
            component: purchases_index
        },
        {
            path: '/purchases/web/action=293&model=purchase.order&view_type=forms&cids=&menu_id=151',
            name: 'purchases_create',
            component: purchases_create
        },
        {
            path: '/purchases/:id/web/action=294&model=purchase.order&view_type=forms&cids=&menu_id=152',
            name: 'purchases_edit',
            component: purchases_edit
        },
        {
            path: '/purchases/:id/web/action=295&model=purchase.order&view_type=forms&cids=&menu_id=153',
            name: 'purchases_view',
            component: purchases_view
        },
        {
            path: '/purchases/web/action=310&model=purchase.report&view_type=graph&cids=&menu_id=154',
            name: 'purchases_analysis',
            component: purchases_analysis
        },
        {
            path: '/contact/web/model=res.partner&view_type=kanban,list&cids=&menu_id=170',
            name: 'customer_index',
            component: customer_index
        },
        {
            path: '/contact/web/action=292&model=res.partner&view_type=forms&cids=&menu_id=170',
            name: 'customer_create',
            component: customer_create
        },
        {
            path: '/contact/:id/web/action=292&model=res.partner&view_type=forms&cids=&menu_id=170',
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
            path: '/logistic/:id/web/action=138&model=stock.picking&type=receipt&view_type=kanban&cids=&menu_id=715',
            name: 'receipt_form',
            component: receipt_form
        },
        {
            path: '/logistic/:id/web/action=157&model=stock.picking&type=delivery&view_type=kanban&cids=&menu_id=175',
            name: 'delivery_index',
            component: delivery_index
        },
        {
            path: '/logistic/:id/web/action=148&model=stock.picking&type=delivery&view_type=form&cids=&menu_id=725',
            name: 'delivery_form',
            component: delivery_form
        },
        {
            path: '/contact/web/model=res.partner&view_type=kanban,list&cids=&menu_id=160',
            name: 'vendor_index',
            component: vendor_index
        },
        {
            path: '/contact/web/action=282&model=res.partner&view_type=forms&cids=&menu_id=161',
            name: 'vendor_create',
            component: vendor_create
        },
        {
            path: '/contact/:id/web/action=283&model=res.partner&view_type=forms&cids=&menu_id=162',
            name: 'vendor_edit',
            component: vendor_edit
        },
        {
            path: '/hr/employee/web/model=hr.employee&view_type=kanban,list&cids=&menu_id=99',
            name: 'employee_index',
            component: employee_index
        },
        {
            path: '/hr/employee/web/action=142&model=hr.employee&view_type=form&cids=&menu_id=154',
            name: 'employee_create',
            component: employee_create
        },
        {
            path: '/hr/contract/web/model=hr.contract&view_type=kanban,list&cids=&menu_id=97',
            name: 'contract_index',
            component: contract_index
        },
        {
            path: '/hr/contract/web/action=162&model=hr.contract&view_type=form&cids=&menu_id=97',
            name: 'contract_create',
            component: contract_create
        },
        {
            path: '/hr/department/web/model=hr.department&view_type=kanban,list&cids=&menu_id=98',
            name: 'department_index',
            component: department_index
        },
        {
            path: '/hr/department/web/action=147&model=hr.department&view_type=kanban,list&cids=&menu_id=98',
            name: 'department_create',
            component: department_create
        },
        {
            path: '/hr/job/web/model=hr.job&view_type=kanban,list&cids=&menu_id=96',
            name: 'job_index',
            component: job_index
        },
        {
            path: '/hr/job/web/action=136&model=hr.job&view_type=kanban,list&cids=&menu_id=96',
            name: 'job_create',
            component: job_create
        },
        {
            path: '/attendance/web/action=227&cids=1&type=checkin_checkout&menu_id=154',
            name: 'attendance',
            component: attendance
        },
        {
            path: '/language/web/action=8&model=res.lang&view_type=list&cids=1&menu_id=4',
            name: 'lang_index',
            component: lang_index
        },
        {
            path: '/language/:id/web/action=8&model=res.lang&view_type=list&cids=1&menu_id=4',
            name: 'lang_edit',
            component: lang_edit
        },
        {
            path: '/config/web/action=80&model=res.config.settings&view_type=form&cids=1&menu_id=3',
            name: 'general_setting',
            component: general_setting
        },
    ]
})

export default router
