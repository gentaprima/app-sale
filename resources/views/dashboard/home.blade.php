@extends('master_dashboard')

@section('title','Dashboard')
@section('content')
<div class="content-wrapper">

    <div class="row">
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{count($dataProduct)}}</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-danger ">
                                <span class="mdi mdi-equal-box icon-item"></span>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal mt-3">Jumlah Produk</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{count($dataUsers)}}</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-warning">
                                <span class="mdi mdi-account-card-details icon-item"></span>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal mt-3">Jumlah Member</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{count($dataTransactionMember)}}</h3>
                                
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-info menu-icon">
                                <span class="mdi mdi-arrow-bottom-left "></span>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal mt-3">Jumlah Transaksi (Member)</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{count($dataTransactionNonMember)}}</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success menu-icon">
                                <span class="mdi mdi-cash-usd"></span>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal mt-3">Jumlah Transaksi (Non Member)</h6>
                </div>
            </div>
        </div>
    </div>

   


</div>
@endsection