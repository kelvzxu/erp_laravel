<!DOCTYPE html>
<html lang="en">
  <head>
    <title>SK-Fresh Indonesia</title>
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
	
	{{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-primary ftco_navbar ftco-navbar-light" id="ftco-navbar">
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
	  </nav>
    
    <section class="hero-wrap js-fullheight" style="background-image: url('portal/images/background/bg_fruit.jpg');" data-section="home">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-md-8 ftco-animate mt-5" data-scrollax=" properties: { translateY: '70%' }">
          	<p class="d-flex align-items-center" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
							<a href="https://vimeo.com/45830194" class="icon-video popup-vimeo d-flex justify-content-center align-items-center mr-3">
    						<span class="ion-ios-play play mr-2"></span>
    						<span class="watch">Watch Video</span>
    					</a>
						</p>
			<h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">We have a passion in creating new and unique spaces</h1>
			@if (Route::has('login'))
				@auth
						<a href="{{ url('/home') }}" class="btn btn-primary">Dashboard</a>
						<a class="btn btn-primary ml-3" href="{{ route('logout') }}"
							onclick="event.preventDefault();
											document.getElementById('logout-form').submit();">
							{{ __('Logout') }}
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
                        </form>
                @else
					<a href="{{ route('login') }}" class="btn btn-primary"> Login </a>
					@if (Route::has('register'))
						<a href="{{ route('register') }}"class="btn btn-primary ml-3">Register</a>
					@endif
				@endauth
			@endif
          </div>
        </div>
      </div>
    </section>
	
	{{-- product --}}
	<section class="ftco-section ftco-services ftco-no-pt">
      <div class="container">
        <div class="row services-section">
          <div class="col-md-4 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services text-center d-block">
              <div class="icon"><img src="{{asset('portal/images/product/fruit.png')}}" alt="" width="100px"></div>
              <div class="media-body">
                <h3 class="heading mb-3">Fruits</h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                <p><a href="#" class="btn btn-primary">Read more</a></p>
              </div>
            </div>      
          </div>
          <div class="col-md-4 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services text-center d-block">
              <div class="icon"><img src="{{asset('portal/images/product/vegetable.png')}}" alt="" width="130px"></div>
              <div class="media-body">
                <h3 class="heading mb-3">Vegetables</h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                <p><a href="#" class="btn btn-primary">Read more</a></p>
              </div>
            </div>    
          </div>
          <div class="col-md-4 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services text-center d-block">
              <div class="icon"><img src="{{asset('portal/images/product/frozenfood.png')}}" alt="" width="100px"></div>
              <div class="media-body">
                <h3 class="heading mb-3">Frozen foods</h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                <p><a href="#" class="btn btn-primary">Read more</a></p>
              </div>
            </div>      
          </div>
        </div>
      </div>
    </section>

	{{-- introduction --}}
    <section class="ftco-counter img ftco-section ftco-no-pt ftco-no-pb" id="section-counter" data-section="about">
    	<div class="container">
    		<div class="row d-flex">
    			<div class="col-md-6 col-lg-4 d-flex">
    				<div class="img d-flex align-self-stretch align-items-center" style="background-image:url('portal/images/background/bg_fruit1.jpg');">
    					<div class="request-quote py-5">
	    					<div class="py-2">
	    						<span class="subheading">BECOME OUR SUPPLIER</span>
	    						<h3>Join Partner</h3>
	    					</div>
	    					<form action="#" class="request-form ftco-animate">
			    				<div class="form-group">
			    					<input type="text" class="form-control" placeholder="Business Name">
			    				</div>
			    				<div class="form-group">
			    					<input type="text" class="form-control" placeholder="Business Email">
			    				</div>
		    					<div class="form-group">
                                    <textarea name="" id="" rows="3" class="form-control" placeholder="List Product"></textarea>
			    				</div>
                                <div class="form-group">
                                    <textarea name="" id="" rows="3" class="form-control" placeholder="Message"></textarea>
                                </div>
		    					<div class="form-group">
			    					<input type="text" class="form-control" placeholder="Business Phone">
			    				</div>
                                <div class="form-group">
                                    <input type="submit" value="Send Request" class="btn btn-secondary py-3 px-4">
                                </div>
			    			</form>
	    				</div>
    				</div>
    			</div>
    			<div class="col-md-6 col-lg-8 pl-lg-5 py-5">
    				<div class="row justify-content-start pb-3">
		          <div class="col-md-12 heading-section ftco-animate">
		          	<span class="subheading">Welcome</span>
		            <h2 class="mb-4">SK Fresh Indonesia Fresh Fruit Importer, Wholesale and Distributor.</h2>
		            <p>Established in 1978, the business had a humble start in distributing local mandarins. Hard work and emphasis on quality made us one of the main local fruits distributors. In 1994 the company expanded into imported fruits, since then the business grew to an unprecedented scale. </p>
		            <p>Today we have nationwide distribution networks covering the islands of Sumatra, Java, Borneo, Sulawesi, and Irian Jaya. The company holds two major Distribution Centres (DC) with total combined cold storage capacity of 8,800 tonnes. We have a DC in Jakarta to cover Western Indonesian region, and another DC in Surabaya covering Eastern Indonesian region.</p>
		          </div>
		        </div>
		    		<div class="row">
		          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate d-flex">
		            <div class="block-18 text-center p-4 mb-4 align-self-stretch d-flex">
		              <div class="text">
		                <strong class="number" data-number="40">0</strong>
		                <span>Years of experience</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate d-flex">
		            <div class="block-18 text-center py-4 px-3 mb-4 align-self-stretch d-flex">
		              <div class="text">
		                <strong class="number" data-number="1000">0</strong>
		                <span>Fresh Product</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate d-flex">
		            <div class="block-18 text-center py-4 px-3 mb-4 align-self-stretch d-flex">
		              <div class="text">
		                <strong class="number" data-number="100">0</strong>
		                <span>Our Partner</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate d-flex">
		            <div class="block-18 text-center py-4 px-3 mb-4 align-self-stretch d-flex">
		              <div class="text">
		                <strong class="number" data-number="1100">0</strong>
		                <span>Happy Customers</span>
		              </div>
		            </div>
		          </div>
		        </div>
	        </div>
        </div>
    	</div>
    </section>

	{{-- partner --}}
    <section class="ftco-section ftco-project bg-light" data-section="partner">
    	<div class="container-fluid px-md-5">
    		<div class="row justify-content-center pb-5">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	<span class="subheading">Relations</span>
            <h2 class="mb-4">Our Partner</h2>
          </div>
        </div>
    		<div class="row">
    			<div class="col-md-12 testimonial">
            <div class="carousel-project owl-carousel">
            	<div class="item">
            		<div class="project">
						<div class="img">
							<img src="{{asset('portal/images/partner/starranch.jpg')}}" class="img-fluid" alt="sk-Fresh Partner">
							<a href="{{asset('portal/images/partner/starranch.jpg')}}" class="icon image-popup d-flex justify-content-center align-items-center">
								<span class="icon-expand"></span>
							</a>
						</div>
					</div>
            	</div>
            	<div class="item">
            		<div class="project">
						<div class="img">
							<img src="{{asset('portal/images/partner/widerways.jpg')}}" class="img-fluid" alt="sk-Fresh Partner">
							<a href="{{asset('portal/images/partner/widerways.jpg')}}" class="icon image-popup d-flex justify-content-center align-items-center">
								<span class="icon-expand"></span>
							</a>
						</div>
					</div>
            	</div>
            	<div class="item">
            		<div class="project">
						<div class="img">
							<img src="{{asset('portal/images/partner/zespri.jpg')}}" class="img-fluid" alt="sk-Fresh Partner">
							<a href="{{asset('portal/images/partner/zespri.jpg')}}" class="icon image-popup d-flex justify-content-center align-items-center">
								<span class="icon-expand"></span>
							</a>
						</div>
					</div>
            	</div>
            	<div class="item">
            		<div class="project">
						<div class="img">
							<img src="{{asset('portal/images/partner/shenzen.jpg')}}" class="img-fluid" alt="sk-Fresh Partner">
							<a href="{{asset('portal/images/partner/shenzen.jpg')}}" class="icon image-popup d-flex justify-content-center align-items-center">
								<span class="icon-expand"></span>
							</a>
						</div>
					</div>
            	</div>
            	<div class="item">
            		<div class="project">
						<div class="img">
							<img src="{{asset('portal/images/partner/saco.jpg')}}" class="img-fluid" alt="sk-Fresh Partner">
							<a href="{{asset('portal/images/partner/saco.jpg')}}" class="icon image-popup d-flex justify-content-center align-items-center">
								<span class="icon-expand"></span>
							</a>
						</div>
					</div>
            	</div>
            	<div class="item">
            		<div class="project">
						<div class="img">
							<img src="{{asset('portal/images/partner/fruitmaster.jpg')}}" class="img-fluid" alt="sk-Fresh Partner">
							<a href="{{asset('portal/images/partner/fruitmaster.jpg')}}" class="icon image-popup d-flex justify-content-center align-items-center">
								<span class="icon-expand"></span>
							</a>
						</div>
					</div>
				</div>
				<div class="item">
            		<div class="project">
						<div class="img">
							<img src="{{asset('portal/images/partner/goodfarmer.jpg')}}" class="img-fluid" alt="sk-Fresh Partner">
							<a href="{{asset('portal/images/partner/goodfarmer.jpg')}}" class="icon image-popup d-flex justify-content-center align-items-center">
								<span class="icon-expand"></span>
							</a>
						</div>
					</div>
				</div>
				<div class="item">
            		<div class="project">
						<div class="img">
							<img src="{{asset('portal/images/partner/hoanghau.jpg')}}" class="img-fluid" alt="sk-Fresh Partner">
							<a href="{{asset('portal/images/partner/hoanghau.jpg')}}" class="icon image-popup d-flex justify-content-center align-items-center">
								<span class="icon-expand"></span>
							</a>
						</div>
					</div>
				</div>
				<div class="item">
            		<div class="project">
						<div class="img">
							<img src="{{asset('portal/images/partner/kleppe.jpg')}}" class="img-fluid" alt="sk-Fresh Partner">
							<a href="{{asset('portal/images/partner/kleppe.jpg')}}" class="icon image-popup d-flex justify-content-center align-items-center">
								<span class="icon-expand"></span>
							</a>
						</div>
					</div>
				</div>
				<div class="item">
            		<div class="project">
						<div class="img">
							<img src="{{asset('portal/images/partner/terra.jpg')}}" class="img-fluid" alt="sk-Fresh Partner">
							<a href="{{asset('portal/images/partner/terra.jpg')}}" class="icon image-popup d-flex justify-content-center align-items-center">
								<span class="icon-expand"></span>
							</a>
						</div>
					</div>
				</div>
				<div class="item">
            		<div class="project">
						<div class="img">
							<img src="{{asset('portal/images/partner/17.jpg')}}" class="img-fluid" alt="sk-Fresh Partner">
							<a href="{{asset('portal/images/partner/17.jpg')}}" class="icon image-popup d-flex justify-content-center align-items-center">
								<span class="icon-expand"></span>
							</a>
						</div>
					</div>
            	</div>
            </div>
          </div>
    		</div>
    	</div>
    </section>

	{{-- activity --}}
    <section class="ftco-section" data-section="activity">
    	<div class="container-fluid p-0">
    		<div class="row no-gutters justify-content-center pb-5">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	<span class="subheading">Activity</span>
            <h2 class="mb-4">Gallery</h2>
          </div>
        </div>
        <div class="row no-gutters">
			<div class="col-md-6 col-lg-4 ftco-animate">
				<div class="staff">
					<div class="img-wrap d-flex align-items-stretch">
						<div class="img align-self-stretch" style="background-image: url(portal/images/activity/SKF-KOREA-1.jpg);"></div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-4 ftco-animate">
				<div class="staff">
					<div class="img-wrap d-flex align-items-stretch">
						<div class="img align-self-stretch" style="background-image: url(portal/images/activity/IMG_5001.jpg);"></div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-4 ftco-animate">
				<div class="staff">
					<div class="img-wrap d-flex align-items-stretch">
						<div class="img align-self-stretch" style="background-image: url(portal/images/activity/MKS05.jpg);"></div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-4 ftco-animate">
				<div class="staff">
					<div class="img-wrap d-flex align-items-stretch">
						<div class="img align-self-stretch" style="background-image: url(portal/images/activity/MKS03.jpg);"></div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-4 ftco-animate">
				<div class="staff">
					<div class="img-wrap d-flex align-items-stretch">
						<div class="img align-self-stretch" style="background-image: url(portal/images/activity/pear.jpg);"></div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-4 ftco-animate">
				<div class="staff">
					<div class="img-wrap d-flex align-items-stretch">
						<div class="img align-self-stretch" style="background-image: url(portal/images/activity/MKS04.jpg);"></div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-4 ftco-animate">
				<div class="staff">
					<div class="img-wrap d-flex align-items-stretch">
						<div class="img align-self-stretch" style="background-image: url(portal/images/activity/warehouse.jpg);"></div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-4 ftco-animate">
				<div class="staff">
					<div class="img-wrap d-flex align-items-stretch">
						<div class="img align-self-stretch" style="background-image: url(portal/images/activity/MKS01.jpg);"></div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-4 ftco-animate">
				<div class="staff">
					<div class="img-wrap d-flex align-items-stretch">
						<div class="img align-self-stretch" style="background-image: url(portal/images/activity/MKS02.jpg);"></div>
					</div>
				</div>
			</div>
	</section>
	
	{{-- Customer --}}
	 <section class="ftco-section ftco-project bg-light" data-section="customer">
    	<div class="container-fluid px-md-5">
    		<div class="row justify-content-center pb-5">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	<span class="subheading">Relations</span>
            <h2 class="mb-4">CUSTOMERS</h2>
          </div>
        </div>
    		<div class="row">
    			<div class="col-md-12 testimonial">
            <div class="carousel-project owl-carousel">
            	<div class="item">
            		<div class="project">
						<div class="img">
							<img src="{{asset('portal/images/customer/alfamart.jpg')}}" class="img-fluid" alt="sk-Fresh customer">
							<a href="{{asset('portal/images/customer/alfamart.jpg')}}" class="icon image-popup d-flex justify-content-center align-items-center">
								<span class="icon-expand"></span>
							</a>
						</div>
					</div>
            	</div>
            	<div class="item">
            		<div class="project">
						<div class="img">
							<img src="{{asset('portal/images/customer/indomaret.jpg')}}" class="img-fluid" alt="sk-Fresh customer">
							<a href="{{asset('portal/images/customer/indomaret.jpg')}}" class="icon image-popup d-flex justify-content-center align-items-center">
								<span class="icon-expand"></span>
							</a>
						</div>
					</div>
            	</div>
            	<div class="item">
            		<div class="project">
						<div class="img">
							<img src="{{asset('portal/images/customer/lottemart.jpg')}}" class="img-fluid" alt="sk-Fresh customer">
							<a href="{{asset('portal/images/customer/lottemart.jpg')}}" class="icon image-popup d-flex justify-content-center align-items-center">
								<span class="icon-expand"></span>
							</a>
						</div>
					</div>
            	</div>
            	<div class="item">
            		<div class="project">
						<div class="img">
							<img src="{{asset('portal/images/customer/carrefour.jpg')}}" class="img-fluid" alt="sk-Fresh customer">
							<a href="{{asset('portal/images/customer/carrefour.jpg')}}" class="icon image-popup d-flex justify-content-center align-items-center">
								<span class="icon-expand"></span>
							</a>
						</div>
					</div>
				</div>
				<div class="item">
            		<div class="project">
						<div class="img">
							<img src="{{asset('portal/images/customer/hypermart.jpg')}}" class="img-fluid" alt="sk-Fresh customer">
							<a href="{{asset('portal/images/customer/hypermart.jpg')}}" class="icon image-popup d-flex justify-content-center align-items-center">
								<span class="icon-expand"></span>
							</a>
						</div>
					</div>
				</div>
				<div class="item">
            		<div class="project">
						<div class="img">
							<img src="{{asset('portal/images/customer/giant.jpg')}}" class="img-fluid" alt="sk-Fresh customer">
							<a href="{{asset('portal/images/customer/giant.jpg')}}" class="icon image-popup d-flex justify-content-center align-items-center">
								<span class="icon-expand"></span>
							</a>
						</div>
					</div>
				</div>
				<div class="item">
            		<div class="project">
						<div class="img">
							<img src="{{asset('portal/images/customer/griyamart.jpg')}}" class="img-fluid" alt="sk-Fresh customer">
							<a href="{{asset('portal/images/customer/griyamart.jpg')}}" class="icon image-popup d-flex justify-content-center align-items-center">
								<span class="icon-expand"></span>
							</a>
						</div>
					</div>
				</div>
				<div class="item">
            		<div class="project">
						<div class="img">
							<img src="{{asset('portal/images/customer/adaswalayan.jpg')}}" class="img-fluid" alt="sk-Fresh customer">
							<a href="{{asset('portal/images/customer/adaswalayan.jpg')}}" class="icon image-popup d-flex justify-content-center align-items-center">
								<span class="icon-expand"></span>
							</a>
						</div>
					</div>
				</div>
				<div class="item">
            		<div class="project">
						<div class="img">
							<img src="{{asset('portal/images/customer/dutabuah.jpg')}}" class="img-fluid" alt="sk-Fresh customer">
							<a href="{{asset('portal/images/customer/dutabuah.jpg')}}" class="icon image-popup d-flex justify-content-center align-items-center">
								<span class="icon-expand"></span>
							</a>
						</div>
					</div>
				</div>
				<div class="item">
            		<div class="project">
						<div class="img">
							<img src="{{asset('portal/images/customer/kokifruit.jpg')}}" class="img-fluid" alt="sk-Fresh customer">
							<a href="{{asset('portal/images/customer/kokifruit.jpg')}}" class="icon image-popup d-flex justify-content-center align-items-center">
								<span class="icon-expand"></span>
							</a>
						</div>
					</div>
            	</div>
            </div>
          </div>
    		</div>
    	</div>
    </section>

	{{-- Contact US --}}
    <section class="ftco-section contact-section ftco-no-pb" data-section="contact">
      <div class="container">
      	<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <span class="subheading">Contact</span>
            <h2 class="mb-4">Contact Us</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
          </div>
        </div>
        <div class="row no-gutters block-9">
          <div class="col-md-6 order-md-last d-flex">
            <form action="#" class="bg-light p-5 contact-form">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Email">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Subject">
              </div>
              <div class="form-group">
                <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Send Message" class="btn btn-secondary py-3 px-5">
              </div>
            </form>
          
          </div>

          <div class="col-md-6 d-flex">
          	<div id="map" class="bg-white"></div>
          </div>
        </div>
      </div>
    </section>

	{{-- contact person --}}
    <section class="ftco-section contact-section">
      <div class="container">
        <div class="row d-flex contact-info">
          <div class="col-md-6 col-lg-3 d-flex">
          	<div class="align-self-stretch box p-4 text-center">
          		<div class="icon d-flex align-items-center justify-content-center">
          			<span class="icon-map-signs"></span>
          		</div>
          		<h3 class="mb-4">Address</h3>
	            <p>Jln. Pegangsaan Dua Km. 4 No. 89 Jakarta Utara 14250, Indonesia</p>
	          </div>
          </div>
          <div class="col-md-6 col-lg-3 d-flex">
          	<div class="align-self-stretch box p-4 text-center">
          		<div class="icon d-flex align-items-center justify-content-center">
          			<span class="icon-phone2"></span>
          		</div>
          		<h3 class="mb-4">Contact Number</h3>
	            <p><a href="tel://214608000">(+62-21) 4608000</a></p>
	          </div>
          </div>
          <div class="col-md-6 col-lg-3 d-flex">
          	<div class="align-self-stretch box p-4 text-center">
          		<div class="icon d-flex align-items-center justify-content-center">
          			<span class="icon-paper-plane"></span>
          		</div>
          		<h3 class="mb-4">Email Address</h3>
	            <p><a href="mailto:ceokelvin12@gmail.com">skfresh@kltechgroup.xyz</a></p>
	          </div>
          </div>
          <div class="col-md-6 col-lg-3 d-flex">
          	<div class="align-self-stretch box p-4 text-center">
          		<div class="icon d-flex align-items-center justify-content-center">
          			<span class="icon-globe"></span>
          		</div>
          		<h3 class="mb-4">Website</h3>
	            <p><a href="#">SK-Fresh.kltechgroup.xyz</a></p>
	          </div>
          </div>
        </div>
      </div>
    </section>
		
	{{-- footer --}}
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
  </body>
</html>