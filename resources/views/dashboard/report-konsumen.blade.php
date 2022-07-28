@extends('master_dashboard')

@section('title','Laporan')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Laporan Pemenang Konsumen Terbaik</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan Pemenang Konsumen Terbaik</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="input-group">
                            <button id="copy" class="btn btn-primary size-btn mx-1">COPY</button>
                            <button id="csv" class="btn btn-primary size-btn mx-1">CSV</button>
                            <button id="excel" class="btn btn-primary size-btn mx-1">EXCEL</button>
                            <button id="pdf" class="btn btn-primary size-btn mx-1">PDF</button>
                            <button id="print" class="btn btn-primary size-btn mx-1">PRINT</button>
                        </div>
                        <div class="ms-md-auto d-flex">
                            <div class="input-group" style="margin-right: 10px;width:100%;z-index:1">
                                <span class="input-group-text text-body" style="background-color: #2A3038;border-color:#2A3038;"><i class="fas fa-search" aria-hidden="true"></i></span>
                                <input type="text" style="width: 250px;" id="searchBox" class="form-control" placeholder="Cari Data">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped dataTable " id="table">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Email </th>
                                    <th> Nama Konsumen </th>
                                    <th> No Telepon </th>
                                    <th> Alamat </th>
                                    <th> Kecamatan </th>
                                    <th> Kabupaten </th>
                                    <th> Provinsi </th>
                                    <th> Periode </th>
                                    <th> Hadiah </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataWinner as $row)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>{{$row->full_name}}</td>
                                    <td>{{$row->phone_number}}</td>
                                    <td>{{$row->alamat}}</td>
                                    <td>{{$row->kecamatan}}</td>
                                    <td>{{$row->kabupaten}}</td>
                                    <td>{{$row->provinsi}}</td>
                                    <td>Bulan <b><?= date("F", mktime(0, 0, 0, $row->bulan, 10)) ?> </b> tahun <b>{{$row->tahun}}</td>
                                    <td>{{$row->hadiah}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->

</div>


@endsection