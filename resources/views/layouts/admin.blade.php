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
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{asset('css/admin.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    @yield('css')
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
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
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-database"> </i>
                                Statistics
                            </a>
                        </li>
                        <li class="btn-group nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-edit"></i>
                                Projects
                            </a>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-cog"></i>
                                Settings
                            </a>
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
                                                    class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                                                    <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                                                </button>
                                            </div>
                                        <div tabindex="-1" role="menu" aria-hidden="true"
                                            class="dropdown-menu dropdown-menu-right">
                                            <button type="button" tabindex="0" class="dropdown-item">User
                                                Account</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Settings</button>
                                            <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                            <button type="button" tabindex="0" class="dropdown-item">Actions</button>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <a tabindex="0" class="btn dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
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
                                <div class="ml-2" id="profile">

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
                <div class="app-main__inner">
                    @yield('content')
                </div>
                <div class="app-wrapper-footer">
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
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/admin.js')}}"></script>
    <script src="{{asset('js/loadimg.js')}}"></script>
    {{--toastr message--}}
    {{--<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>--}}
    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script>
    function unactive(){
    $('.menu-item').removeClass('mm-active');
    }
 
    $.ajax  ({
        url: "{{asset('api/employee/search')}}",
        type: 'post',
        dataType: 'json',
        data :{
            'email': "{{ Auth::user()->email}}"
        },
        success: function (result) {
            $('#profile').append(`
                <img width="42" id="picture_profile" class="rounded" src="{{asset('uploads/Employees/`+result.data.photo+`')}}"
                    alt="">
                                    `);
            $(".widget-subheading").append(`<pre>`+result.data.jobs_name+`</pre>`)
        }
    })
    </script>
    @yield('js')
</body>

</html>