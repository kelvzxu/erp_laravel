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
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    <a href="{{route('home')}}" id="home" class="menu-item">
                        <i class="metismenu-icon fa fa-home"></i>
                        Home
                    </a>
                </li>
                <li class="app-sidebar__heading">Sales</li>
                    <li>
                        <a href="{{ route ('invoices')}}" id="invoices" class="menu-item">
                            <i class="metismenu-icon fa fa-shopping-bag"></i>
                            Sales Order
                        </a>
                    </li>
                    <li>
                        <a href="{{ route ('customer')}}" id="customer" class="menu-item">
                            <i class="metismenu-icon fa fa-user"></i>
                            Customers
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="metismenu-icon fa fa-file-pdf-o"></i>
                            Report
                            <i class="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="" id="report_invoice" class="menu-item" >
                                    <i class="metismenu-icon"></i>
                                    Report Sales Order
                                </a>
                            </li>
                            <li>
                                <a href="{{ route ('return-invoice.index')}}" id="report-return" class="menu-item">
                                    <i class="metismenu-icon"></i>
                                    Report Return Invoice
                                </a>
                            </li>
                        </ul>
                    </li>
                </li>
                <li class="app-sidebar__heading">Purchase</li>
                    <li>
                        <a href="{{ route ('purchases')}}" id="purchases" class="menu-item">
                            <i class="metismenu-icon fa fa-shopping-basket"></i>
                            Purchase Order
                        </a>
                    </li>
                    <li>
                        <a href="{{ route ('partner')}}" id="partner" class="menu-item">
                            <i class="metismenu-icon fa fa-building "></i>
                            Vendors
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="metismenu-icon fa fa-file-pdf-o"></i>
                            Report
                            <i class="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="">
                                    <i class="metismenu-icon"></i>
                                    Purchase Order Report
                                </a>
                            </li>
                            <li>
                                <a href="{{ route ('return-po.index')}}">
                                    <i class="metismenu-icon"></i>
                                    Report Return Bill
                                </a>
                            </li>
                        </ul>
                    </li>
                <li class="app-sidebar__heading">Inventory</li>
                    <li>
                        <a href="{{route('product')}}" id="product">
                            <i class="metismenu-icon fa fa-cubes">
                            </i>Product
                        </a>
                    </li>
                    <li>
                        <a href="{{route('product-categories')}}">
                            <i class="metismenu-icon fa fa-cube">
                            </i>Product Categories
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="metismenu-icon fa fa-pencil-square-o">
                            </i>Inventory Adjustments
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="metismenu-icon fa fa-usd ">
                            </i>PriceList
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('receipt.index')}}" id="receipt">
                            <i class="metismenu-icon fa fa-truck fa-flip-horizontal">
                            </i>Receipt Product
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('Delivere.index')}}" id="Delivere">
                            <i class="metismenu-icon fa fa-truck">
                            </i>Delivere Product
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="metismenu-icon fa fa-file-pdf-o"></i>
                            Report
                            <i class="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="">
                                    <i class="metismenu-icon"></i>
                                    Product Report
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="metismenu-icon"></i>
                                    Stock Report
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="metismenu-icon"></i>
                                    PriceList Report
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="metismenu-icon"></i>
                                    Onloading Reports
                                </a>
                            </li>
                        </ul>
                    </li>
                <li class="app-sidebar__heading">Accounting</li>
                    <li>
                        <a href="#" id="payment">
                            <i class="metismenu-icon fa fa-file-text"></i>
                            Register Payments
                            <i class="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route ('CustomerDebt')}}" id="CustomerDebt">
                                    <i class="metismenu-icon ">
                                    </i>Customer Payment
                                </a>
                                <a href="{{ route ('PartnerDebt')}}" id="paybill">
                                    <i class="metismenu-icon ">
                                    </i>Vendor Payment
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" id="partner_ledger">
                            <i class="metismenu-icon fa fa-file-text"></i>
                            Partner Ledger
                            <i class="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route ('ReceivableAccount.index')}}" id="receivable">
                                    <i class="metismenu-icon"></i>
                                    Receivable Account
                                </a>
                            </li>
                            <li>
                                <a href="{{ route ('PayableAccount.index')}}" id="payable">
                                    <i class="metismenu-icon"></i>
                                    Payable Account
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
                <li class="app-sidebar__heading">Point Of Sales</li>
                    <li>
                        <a href="{{ route ('pos')}}" id="pos">
                            <i class="metismenu-icon fa fa-shopping-cart"></i>
                            POS
                        </a>
                    </li>
                <li class="app-sidebar__heading">Human Resource</li>
                    <li>
                        <a href="{{ route ('employee')}}">
                            <i class="metismenu-icon fa fa-users">
                            </i>Employee
                        </a>
                    </li>
                    <li>
                        <a href="{{ route ('recruitment')}}">
                            <i class="metismenu-icon fa fa-user-plus">
                            </i>Recruitment
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="metismenu-icon fa fa-file-text"></i>
                            System Management
                            <i class="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route ('department')}}">
                                    <i class="metismenu-icon"></i>
                                    Department
                                </a>
                            </li>
                            <li>
                                <a href="{{ route ('jobs')}}">
                                    <i class="metismenu-icon">
                                    </i>Jobs
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="metismenu-icon fa fa-calendar-times-o"></i>
                            Leave Management
                            <i class="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route ('leave')}}">
                                    <i class="metismenu-icon">
                                    </i>Leave List
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" id="payroll" class="menu-item">
                            <i class="metismenu-icon fa fa-credit-card-alt"></i>
                            Payroll Management
                            <i class="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route ('attendance')}}">
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
                    <li>
                        <a href="#">
                            <i class="metismenu-icon fa fa-file-pdf-o"></i>
                            Report
                            <i class="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="">
                                    <i class="metismenu-icon"></i>
                                    Purchase Order Report
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="metismenu-icon"></i>
                                    Purchase Return
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="metismenu-icon"></i>
                                    Supplier Report
                                </a>
                            </li>
                        </ul>
                    </li>
                </li>
            </ul>
        </div>
    </div>
</div>