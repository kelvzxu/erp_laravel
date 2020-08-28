<!doctype html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <link rel="icon" href="{{ asset('images/icons/icon.png') }}" type="image/png">
    
    <title>@yield('title')</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <link href="{{asset('css/admin.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/base.css') }}">
    @yield('css')
    <style>
        .table-row{
            cursor:pointer;
        }
    </style>
    <!-- Load React. -->
    <script src="https://unpkg.com/react@16/umd/react.development.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@16/umd/react-dom.development.js" crossorigin></script>
    <script  type="text/babel" src="{{asset('js/react/admin.js')}}"></script>
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header closed-sidebar">
        <div class="app-header header-shadow">
            <div class="app-header__logo align-items-center">
                <div class="logo-src my-2">
                    <img src="{{asset('images/icons/kltech-intl.png')}}" alt="" height="30px" width="150px" class="my-0">
                </div>
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
            <div class="app-header__content">
                <div class="app-header-left">
                    <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div>
                    <ul class="header-menu nav">
                        <li class="dropdown nav-item">
                            <a aria-haspopup="true" data-toggle="dropdown" class="nav-link" aria-expanded="true">
                                <i class="nav-link-icon fa fa-building"></i> CompanyName
                                <i class="fa fa-angle-down ml-2 opacity-5"></i>
                            </a>
                        </li>
                        <li class="btn-group nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-edit"></i>
                                Projects
                            </a>
                        </li>
                        <li class="dropdown nav-item o_invisible_modifier">
                            <a aria-haspopup="true" data-toggle="dropdown" class="nav-link" aria-expanded="true">
                                <i class="nav-link-icon fa fa-cog"></i> Setting
                                <i class="fa fa-angle-down ml-2 opacity-5"></i>
                            </a>
                            <div tabindex="-1" role="menu" aria-hidden="true" 
                            class="dropdown-menu-lg dropdown-menu">
                                <div class="dropdown-menu-header" style="padding-top:0px;">
                                    <div class="dropdown-menu-header-inner bg-success">
                                        <div class="menu-header-image">
                                            <div class="menu-header-content text-left">
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-3">
                                                            <div class="fa fa-cog ml-2"></div>
                                                        </div>
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading my-3 text-white opacity-10">General Setting
                                                            </div>
                                                        </div>
                                                        <div class="widget-content-right mr-2">
                                                            <button id="dialog-close"><i class="fa fa-times-circle-o text-danger"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (AccessRight::access()->administration == True ) 
                                <a href="{{ route ('internaluser.index')}}" class="dropdown-item mt-1">
                                    <i class="dropdown-icon fa fa-user">
                                    </i>Internal User
                                </a>
                                <a href="{{ route ('portal.index')}}" class="dropdown-item">
                                    <i class="dropdown-icon fa fa-users">
                                    </i>Portal
                                </a>
                                <div tabindex="-1" class="dropdown-divider"></div>
                                <a href="{{ route ('companies.index')}}" class="dropdown-item">
                                    <i class="dropdown-icon fa fa-building">
                                    </i>Manage Companies
                                </a>
                                @endif
                                <div tabindex="-1" class="dropdown-divider"></div>
                                <a data-toggle="modal" data-target="#aboutmodal" class="dropdown-item">
                                    <i class="dropdown-icon fa fa-info-circle">
                                    </i>About 
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <div class="widget-content-right header-user-info ml-3">
                                            <button type="button"
                                                class="p-1 btn btn-sm show-toastr-example">
                                                <!-- <i class="fa text-white fa-bell-o pr-1 pl-1"></i> -->
                                                <span class="fa-stack pr-1 pl-1">
                                                    <i class="fa text-primary fa-circle-thin fa-stack-2x"></i>
                                                    <i class="fa text-primary fa-bell-o fa-stack-1x "></i>
                                                </span>
                                            </button>
                                        </div>
                                        <div class="widget-content-right header-user-info ml-3">
                                            <button type="button"
                                                class="btn-shadow p-1 btn btn-sm show-toastr-example">
                                                <span class="fa-stack pr-1 pl-1">
                                                    <i class="fa text-primary fa-circle-thin fa-stack-2x"></i>
                                                    <i class="fa text-primary fa-calendar fa-stack-1x"></i>
                                                </span>
                                            </button>
                                        </div>
                                        <div tabindex="-1" role="menu" aria-hidden="true"
                                        class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                                            <div class="dropdown-menu-header">
                                                <div class="dropdown-menu-header-inner">
                                                    <div class="menu-header-image">
                                                        <div class="menu-header-content text-left">
                                                            <div class="widget-content p-0">
                                                                <div class="widget-content-wrapper">
                                                                    <div class="widget-content-left mr-3">
                                                                        <div class="profile ml-2"></div>
                                                                    </div>
                                                                    <div class="widget-content-left">
                                                                        <div class="widget-heading mt-2 text-white opacity-10">{{ Auth::user()->name }}
                                                                        </div>
                                                                        <div class="widget-subheading opacity-10 text-white">
                                                                        </div>
                                                                    </div>
                                                                    <div class="widget-content-right mr-2">
                                                                        <button id="dialog-close"><i class="fa fa-times-circle-o text-danger"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="scroll-area-xs" style="height: 150px;">
                                                <div class="scrollbar-container ps">
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item-header nav-item">Activity
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="javascript:void(0);" class="nav-link">Notices
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="javascript:void(0);" class="nav-link">Recover Password
                                                            </a>
                                                        </li>
                                                        <li class="nav-item-header nav-item">My Account
                                                        </li>
                                                        <li class="nav-item">
                                                            <a tabindex="0" class="nav-link" href="{{ route('profile')}}">
                                                                {{ __('My Profile') }}
                                                            </a>
                                                            <input type="hidden" id="current_email" name="current_email" value="{{ Auth::user()->email}}">
                                                        </li>
                                                    </ul>
                                                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                                    </div>
                                                    <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="nav flex-column">
                                                <li class="nav-item-divider mb-0 nav-item"></li>
                                            </ul>
                                            <div class="grid-menu grid-menu-2col">
                                                <div class="no-gutters row">
                                                    <div class="col-sm-12 text-center">
                                                        <button class="btn-icon-vertical btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-warning mt-2">
                                                            <i class="fa fa-ticket icon-gradient bg-love-kiss btn-icon-wrapper mb-2"></i>
                                                            <b>Support Tickets</b>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="nav flex-column">
                                                <li class="nav-item-divider nav-item">
                                                </li>
                                                <li class="nav-item-btn text-center nav-item">
                                                    <a tabindex="0" class="btn btn-primary" href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                        {{ __('Logout') }}
                                                    </a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  mt-3 ml-3 header-user-info">
                                    <div class="widget-heading">
                                        {{ Auth::user()->name }}
                                    </div>
                                    <div class="widget-subheading">
                                        
                                    </div>
                                </div>
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            class="p-0 btn">
                                    <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                </a>
                                <div class="ml-2 profile">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('setting.themes')
        <div class="app-main">
            @include('layouts.sidebar')
            <div class="app-main__outer">
                <div class="o_web_client">
                    @yield('content')
                </div>
                <!-- <div class="app-wrapper-footer">
                    <div class="app-footer">
                        <div class="app-footer__inner">
                            <div class="app-footer-left">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            Footer Link 1
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                        <div class="badge badge-success mr-1 ml-0">
                                                <small>NEW</small>
                                            </div>
                                            Footer Link 2
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="app-footer-right">
                                <ul class="nav">
                                    <li class="nav-item">
                                    <p class="nav-link mt-1">
                                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> | All rights reserved to <a class="white"
                                        href="https://kltech-intl.technology">&nbsp KLTECH-INTL </a></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    <script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{asset('js/library/vue.min.js')}}"></script>
    <script src="{{asset('js/library/numeral.min.js')}}"></script>
    <script src="{{asset('js/library/moment.min.js')}}"></script>
    <script src="{{asset('js/library/vue-resource.min.js')}}"></script>
    <script src="{{asset('js/admin.js')}}"></script>

    <!-- toastr message -->
    {{--toastr message--}}
    {{--<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>--}}
    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    {!! Toastr::message() !!}

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.8/dist/sweetalert2.all.min.js"></script>
    <script src="{{asset('js/asset_common/base.js')}}"></script>
    @yield('js')
