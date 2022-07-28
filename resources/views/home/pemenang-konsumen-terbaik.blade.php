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
                <?php if ($dataWinnerNow != null) { ?>
                    <?php if ($dataWinnerNow->id_users == Session::get('dataUsers')->id) { ?>
                        <div class="alert alert-success">
                            Selamat Anda Telah menjadi pemenang konsumen terbaik toko kami periode Bulan <b><?= date("F", mktime(0, 0, 0, $dataWinnerNow->bulan, 10)) ?> </b> Tahun <b>{{$dataWinnerNow->tahun}}</b>
                        </div>
                    <?php } ?>
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
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listWinner as $row)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$row->full_name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>
                                        <?php if ($row != null) { ?>
                                            Bulan <b><?= date("F", mktime(0, 0, 0, $row->bulan, 10)) ?> </b> Tahun <b>{{$row->tahun}}</b>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <span data-toggle="modal" data-target="#modalDetail">
                                            <button id="btn_verif" onclick="showKriteria('{{$row->id_users}}')" type="button" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Kriteria Pemenang">
                                                <i class="fa fa-table"></i>
                                            </button>
                                        </span>
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
                                    <td>
                                        <?php if ($row != null) { ?>
                                            Bulan <b><?= date("F", mktime(0, 0, 0, $row->bulan, 10)) ?> </b> Tahun <b>{{$row->tahun}}</b>
                                        <?php } ?>
                                    </td>
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

<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Detail Kriteria Pemenang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>  
            <div class="modal-body">
                <div class="row mt-3">
                    <div class="col-sm-4">
                        <p>Total Belanja</p>
                    </div>
                    <div class="col-sm-8">
                        <p class="font-weight-bold" id="totalBelanja"></p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-4">
                        <p>Volume Belanja</p>
                    </div>
                    <div class="col-sm-8">
                        <p class="font-weight-bold" id="volumeBelanja"></p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-4">
                        <p>Ekspedisi</p>
                    </div>
                    <div class="col-sm-8">
                        <p class="font-weight-bold" id="ekspedisi"></p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-4">
                        <p>Rating</p>
                    </div>
                    <div class="col-sm-8">
                        <p class="font-weight-bold" id="rating"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showKriteria(id){
        $.ajax({
            url:`/show-kriteria/${id}`,
            type:'GET',
            dataType:'json',
            success : function(response){
                document.getElementById("volumeBelanja").innerHTML =  response.volume_belanja
                document.getElementById("totalBelanja").innerHTML =  response.total_belanja
                document.getElementById("rating").innerHTML =  response.rating
                document.getElementById("ekspedisi").innerHTML =  response.ekspedisi
            }
        })
    }
</script>

@endsection