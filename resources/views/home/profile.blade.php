@extends('master_home')
@section('content')
<?php

use Illuminate\Support\Facades\Session;

?>
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
	<div class="container">
		<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
			<div class="col-first">
				<h1>Login</h1>
				<nav class="d-flex align-items-center">
					<a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
					<a href="#">Profile</a>
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
					<?php if (Session::get('dataUsers')->photo == null) { ?>
						<img src="{{asset('user.png')}}" style="width: 100%;" alt="">
					<?php } else { ?>
						<img src="{{asset('uploads/profile')}}/{{Session::get('dataUsers')->photo}}" style="width: 200px;height:200px;border-radius: 50%;" alt="">
					<?php } ?>
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
						<button type="button" data-toggle="modal" data-target="#modalProfile" class="primary-btn btn-style">Perbarui Data</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="modal fade" id="modalProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Perbarui Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form" method="post" id="form" action="/update-profile/{{Session::get('dataUsers')->id}}" enctype="multipart/form-data">
					@csrf
					<div class="form-group row">
						<label for="inputPassword" class="col-sm-2 col-form-label">Nama Lengkap</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="fullName" value="{{Session::get('dataUsers')->full_name}}" name="fullName" placeholder="Nama Lengkap">
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" id="email" value="{{Session::get('dataUsers')->email}}" name="email" placeholder="Email">
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword" class="col-sm-2 col-form-label">No Telepon</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="phoneNumber" value="{{Session::get('dataUsers')->phone_number}}" name="phoneNumber" placeholder="Nomor Telepon">
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword" class="col-sm-2 col-form-label">Alamat</label>
						<div class="col-sm-10">
							<textarea type="text" class="form-control" id="alamat" value="{{Session::get('dataUsers')->alamat}}" name="alamat" placeholder="Alamat">{{Session::get('dataUsers')->alamat}}</textarea>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword" class="col-sm-2 col-form-label">Kecamatan</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="kecamatan" value="{{Session::get('dataUsers')->kecamatan}}" name="kecamatan" placeholder="Kecamatan">
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword" class="col-sm-2 col-form-label">Kabupaten</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="kabupaten" value="{{Session::get('dataUsers')->kabupaten}}" name="kabupaten" placeholder="Kabupaten">
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword" class="col-sm-2 col-form-label">Provinsi</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="provinsi" value="{{Session::get('dataUsers')->provinsi}}" name="provinsi" placeholder="Provinsi">
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword" class="col-sm-2 col-form-label">Foto</label>
						<div class="col-sm-10">
							<input type="file" name="image" class="file-upload-default">
							<div class="input-group col-xs-12">
								<input type="text" id="imageText" class="form-control file-upload-info" disabled placeholder="Upload Image">
								<span class="input-group-append">
									<button class="file-upload-browse btn btn-primary" type="button">Upload</button>
								</span>
							</div>
							<p class="mt-3" id="textPhoto">(Optional) Kosongkan bila tidak ingin mengubah foto</p>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" id="password" value="{{Session::get('password')}}" name="password" placeholder="Password">

						</div>
					</div>
					<div class="form-group row">
						<label for="inputPassword" class="col-sm-2 col-form-label">Konfirmasi Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" id="confirmPassword" value="{{Session::get('confirmPassword')}}" name="confirmPassword" placeholder="Konfirmasi Password">
							<p class="mt-3" id="textPhoto">(Optional) Kosongkan bila tidak ingin mengubah password</p>
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="primary-btn btn-style">Simpan</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection