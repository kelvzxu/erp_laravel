@extends('layouts.app')
@section('title','SK-ERP Login')
@section('content')
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form method="POST" action="{{ route('login') }}">
                    @csrf
					@if (session('error'))
						<div class="alert alert-danger">
						{{ session('error') }}
						</div>
					@endif
					<span class="login100-form-title">
						<img src="{{asset('images/logo/sk-logo1.png')}}" alt="" width="90%">
					</span>
					<div class="text-center my-3 ">
						<span class="txt1">
							Insert your Email and password
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100 @error('email') is-invalid @enderror" type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
						<span class="focus-input100" data-placeholder="Email"></span>
						@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100 @error('password') is-invalid @enderror" type="password" name="password" id="password" required autocomplete="current-password">
						<span class="focus-input100" data-placeholder="Password"></span>
						@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" type="checkbox" name="remember" id="ckb1" {{ old('remember') ? 'checked' : '' }}>
						<label class="label-checkbox100 txt1" for="ckb1">
							{{ __('Remember Me') }}
						</label>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn">
								{{ __('Login') }}
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
	@endsection