@extends('master_dashboard')

@section('title', 'Data Produk')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Data Produk</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Produk</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <button type="button" onclick="addProduct()" class="btn btn-outline-primary mb-5"
                            data-toggle="modal" data-target="#modalForm">Tambah Data</button>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Nama Produk </th>
                                        <th> Deskripsi </th>
                                        <th> Harga </th>
                                        <th> Foto </th>
                                        <th> Aksi </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataProduct as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->product_name }}</td>
                                            <td>{{ $row->product_desc }}</td>
                                            <td>{{ $row->price }}</td>
                                            <td>
                                                <center><a href="" data-target="#modalPhoto"
                                                        onclick="seePhoto(`{{ asset('uploads/product/') }}`,`{{ $row->image }}`)"
                                                        data-toggle="modal" class="btn btn-outline-success btn-sm">Lihat
                                                        foto</a>
                                            </td>
                                            </center>
                                            <td>
                                                <center>
                                                    <span data-toggle="modal" data-target="#modalForm">
                                                        <button id="btn_verif" data-desc='{{ $row->product_desc }}'
                                                            onclick="updateData('{{ $row->id }}','{{ $row->product_name }}','{{ $row->price }}','{{ $row->image }}')"
                                                            type="button"
                                                            class="btn btn-inverse-success btn-rounded btn-icon"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Ubah Data Produk">
                                                            <i class="mdi mdi-pencil-box-outline"></i>
                                                        </button>
                                                    </span>
                                                    <span data-toggle="modal" data-target="#modalDelete">
                                                        <button type="button"
                                                            onclick="deleteProduct('{{ $row->id }}')"
                                                            class="btn btn-inverse-danger btn-rounded btn-icon"
                                                            data-toggle="tooltip" data-placement="top" title="Delete Data">
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
                    <h5 class="modal-title" id="modalTitle">Tambah Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" enctype="multipart/form-data" method="post" id="form"
                        action="/add-product">
                        @csrf
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Nama Produk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="productName" value="{{ old('productName') }}"
                                    name="productName" placeholder="Nama Produk">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" id="description" value="{{ old('description') }}" name="description"
                                    placeholder="Deskripsi"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Harga</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="price" value="{{ old('price') }}"
                                    name="price" placeholder="Harga">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <input type="file" name="image" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" id="imageText" class="form-control file-upload-info" disabled
                                        placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    </span>
                                </div>
                                <p class="mt-3" id="textPhoto">(Optional) Kosongkan bila tidak ingin mengubah foto
                                </p>
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
    <div class="modal fade" id="modalPhoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" style="width: 800px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Foto Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding:100px;">
                    <center>
                        <img src="" style="width:80%;" alt="" id="imageProduct">
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            document.getElementById('productName').value = '';
            document.getElementById('description').value = '';
            document.getElementById('price').value = '';
            document.getElementById('imageText').value = '';
            document.getElementById('modalTitle').innerHTML = 'Tambah Produk';
            document.getElementById('form').action = '/add-product';
            document.getElementById('textPhoto').hidden = true;
        }

        function updateData(id, productName, description, price, image) {
            document.getElementById('textPhoto').hidden = false;
            document.getElementById('productName').value = productName;
            document.getElementById('description').value = $('#btn_verif').data("desc");
            document.getElementById('price').value = price;
            document.getElementById('imageText').value = image;
            document.getElementById('modalTitle').innerHTML = 'Perbarui Produk';
            document.getElementById('form').action = `/update-product/${id}`;
        }

        function deleteProduct(id) {
            document.getElementById('btnDelete').href = `/delete-product/${id}`;
        }

        function seePhoto(loc, image) {
            document.getElementById('imageProduct').src = loc + '/' + image;
        }
    </script>

@endsection
