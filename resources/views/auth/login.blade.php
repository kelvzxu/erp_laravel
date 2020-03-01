@extends('layouts.apps')

@section('content')
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form">
					<span class="login100-form-title p-b-26">
						<img src="{{asset('images/icons/kltech-intl.png')}}" alt="" width="70%">
					</span>
					<div class="text-center">
						<span class="txt1">
							Insert your Email and password
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="pass">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>
					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100 txt1" for="ckb1">
							Remember me
						</label>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
							</button>
						</div>
					</div>

					<div class="text-center p-t-90">
						<span class="txt1">
							Don’t have an account?
						</span>

						<a class="txt2" href="{{ route('register') }}">
							Sign Up
						</a>
					</div>
					@if (Route::has('password.request'))
					<div class="text-center mt-2">
						<a class="txt2" href="{{ route('password.request') }}">
							{{ __('Forgot Your Password?') }}
						</a>
					</div>
					@endif
				</form>
			</div>
		</div>
	</div>