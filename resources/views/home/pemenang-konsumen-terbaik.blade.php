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
                <h1>Pemenang Konsumen Terbaik</h1>
                <nav class="d-flex align-items-center">
                    <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#">Pemenang Konsumen Terbaik</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Login Box Area =================-->
<section class="login_box_area section_gapp">
    <div class="container">
        <div class="cart_inner mt-5">
            <?php if (Session::get('login') == true) { ?>
                <?php if ($dataWinnerNow->id_users == Session::get('dataUsers')->id) { ?>
                    <div class="alert alert-success">
                        Selamat Anda Telah menjadi pemenang konsumen terbaik toko kami periode Bulan <b><?= date("F", mktime(0, 0, 0, $dataWinnerNow->bulan, 10)) ?> </b> Tahun <b>{{$dataWinnerNow->tahun}}</b>
                    </div>
                <?php } ?>
            <?php } ?>
            <div class="row">
                <div class="col-md-8">
                    <h4>List Pemenang Konsumen Terbaik</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Periode</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listWinner as $row)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$row->full_name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>
                                        Bulan <b><?= date("F", mktime(0, 0, 0, $dataWinnerNow->bulan, 10)) ?> </b> Tahun <b>{{$dataWinnerNow->tahun}}</b>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4">
                    <h4>Hadiah konsumen terbaik</h4>
                    <div class="table-responsive ">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Periode</th>
                                    <th scope="col">Hadiah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listReward as $row)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>Bulan <b><?= date("F", mktime(0, 0, 0, $dataWinnerNow->bulan, 10)) ?> </b> Tahun <b>{{$dataWinnerNow->tahun}}</b></td>
                                    <td>
                                        <ul>
                                            @php
                                            $splitReward = explode(',',$row->hadiah);
                                            for($i = 0;$i < count($splitReward); $i++){ @endphp <li><?= $splitReward[$i] ?></li>
                                                @php } @endphp </ul>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection