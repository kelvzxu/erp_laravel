'use strict';

const e = React.createElement;

class App extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            error: null,
            isLoaded: false,
            sales: [],purchase: [],accounting: [],
            inventory: [], POS: [], Manufacture: [],
            group: [],human_resource : [],administration: [],
            developers: [],
        };
    }
    componentDidMount() {
        const email= document.getElementById("current_email").value;
        const url= '/api/user/Access/';
        const group_url= '/api/user/Group/';
        const getGroup= group_url+email;
        const completeurl= url+email;
        fetch(completeurl)
            .then(res => res.json())
            .then(
                (result) => {
                this.setState({
                    isLoaded: true,
                    sales: result.data.sales,
                    purchase : result.data.purchase,
                    inventory : result.data.inventory,
                    accounting : result.data.accounting,
                    manufacture : result.data.manufacture,
                    human_resource  : result.data.human_resources,
                    administration : result.data.administration,
                    pos : result.data.point_of_sale,
                    developer : result.data.developer,
                });
                },
                // Catatan: sangatlah penting untuk mengatasi error disini
                // daripada menggunakan blok catch() sehingga kita tidak menenggelamkan
                // exception dari bug yang sebenarnya terjadi di komponen
                (error) => {
                this.setState({
                    isLoaded: true,
                    error
                });
            }
        )
        fetch(getGroup)
            .then(res => res.json())
            .then(
                (result) => {
                this.setState({
                    isLoaded: true,
                    group: result.user_groups
                });
                },
                // Catatan: sangatlah penting untuk mengatasi error disini
                // daripada menggunakan blok catch() sehingga kita tidak menenggelamkan
                // exception dari bug yang sebenarnya terjadi di komponen
                (error) => {
                this.setState({
                    isLoaded: true,
                    error
                });
            }
        )
    }

    render() {
        let { error, isLoaded, sales, purchase, accounting, inventory, developer,
            pos, group, manufacture, human_resource, administration} = this.state;
        return (
            <ul className="vertical-nav-menu">
                <li className="app-sidebar__heading">Dashboards
                    <li>
                        <a href='/home' id="home" className="menu-item">
                            <i className="metismenu-icon fa fa-home"></i>
                            Home
                        </a>
                    </li>
                </li>
                {sales ?
                    <li className="app-sidebar__heading">Sales
                        <li>
                            <a href='/Sales' id="sales_orders" className="menu-item">
                                <i className="metismenu-icon fa fa-shopping-bag"></i>
                                Sales Order
                            </a>
                        </li>
                        <li>
                            <a href='/customer' id="customer" className="menu-item">
                                <i className="metismenu-icon fa fa-user"></i>
                                Customers
                            </a>
                        </li>
                        { group = 2 &&
                            <li>
                                <a href="#" id="sales_report">
                                    <i className="metismenu-icon fa fa-file-pdf-o"></i>
                                    Report
                                    <i className="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href='/Sales/Report' id="report_invoice" className="menu-item" >
                                            <i className="metismenu-icon"></i>
                                            Report Sales Order
                                        </a>
                                    </li>
                                    <li>
                                        <a href='/Report/Return/SalesOrder' id="report-return_inv" className="menu-item">
                                            <i className="metismenu-icon"></i>
                                            Report Return Invoice
                                        </a>
                                    </li>
                                    <li>
                                        <a href='/CustomerDebt/report' id="report-return" className="menu-item">
                                            <i className="metismenu-icon"></i>
                                            Report customer debt
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        }
                    </li>
                    : <li></li>
                }
                {purchase ?
                    <li className="app-sidebar__heading">Purchase
                        <li>
                            <a href='/purchases' id="purchases_orders" className="menu-item">
                                <i className="metismenu-icon fa fa-shopping-basket"></i>
                                Purchase Order
                            </a>
                        </li>
                        <li>
                            <a href='/partner' id="partner" className="menu-item">
                                <i className="metismenu-icon fa fa-building "></i>
                                Vendors
                            </a>
                        </li>
                        {group = 2 &&
                            <li>
                                <a href="#" id="purchase_report">
                                    <i className="metismenu-icon fa fa-file-pdf-o"></i>
                                    Report
                                    <i className="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href='/purchases/Report' id="report_po" className="menu-item">
                                            <i className="metismenu-icon"></i>
                                            Purchase Order Report
                                        </a>
                                    </li>
                                    <li>
                                        <a href='/Report/Return/Purchase/' id="report-return_po">
                                            <i className="metismenu-icon"></i>
                                            Report Return Bill
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        }
                    </li>
                    : <li></li>
                }
                {accounting ?
                    <li className="app-sidebar__heading">Accounting
                        <li>
                            <a href="#" id="invoicing">
                                <i className="metismenu-icon fa fa-pencil-square-o"></i>
                                Invoicing
                                <i className="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                            </a>
                            <ul>
                                <li>
                                    <a href='/invoices' id="invoices" className="menu-item">
                                        <i className="metismenu-icon fa fa-pencil-square-o">
                                        </i>Invoices
                                    </a>
                                </li>
                                <li>
                                    <a href="/VendorBills" id="purchases" className="menu-item">
                                        <i className="metismenu-icon fa fa-pencil-square-o">
                                        </i>Bills
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" id="register_payment">
                                <i className="metismenu-icon fa fa-file-text"></i>
                                Register Payments
                                <i className="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                            </a>
                            <ul>
                                <li>
                                    <a href='/Payments/Invoices' id="customerpayment">
                                        <i className="metismenu-icon ">
                                        </i>Customer Payment
                                    </a>
                                    <a href='/Payments/Bills' id="paybill">
                                        <i className="metismenu-icon ">
                                        </i>Vendor Payment
                                    </a>
                                </li>
                            </ul>
                        </li>
                        { group = 2 &&
                        <div>
                            <li>
                                <a href="#" id="accounting_reports">
                                    <i className="metismenu-icon fa fa-file-pdf-o"></i>
                                    Report
                                    <i className="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href='/Reports/invoices' id="report_invoice_accounting" className="menu-item" >
                                            <i className="metismenu-icon"></i>
                                            Invoices Report
                                        </a>
                                    </li>
                                    <li>
                                        <a href='/Reports/VendorBills' id="report_purchases" className="menu-item">
                                            <i className="metismenu-icon"></i>
                                            Bills Report
                                        </a>
                                    </li>
                                    <li>
                                        <a href='/Accounting/Report/General_Ledger' id="general_ledger" className="menu-item">
                                            <i className="metismenu-icon"></i>
                                            General Ledger
                                        </a>
                                    </li>
                                    <li> 
                                        <a className="menu-item text-gray" data-toggle="modal" data-target="#exampleModal">
                                            <i className="metismenu-icon"></i>
                                            partner Ledger
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" id="account-config">
                                    <i className="metismenu-icon fa fa-cogs"></i>
                                    Configuration
                                    <i className="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href='/Account/Journal' id="journal">
                                            <i className="metismenu-icon"></i> 
                                            Journal
                                        </a>
                                    </li>
                                    <li>
                                        <a href='/Account' id="account-account">
                                            <i className="metismenu-icon"></i>
                                            Chart Of Accounts
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </div>
                        }
                    </li>
                    : <li></li>
                }
                {inventory ?
                    <li className="app-sidebar__heading">Inventory
                        <li>
                            <a href='/product' id="product">
                                <i className="metismenu-icon fa fa-cubes">
                                </i>Product
                            </a>
                        </li>
                        <li>
                            <a href='/product-categories'>
                                <i className="metismenu-icon fa fa-cube">
                                </i>Product Categories
                            </a>
                        </li>
                        <li>
                            <a href='/receipt' id="receipt">
                                <i className="metismenu-icon fa fa-truck fa-flip-horizontal">
                                </i>Receipt Product
                            </a>
                        </li>
                        <li>
                            <a href='/Delivere' id="Delivere">
                                <i className="metismenu-icon fa fa-truck">
                                </i>Delivere Product
                            </a>
                        </li>
                        { group = 2 && 
                            <li>
                                <a href="#" id="inventory_report">
                                    <i className="metismenu-icon fa fa-file-pdf-o"></i>
                                    Report
                                    <i className="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href='/Inventory/report/valuation' id="inventory_valuation"> 
                                            <i className="metismenu-icon"></i>
                                            Inventory Valuation
                                        </a>
                                    </li>
                                    <li>
                                        <a href='/Inventory/report/Move' id="inventory_move"> 
                                            <i className="metismenu-icon"></i>
                                            Product Move
                                        </a>
                                    </li>
                                    <li>
                                        <a href='/product/Report/productlist'>
                                            <i className="metismenu-icon"></i>
                                            Product Report
                                        </a>
                                    </li>
                                    <li>
                                        <a href='/product/Report/Stock'>
                                            <i className="metismenu-icon"></i>
                                            Stock Report
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        }
                    </li>
                    : <li></li>
                }
                {developer ?
                    <li className="app-sidebar__heading">Manufacture
                        <li>
                            <a href="#" id="register_payment">
                                <i className="metismenu-icon fa fa-file-text"></i>
                                Operations
                                <i className="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                            </a>
                            <ul>
                                <li>
                                    <a href='/Payments/Invoices' id="customerpayment">
                                        <i className="metismenu-icon ">
                                        </i>Manufacture Orders
                                    </a>
                                    <a href='/Payments/Bills' id="paybill">
                                        <i className="metismenu-icon ">
                                        </i>Work Orders
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" id="register_payment">
                                <i className="metismenu-icon fa fa-file-text"></i>
                                Master Data
                                <i className="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                            </a>
                            <ul>
                                <li>
                                    <a href='/Payments/Invoices' id="customerpayment">
                                        <i className="metismenu-icon ">
                                        </i>Product
                                    </a>
                                    <a href='/Payments/Bills' id="paybill">
                                        <i className="metismenu-icon ">
                                        </i>Bill Of Material
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </li>
                    : <li></li>
                }
                {pos ?
                    <li className="app-sidebar__heading">Point Of Sales
                        <li>
                            <a href='/PointOfSale' id="pos">
                                <i className="metismenu-icon fa fa-shopping-cart"></i>
                                Point Of Sale
                            </a>
                        </li>
                    </li>
                    : <li></li>
                }
                {human_resource ?
                    <li className="app-sidebar__heading">Human Resource
                        <li>
                            <a href='/employee' id="employee">
                                <i className="metismenu-icon fa fa-users">
                                </i>Employee
                            </a>
                        </li>
                        <li>
                            <a href='/recruitment' className="development">
                                <i className="metismenu-icon fa fa-user-plus">
                                </i>Recruitment
                            </a>
                        </li>
                        <li>
                            <a href="#" id="leave-mgmt">
                                <i className="metismenu-icon fa fa-calendar-times-o"></i>
                                Leave Management
                                <i className="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                            </a>
                            <ul>
                                <li>
                                    <a href='/leave' id="leave">
                                        <i className="metismenu-icon">
                                        </i>Leave List
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" id="payroll" className="menu-item">
                                <i className="metismenu-icon fa fa-credit-card-alt"></i>
                                Payroll Management
                                <i className="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                            </a>
                            <ul>
                                <li>
                                    <a href='/attendance' id="attendance">
                                        <i className="metismenu-icon">
                                        </i>Attendance Log
                                    </a>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <a href='/payslip' id="payslip" className="menu-item">
                                        <i className="metismenu-icon">
                                        </i>Employee PaySlip
                                    </a>
                                </li>
                            </ul>
                        </li>
                        { group = 2 && 
                            <li>
                                <a href="#" id="hr-management">
                                    <i className="metismenu-icon fa fa-file-text"></i>
                                    System Management
                                    <i className="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href='/department' id="department">
                                            <i className="metismenu-icon"></i>
                                            Department
                                        </a>
                                    </li>
                                    <li>
                                        <a href='/jobs' id="jobs">
                                            <i className="metismenu-icon">
                                            </i>Jobs
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        }
                    </li>
                    : <li></li>
                }
                { administration ?
                    <li className="app-sidebar__heading">Apps
                        <li>
                            <a href='/Apps' id="home" className="menu-item">
                                <i className="metismenu-icon fa fa-download"></i>
                                Apps
                            </a>
                        </li>
                    </li>
                    : <li></li>
                }
                { administration ?
                    <li className="app-sidebar__heading mb-6">Settings
                        <li>
                            <a href='/Companies' id="companies">
                                <i className="metismenu-icon fa fa-building">
                                </i>Manage Companies
                            </a>
                        </li>
                        <li>
                            <a href="#" id="setting">
                                <i className="metismenu-icon fa fa-users"></i>
                                Manage Users
                                <i className="metismenu-state-icon fa fa-angle-double-down caret-left"></i>
                            </a>
                            <ul>
                                <li>
                                    <a href='/User/InternalUser' id="internaluser">
                                        <i className="metismenu-icon">
                                        </i>Internal User
                                    </a>
                                </li>
                                <li>
                                    <a href='/User/Portal' id="portal">
                                        <i className="metismenu-icon">
                                        </i>Portal
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </li>
                    : <li></li>
                }
            </ul>
        );
    }
}

// const domContainer = document.querySelector('#sidebar_menu');
// ReactDOM.render(e(App), domContainer);