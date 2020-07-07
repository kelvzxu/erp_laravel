'use strict';

const e = React.createElement;

class Menuitem_dashboard extends React.Component {
    render() {
        return (
            <li className="app-sidebar__heading">Dashboards
                <li>
                    <a href='/home' id="home" className="menu-item">
                        <i className="metismenu-icon fa fa-home"></i>
                        Home
                    </a>
                </li>
            </li>
        );
    }
}
class Menuitem_sales_manager extends React.Component {
    render() {
        return(
            <li>
                <a href="" id="sales_report">
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
        );
    }
}

class Menuitem_sales extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            error: null,
            isLoaded: false,
            items: []
        };
    }
    componentDidMount() {
        const email= document.getElementById("current_email").value;
        const url= '/api/user/Group';
        const completeurl= url+email;
        fetch(completeurl)
            .then(res => res.json())
            .then(
                (result) => {
                this.setState({
                    isLoaded: true,
                    items: result
                });
                console.log(result);
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
        const { error, isLoaded, items } = this.state;
        if (items.user_groups = 2){
            return (
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
                    <Menuitem_sales_manager />
                </li>
            );
        } else{
            return (
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
                </li>
            );
        }
    }
}


class Menu_sidebar extends React.Component {
    render() {
        return (
            <ul className="vertical-nav-menu">
                <Menuitem_dashboard />
            </ul>
        );
    }
}

class App extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            error: null,
            isLoaded: false,
            items: []
        };
    }

    componentDidMount() {
        const email= document.getElementById("current_email").value;
        const url= '/api/user/Access/';
        const completeurl= url+email;
        fetch(completeurl)
            .then(res => res.json())
            .then(
                (result) => {
                this.setState({
                    isLoaded: true,
                    items: result
                });
                console.log(result);
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
        const { error, isLoaded, items } = this.state;
        if (items.sales = true){
            return (
                <ul className="vertical-nav-menu">
                    <Menuitem_dashboard />
                    <Menuitem_sales />
                </ul>
            );
        }
    }
    // render() {
    //     const { error, isLoaded, items } = this.state;
    //     if (error) {
    //         return <div>Error: {error.message}</div>;
    //     } else if (!isLoaded) {
    //         return <div>Loading...</div>;
    //     } else {
    //         return (
    //         <ul>
    //             {/* {items.map(item => (
    //             <li key={item.nama}>
    //                 {item.nama} {item.harga}
    //             </li>
    //             ))} */}
    //         </ul>
    //         );
    //     }
    // }
}

const domContainer = document.querySelector('#sidebar_menu');
ReactDOM.render(e(App), domContainer);