@extends('master_home')
@section('content')

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Login</h1>
					<nav class="d-flex align-items-center">
						<a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Login</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Login Box Area =================-->
	<section class="login_box_area section_gapp">
		<div class="container">
			<div class="row">
				<!-- <div class="col-lg-6">
					<div class="login_box_img">
						<img class="img-fluid" src="{{asset('home/login.png')}}" alt="">
						<div class="hover">
							
						</div>
					</div>
				</div> -->
				<div class="col-lg-12">
					<div class="login_form_inner">
						<h3>Silahkan Login</h3>
						<form class="row login_form" action="/auth" method="post" id="contactForm" novalidate="novalidate">
                            @csrf
							<div class="col-md-12 form-group">
								<input type="email" class="form-control" id="name" name="email" value="{{old('email')}}" placeholder="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'"> 
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
							</div>
							<!-- <div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" id="f-option2" name="selector">
									<label for="f-option2">Keep me logged in</label>
								</div>
							</div> -->
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="primary-btn">Log In</button>
								<!-- <a href="#">Forgot Password?</a> -->
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->
@endsection