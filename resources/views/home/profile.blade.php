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
		<div class="row mt-5">
			<div class="col-lg-4">
				<div class="login_form_inner" style="padding: 50px !important;">
					<img src="{{asset('user.png')}}" style="width: 100%;" alt="">
					<h2 class="mt-5">{{Session::get('dataUsers')->full_name}}</h2>
				</div>
			</div>
			<div class="col-lg-8">
				<div class="login_form_inner" style="text-align: left !important; padding:50px !important;">
					<div class="row">
						<div class="col-6">

							<p class=" fs-5">Email</p>
						</div>
						<div class="col-6">
							<p class="font-weight-bold fs-5">{{Session::get('dataUsers')->email}}</p>

						</div>
					</div>
					<div class="row mt-3">
						<div class="col-6">

							<p class=" fs-5">No Telepon</p>
						</div>
						<div class="col-6">
							<p class="font-weight-bold fs-5">{{Session::get('dataUsers')->phone_number}}</p>

						</div>
					</div>
					<div class="row mt-3">
						<div class="col-6">

							<p class=" fs-5">Alamat</p>
						</div>
						<div class="col-6">
							<p class="font-weight-bold fs-5">{{Session::get('dataUsers')->alamat}}</p>

						</div>
					</div>
					<div class="row mt-3">
						<div class="col-6">

							<p class=" fs-5">Kecamatan</p>
						</div>
						<div class="col-6">
							<p class="font-weight-bold fs-5">{{Session::get('dataUsers')->kecamatan}}</p>

						</div>
					</div>
					<div class="row mt-3">
						<div class="col-6">

							<p class=" fs-5">Kabupaten</p>
						</div>
						<div class="col-6">
							<p class="font-weight-bold fs-5">{{Session::get('dataUsers')->kabupaten}}</p>

						</div>
					</div>
					<div class="row mt-3">
						<div class="col-6">

							<p class=" fs-5">Provinsi</p>
						</div>
						<div class="col-6">
							<p class="font-weight-bold fs-5">{{Session::get('dataUsers')->provinsi}}</p>

						</div>
					</div>
					<div class="row mt-3">
						<button type="submit" value=" submit" class="primary-btn btn-style">Perbarui Data</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--================End Login Box Area =================-->
@endsection