<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="icon" href="{{ asset('images/icons/icon.png') }}" type="image/png">
    <title>@yield('title')</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="viewport" content="width=device-width, user-scalable=no">
    {{-- ====================== css ==================== --}}
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('portal/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('portal/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('portal/css/animate.css') }}">  
    <link rel="stylesheet" type="text/css" href="{{ asset('portal/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('portal/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('portal/css/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('portal/css/aos.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('portal/css/ionicons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('portal/css/flaticon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('portal/css/icomoon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('portal/css/style.css') }}">
  </head>
  <body>
	
	<!-- {{-- Navbar --}} -->
    <header class="header_area ">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container box_1620">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="{{ url ('/')}}"><img src="{{asset('images/logo/sk-logo1.png')}}" alt="SK FRESH"></a>
                    <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="oi oi-menu"></span> Menu
                    </button>
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                </li>  
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form> 
                            @else
                                <li class="nav-item submenu dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">login</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                                        
                                        <li class="nav-item"><a class="nav-link" href="{{  route('register') }}">Register</a></li>
                                    </ul>
                                </li>   
                            @endauth
                        </ul>
                    </div> 
                </div> 
            </nav>
        </div>
    </header>
    <!-- <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('images/logo/sk-logo1.png')}}" alt="SK FRESH"></a>
	      <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>
			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav nav ml-auto">
						<li class="nav-item"><a href="#" class="nav-link" data-nav-section="home"><span>Home</span></a></li>
						<li class="nav-item"><a href="#" class="nav-link" data-nav-section="about"><span>About</span></a></li>
						<li class="nav-item"><a href="#" class="nav-link" data-nav-section="partner"><span>Partner</span></a></li>
						<li class="nav-item"><a href="#" class="nav-link" data-nav-section="activity"><span>Activity</span></a></li>
						<li class="nav-item"><a href="#" class="nav-link" data-nav-section="customer"><span>customer</span></a></li>
						<li class="nav-item"><a href="#" class="nav-link" data-nav-section="contact"><span>Contact</span></a></li>
				</ul>
			  </div>
	    </div>
	  </nav> -->

      @yield('content')

    
    <footer class="ftco-footer ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
			  <h2 class="ftco-heading-2">SK-FRESH INDONESIA</h2>
			  <img src="{{asset('images/logo/segargroup.png')}}" alt="segar group" width="40%" >
			  <img src="{{asset('images/icons/kltech-intl.png')}}" alt="segar group" width="50%" >
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-4">
              <h2 class="ftco-heading-2">Links</h2>
              <ul class="list-unstyled">
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Home</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>About</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>partner</a></li>
				<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>activity</a></li>
				<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>customer</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Contact</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Product</h2>
              <ul class="list-unstyled">
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Fruits</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Vegetables</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>FrozenFoods</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
					<li><span class="icon icon-map-marker"></span><span class="text">Jln. Pegangsaan Dua Km. 4 No. 89 Jakarta Utara 14250, Indonesia</span></li>
					<li><span class="icon icon-map-marker"></span><span class="text">Jln. Sutomo Sp.Seikera No. 25D medan, Sumatera Utara, Indonesia</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">(+62-21) 4608000</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">skfresh@gmail.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p>
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> | All rights reserved to <a class="white"
                        href="https://kltechgroup.xyz">KLTECHGROUP</a> Designed by <a class="white" href="https://www.instagram.com/kelvin_leonardi/">Kelvinzxu</a>.</p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  	<script type="text/javascript" src="{{asset('portal/js/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('portal/js/jquery-migrate-3.0.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('portal/js/popper.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('portal/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('portal/js/jquery.easing.1.3.js')}}"></script>
	<script type="text/javascript" src="{{asset('portal/js/jquery.waypoints.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('portal/js/jquery.stellar.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('portal/js/owl.carousel.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('portal/js/jquery.magnific-popup.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('portal/js/aos.js')}}"></script>
	<script type="text/javascript" src="{{asset('portal/js/jquery.animateNumber.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('portal/js/scrollax.min.js')}}"></script>
	<script type="text/javascript"
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
	<script type="text/javascript" src="{{asset('portal/js/google-map.js')}}"></script>
	<script type="text/javascript" src="{{asset('portal/js/main.js')}}"></script>
  @yield('js')
  </body>
</html>