</body>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route ('accounting.partner_ledger')}}" method="get" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Partner Ledger Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body text-center">
                        <div class="row">
                            <div class="col-4">
                                <label for="" name="partner_type" class="col-form-label"><b>Partner Type </b></label>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <select id="partner_type" required name="partner_type" class="form-control o_input o_field_widget o_required_modifier">
                                        <option value="customer">Customer</option>
                                        <option value="vendor">Vendor</option>
                                    </select>
                                </div>
                            </div>
                        </div>  
                    </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">Ok</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="aboutmodal" tabindex="-1" role="dialog" aria-labelledby="aboutmodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route ('accounting.partner_ledger')}}" method="get" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="aboutmodalLabel">About</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 text-center">
                                <img src="{{asset('images/icons/kltech-intl.png')}}" alt="" height="30px" width="150px" class="my-0">                            
                            </div>
                        </div>  
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                Applications name
                            </div>
                            <div class="col-8">
                                : {{ config('app.name') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                Version
                            </div>
                            <div class="col-8">
                                : 2.0.3
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                Developer
                            </div>
                            <div class="col-8">
                                : <a href="https://kltech-intl.odoo.com" >Kltech-intl (kelvin leonardi)</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                Download
                            </div>
                            <div class="col-8">
                                : <a href="https://github.com/kelvzxu/erp_laravel.git" >Link Download</a>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">Ok</button>
                </div>
            </form>
        </div>
    </div>
</div>
</html>
@yield('modal')
