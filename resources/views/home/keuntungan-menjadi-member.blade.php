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
                <h1>Keuntungan Menjadi Member</h1>
                <nav class="d-flex align-items-center">
                    <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#">Keuntungan Menjadi Member</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Login Box Area =================-->
<section class="login_box_area section_gapp">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <section class="exclusive-deal-area">
                    <div class="container-fluid">
                        <div class="row mt-5">
                            <div class="col-lg-6 no-padding">
                                <img src="{{asset('gift.svg')}}" style="width: 100%; height:auto;" alt="">

                            </div>

                            <div class="col-lg-6 no-padding exclusive-right">
                                <h3 class="text-center">Keuntungan Menjadi Member</h3>
                                <ol class="mt-5" style="text-align: left;">
                                    <li>Bisa mendapatkan lebih banyak potongan belanja</li>
                                    <li>Berpeluang untuk mendapatkan voucher-voucher menarik</li>
                                    <li>Berpeluang menjadi pemenang konsumen terbaik</li>
                                </ol>
                            </div>

                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>
</section>

@endsection