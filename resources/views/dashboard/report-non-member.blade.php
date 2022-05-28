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
                    <div class="table-responsive">
                        <table class="table table-striped dataTable js-exportable mt-3">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> ID Order </th>
                                    <th> Nama Pemesan </th>
                                    <th> Produk </th>
                                    <th> Subtotal </th>
                                    <th> Ekspedisi </th>
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