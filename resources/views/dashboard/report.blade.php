@extends('master_dashboard')

@section('title','Laporan')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Laporan</h3>
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
                            <button id="pdf" class="btn btn-outline-primary size-btn">PDF</button>
                            <button id="excel" class="btn btn-outline-primary size-btn">EXCEL</button>
                            <button id="print" class="btn btn-outline-primary size-btn">PRINT</button>

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

@endsection