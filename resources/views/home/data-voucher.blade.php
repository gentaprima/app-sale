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
                <h1>Voucher</h1>
                <nav class="d-flex align-items-center">
                    <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#">Voucher</a>
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
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kode Voucher</th>
                            <th scope="col">Voucher</th>
                            <th scope="col">Aktif</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataVoucher as $row)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td class="font-weight-bold"> {{$row->code_voucher}} </td>
                            <td>
                                <h5>{{$row->description}}</h5>
                            </td>
                            <td>
                                @php if($row->expired_in >= date('Y-m-d')){ @endphp
                                    Aktif sampai <b> <?= date_format(date_create($row->expired_in),'d F Y') ?> </b>
                                @php }else{ @endphp
                                    <span class="badge badge-danger">Sudah Kadaluarsa</span> 
                                @php } @endphp
                            </td>
                            <td>
                                <?php if($row->is_use == 0){ ?>
                                    <button class="btn btn-outline-primary btn-sm">Belum digunakan</button>
                                <?php }else{ ?>
                                    <button class="btn btn-outline-success btn-sm">Sudah digunakan</button>
                                <?php } ?>
                            </td>
                            
                        </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection