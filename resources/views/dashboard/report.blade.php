@extends('master_dashboard')

@section('title')
    Laporan Penjualan Member Bulan <?= $month ?>
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Laporan Bulan {{$month}}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan</li>
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
                            @php if($filterMonth == null){ @endphp
                            <button data-toggle="modal" data-target="#modalFilter" class="btn btn-primary size-btn mx-1"><i class="fa fa-filter"></i> Filter</button>
                            @php }else{ @endphp
                            <a href="/dashboard/report-member" class="btn btn-primary size-btn mx-1"><i class="fa fa-filter"></i>Reset Filter</a>
                            @php } @endphp
                        </div>
                        <div class="ms-md-auto d-flex">
                            <div class="input-group" style="margin-right: 10px;width:100%;z-index:1">
                                <span class="input-group-text text-body" style="background-color: #2A3038;border-color:#2A3038;"><i class="fas fa-search" aria-hidden="true"></i></span>
                                <input type="text" style="width: 250px;" id="searchBox" class="form-control" placeholder="Cari Data">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="table" class="table table-striped dataTable mt-3">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> ID Order </th>
                                    <th> Nama Pemesan </th>
                                    <th> Produk </th>
                                    <th> Ekspedisi </th>
                                    <th> Subtotal </th>
                                    <th> Tanggal </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataTransaction as $row)
                                @php
                                $productName = $row->product_name;
                                $qty = $row->qty;
                                $splitProduct = explode(',',$productName);
                                $splitQty = explode(',',$qty);
                                @endphp
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$row->id_order}}</td>
                                    <td>{{$row->full_name}}</td>
                                    <td width="50%">
                                        <?php for ($i = 0; $i < count($splitProduct); $i++) { ?>
                                            <?= $splitProduct[$i] ?> = <?= $splitQty[$i] ?> pcs <br>
                                        <?php } ?>
                                    </td>
                                    <td>{{$row->expedition}}</td>
                                    <td>Rp @php echo number_format($row->subtotal, 2, ".", ","); @endphp</td>
                                    <td>{{$row->date}}</td>
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

<div class="modal fade" id="modalFilter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Filter Periode/Bulan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" method="get" id="form" method="get">
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Tanggal</label>
                            <input type="number" class="form-control" id="day" name="day">
                        </div>
                        <div class="col-sm-3">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Bulan</label>
                            <input type="number" class="form-control" id="month" name="month">
                        </div>
                        <div class="col-sm-5">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Tahun</label>
                            <input type="number" class="form-control" id="year" value="{{Date('Y')}}" name="year">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection