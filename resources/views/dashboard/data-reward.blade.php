@extends('master_dashboard')

@section('title','Data Hadiah')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Data Hadiah</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Hadiah</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <button type="button" onclick="addProduct()" class="btn btn-outline-primary mb-5" data-toggle="modal" data-target="#modalForm">Tambah Data</button>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Bulan </th>
                                    <th> Tahun </th>
                                    <th> Hadiah </th>
                                    <th> Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataReward as $row)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><?= date("F", mktime(0, 0, 0, $row->bulan, 10)) ?></td>
                                    <td>{{$row->tahun}}</td>
                                    <td>
                                        <ul>
                                            @php
                                            $splitReward = explode(',',$row->hadiah);
                                            for($i = 0;$i < count($splitReward); $i++){
                                            @endphp
                                            <li><?= $splitReward[$i] ?></li>    
                                            @php } @endphp </ul>
                                    </td>
                                    </center>
                                    <td>
                                        <center>
                                            <span data-toggle="modal" data-target="#modalForm">
                                                <button id="btn_verif" onclick="updateData('{{$row->id}}','{{$row->bulan}}','{{$row->tahun}}','{{$row->hadiah}}')" type="button" class="btn btn-inverse-success btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Ubah Data Kriteria">
                                                    <i class="mdi mdi-pencil-box-outline"></i>
                                                </button>
                                            </span>
                                            <span data-toggle="modal" data-target="#modalDelete">
                                                <button type="button" onclick="deleteProduct('{{$row->id}}')" class="btn btn-inverse-danger btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Delete Data">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </span>
                                        </center>
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
    <!-- content-wrapper ends -->

</div>

<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Hadiah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" enctype="multipart/form-data" method="post" id="form" action="/add-reward">
                    @csrf
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Bulan</label>
                        <div class="col-sm-10">
                            <input type="month" class="form-control" required id="month" value="{{old('month')}}" name="month" placeholder="month">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Hadiah</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" required id="hadiah" value="{{old('hadiah')}}" name="hadiah" placeholder="Hadiah">
                            <p>Jika hadiah lebih dari 1, mohon pisahkan dengan ",". Contoh : "Kipas,TV"</p>
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
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " style="width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Hapus Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Anda yakin ingin menghapus data tersebut?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a id="btnDelete" class="btn btn-primary">Hapus</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function addProduct() {
        document.getElementById('month').value = '';
        document.getElementById('hadiah').value = '';
        document.getElementById('modalTitle').innerHTML = 'Tambah Hadiah';
        document.getElementById('form').action = '/dashboard/add-reward';
    }

    function updateData(id, bulan, tahun, hadiah) {
        if(bulan.length == 1){
            bulan = "0"+bulan
        }
        document.getElementById('hadiah').value = hadiah;
        document.getElementById('month').value = tahun+'-'+bulan;
        document.getElementById('modalTitle').innerHTML = 'Perbarui Hadiah';
        document.getElementById('form').action = `/dashboard/update-reward/${id}`;
    }

    function deleteProduct(id) {
        document.getElementById('btnDelete').href = `/dashboard/delete-reward/${id}`;
    }
</script>

@endsection