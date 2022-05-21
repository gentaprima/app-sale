@extends('master_dashboard')

@section('title','Data Ekspedisi')
@section('content')
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">Data Ekspedisi</h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Ekspedisi</li>
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
                  <th> Ekspedisi </th>
                  <th> Aksi </th>
                </tr>
              </thead>
              <tbody>
                @foreach($dataExpedisi as $row)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$row->expedition}}</td>
                  </center>
                  <td>
                    <center>
                      <span data-toggle="modal" data-target="#modalForm">
                        <button id="btn_verif" onclick="updateData('{{$row->id}}','{{$row->expedition}}')" type="button" class="btn btn-inverse-success btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Ubah Data Produk">
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
        <h5 class="modal-title" id="modalTitle">Tambah Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form" enctype="multipart/form-data" method="post" id="form" action="/add-product">
          @csrf
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Nama Ekspedisi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="expedition" value="{{old('expedition')}}" name="expedition" placeholder="Nama Ekspedisi">
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
      <div class="modal-body" >
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
    document.getElementById('expedition').value = '';
    document.getElementById('modalTitle').innerHTML = 'Tambah Ekspedisi';
    document.getElementById('form').action = '/dashboard/add-expedition';
    document.getElementById('textPhoto').hidden = true;
  }
  
  function updateData(id,expedition){
    document.getElementById('expedition').value = expedition;
    document.getElementById('modalTitle').innerHTML = 'Perbarui Ekspedisi';
    document.getElementById('form').action = `/dashboard/update-expedition/${id}`;
  }

  function deleteProduct(id){
    document.getElementById('btnDelete').href = `/dashboard/delete-expedition/${id}`;
  }

  function seePhoto(loc, image) {
    document.getElementById('imageProduct').src = loc + '/' + image;
  }
</script>

@endsection