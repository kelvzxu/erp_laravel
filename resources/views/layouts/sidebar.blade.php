<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                    data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button"
                class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu mb-6">
                <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    <a href="{{route('home')}}" id="home" class="menu-item">
                        <i class="metismenu-icon fa fa-home"></i>
                        Home
                    </a>
                </li>
                <li class="app-sidebar__heading">Attendances</li>
                <li>
                    <a href="/attendance/web/action=227&cids=1&type=checkin_checkout&menu_id=154">
                        <i class="metismenu-icon fa fa-clock-o"></i>
                        Check In/ Check Out
                    </a>
                </li>
                @if (AccessRight::access()->sales == true)
                <li class="app-sidebar__heading">Sales</li>
                    <li>
                        <a href="/sales/web/model=sale.order&view_type=list&cids=&menu_id=160" id="sales_orders" class="menu-item">
                            <i class="metismenu-icon fa fa-shopping-bag"></i>
                            Sales Order
                        </a>
                    </li>
                    <li>
                        <a href="/contact/web/model=res.partner&view_type=kanban,list&cids=&menu_id=170" id="customer" class="menu-item">
                            <i class="metismenu-icon fa fa-user"></i>
                            Customers
                        </a>
                    </li>
                    @if(UserGroup::group() == 2) 
                    <li>
                        <a href="" id="sales_report">
                            <i class="metismenu-icon fa fa-line-chart "></i>
                            Report
                            <i class="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="/sales/web/action=320&model=sale.report&view_type=graph&cids=&menu_id=213" >
                                    <i class="metismenu-icon"></i>
                                    Sales Analysis
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                @endif
                @if (AccessRight::access()->purchase == true) 
                <li class="app-sidebar__heading">Purchase</li>
                    <li>
                        <a href="/purchases/web/model=purchase.order&view_type=list&cids=&menu_id=150" id="purchases_orders" class="menu-item">
                            <i class="metismenu-icon fa fa-shopping-basket"></i>
                            Purchase Order
                        </a>
                    </li>
                    <li>
                        <a href="/contact/web/model=res.partner&view_type=kanban,list&cids=&menu_id=160" id="partner" class="menu-item">
                            <i class="metismenu-icon fa fa-building "></i>
                            Vendors
                        </a>
                    </li>
                    @if(UserGroup::group() == 2)
                    <li>
                        <a href="#" id="purchase_report">
                            <i class="metismenu-icon fa fa-line-chart "></i>
                            Report
                            <i class="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="/purchases/web/action=310&model=purchase.report&view_type=graph&cids=&menu_id=154">
                                    <i class="metismenu-icon"></i>
                                    Purchase Order Report
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                @endif
                @if (AccessRight::access()->inventory == True ) 
                <li class="app-sidebar__heading">Inventory</li>
                    <li>
                        <a href="/inventory/product/web/model=product.template&view_type=kanban,list&cids=&menu_id=159" id="product">
                            <i class="metismenu-icon fa fa-cubes">
                            </i>Product
                        </a>
                    </li>
                    <li>
                        <a href="/inventory/category/tree-view">
                            <i class="metismenu-icon fa fa-cube">
                            </i>Product Categories
                        </a>
                    </li>
                    <li>
                        <a href="" class="development">
                            <i class="metismenu-icon fa fa-pencil-square-o">
                            </i>Inventory Adjustments
                        </a>
                    </li>
                    <li>
                        <a href="/logistic/web/action=109&model=stock.picking.type&view_type=kanban&cids=&menu_id=137" id="receipt">
                            <i class="metismenu-icon fa fa-truck fa-flip-horizontal">
                            </i>Logistics
                        </a>
                    </li>
                    @if(UserGroup::group() == 2)
                    <li>
                        <a href="#" id="inventory_report">
                            <i class="metismenu-icon fa fa-file-pdf-o"></i>
                            Report
                            <i class="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="{{route('inventory.valuation')}}" id="inventory_valuation"> 
                                    <i class="metismenu-icon"></i>
                                    Inventory Valuation
                                </a>
                            </li>
                            <li>
                                <a href="{{route('inventory.move')}}" id="inventory_move"> 
                                    <i class="metismenu-icon"></i>
                                    Product Move
                                </a>
                            </li>
                            <li>
                                <a href="{{route('report.productlist')}}">
                                    <i class="metismenu-icon"></i>
                                    Product Report
                                </a>
                            </li>
                            <li>
                                <a href="{{route('report.productstock')}}">
                                    <i class="metismenu-icon"></i>
                                    Stock Report
                                </a>
                            </li>
                            <li>
                                <a href="" class="development">
                                    <i class="metismenu-icon"></i>
                                    PriceList Report
                                </a>
                            </li>
                            <li>
                                <a href="" class="development">
                                    <i class="metismenu-icon"></i>
                                    Onloading Reports
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" id="account-config">
                            <i class="metismenu-icon fa fa-cogs"></i>
                            Configuration
                            <i class="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="/uom/tree-view">
                                    <i class="metismenu-icon"></i> 
                                    Unit of Measure
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="/inventory/warehouse/tree-view">
                                    <i class="metismenu-icon"></i> 
                                    Warehouse
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                @endif
                @if (AccessRight::access()->accounting == True ) 
                <li class="app-sidebar__heading">Accounting</li>
                    <li>
                        <a href="#" id="invoicing">
                            <i class="metismenu-icon fa fa-pencil-square-o"></i>
                            Invoicing
                            <i class="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route ('invoices')}}" id="invoices" class="menu-item">
                                    <i class="metismenu-icon fa fa-pencil-square-o">
                                    </i>Invoices
                                </a>
                            </li>
                            <li>
                                <a href="{{ route ('purchases')}}" id="purchases" class="menu-item">
                                    <i class="metismenu-icon fa fa-pencil-square-o">
                                    </i>Bills
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" id="register_payment">
                            <i class="metismenu-icon fa fa-file-text"></i>
                            Register Payments
                            <i class="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route ('payment_invoices.index')}}" id="customerpayment">
                                    <i class="metismenu-icon ">
                                    </i>Customer Payment
                                </a>
                                <a href="{{ route ('payment_bills.index')}}" id="paybill">
                                    <i class="metismenu-icon ">
                                    </i>Vendor Payment
                                </a>
                            </li>
                        </ul>
                    </li>
                    @if(UserGroup::group() == 2)
                    <li>
                        <a href="#" id="accounting_reports">
                            <i class="metismenu-icon fa fa-file-pdf-o"></i>
                            Report
                            <i class="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route ('invoices.report')}}" id="report_invoice_accounting" class="menu-item" >
                                    <i class="metismenu-icon"></i>
                                    Invoices Report
                                </a>
                            </li>
                            <li>
                                <a href="{{ route ('purchases.report')}}" id="report_purchases" class="menu-item">
                                    <i class="metismenu-icon"></i>
                                    Bills Report
                                </a>
                            </li>
                            <li>
                                <a href="{{ route ('accounting.general_ledger')}}" id="general_ledger" class="menu-item">
                                    <i class="metismenu-icon"></i>
                                    General Ledger
                                </a>
                            </li>
                            <li> 
                                <a class="menu-item" data-toggle="modal" data-target="#exampleModal">
                                    <i class="metismenu-icon"></i>
                                    partner Ledger
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" id="account-config">
                            <i class="metismenu-icon fa fa-cogs"></i>
                            Configuration
                            <i class="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route ('journal.index')}}" id="journal">
                                    <i class="metismenu-icon"></i> 
                                    Journal
                                </a>
                            </li>
                            <li>
                                <a href="{{ route ('account.index')}}" id="account-account">
                                    <i class="metismenu-icon"></i>
                                    Chart Of Accounts
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                @endif
                @if (AccessRight::access()->point_of_sale == True ) 
                <li class="app-sidebar__heading">Point Of Sales</li>
                    <li>
                        <a href="{{ route ('pos')}}" id="pos">
                            <i class="metismenu-icon fa fa-shopping-cart"></i>
                            POS
                        </a>
                    </li>
                @endif
                @if (AccessRight::access()->human_resources == True ) 
                <li class="app-sidebar__heading">Human Resource</li>
                    <li>
                        <a href="/hr/employee/web/model=hr.employee&view_type=kanban,list&cids=&menu_id=99">
                            <i class="metismenu-icon fa fa-users">
                            </i>Employee
                        </a>
                    </li>
                    <li>
                        <a href="/hr/contract/web/model=hr.contract&view_type=kanban,list&cids=&menu_id=97">
                            <i class="metismenu-icon fa fa-book">
                            </i>Contracts
                        </a>
                    </li>
                    <li class="o_invisible_modifier">
                        <a href="#" id="leave-mgmt">
                            <i class="metismenu-icon fa fa-calendar-times-o"></i>
                            Leave Management
                            <i class="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route ('leave')}}" id="leave">
                                    <i class="metismenu-icon">
                                    </i>Leave List
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="o_invisible_modifier">
                        <a href="#" id="payroll" class="menu-item">
                            <i class="metismenu-icon fa fa-credit-card-alt"></i>
                            Payroll Management
                            <i class="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route ('attendance')}} " id="attendance">
                                    <i class="metismenu-icon">
                                    </i>Attendance Log
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="{{ route ('payslip')}}" id="payslip" class="menu-item">
                                    <i class="metismenu-icon">
                                    </i>Employee PaySlip
                                </a>
                            </li>
                        </ul>
                    </li>
                    @if(UserGroup::group() == 2)
                    <li>
                        <a href="#" id="hr-management">
                            <i class="metismenu-icon fa fa-cogs"></i>
                            Configuration
                            <i class="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="/hr/department/web/model=hr.department&view_type=kanban,list&cids=&menu_id=98">
                                    <i class="metismenu-icon"></i>
                                    Departments
                                </a>
                            </li>
                            <li>
                                <a href="/hr/job/web/model=hr.job&view_type=kanban,list&cids=&menu_id=96">
                                    <i class="metismenu-icon">
                                    </i>Job Positions
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                @endif
                @if (AccessRight::access()->administration == True ) 
                <li class="app-sidebar__heading">Apps
                    <li>
                        <a href="{{ route ('Apps.index')}}" id="apps" class="menu-item">
                            <i class="metismenu-icon fa fa-download"></i>
                            Apps
                        </a>
                    </li>
                </li>
                <li class="app-sidebar__heading">Settings
                    <!-- <li>
                        <a href="#" id="setting">
                            <i class="metismenu-icon fa fa-users"></i>
                            Manage Users
                            <i class="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route ('internaluser.index')}}" id="internaluser">
                                    <i class="metismenu-icon">
                                    </i>Internal User
                                </a>
                            </li>
                            <li>
                                <a href="{{ route ('portal.index')}}" id="portal">
                                    <i class="metismenu-icon">
                                    </i>Portal
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/setting/company/web/model=res.company&view_type=list&cids=&menu_id=294" id="companies">
                            <i class="metismenu-icon fa fa-building">
                            </i>Manage Companies
                        </a>
                    </li> -->
                    <li>
                        <a href="/config/web/action=80&model=res.config.settings&view_type=form&cids=1&menu_id=3">
                            <i class="metismenu-icon fa fa-cogs">
                            </i>General Settings
                        </a>
                    </li>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>