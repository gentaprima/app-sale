@extends('master_dashboard')

@section('title','Data Kriteria')
@section('content')
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">Data Kriteria</h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Kriteria</li>
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
                  <th> Kriteria </th>
                  <th> Jenis </th>
                  <th> Bobot </th>
                  <th> Aksi </th>
                </tr>
              </thead>
              <tbody>
                @foreach($dataKriteria as $row)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$row->kriteria}}</td>
                  <td>{{$row->jenis}}</td>
                  <td>{{$row->bobot}}</td>
                  </center>
                  <td>
                    <center>
                      <span >
                        <a href="/dashboard/data-subkriteria/{{$row->id}}" id="btn_verif"  class="btn btn-inverse-primary btn-rounded btn-icon " style="padding-top:12px !important;" data-toggle="tooltip" data-placement="top" title="Data Sub Kriteria">
                          <i class="mdi mdi-table"></i>
                        </a>
                      </span>
                      <span data-toggle="modal" data-target="#modalForm">
                        <button id="btn_verif" onclick="updateData('{{$row->id}}','{{$row->kriteria}}','{{$row->jenis}}','{{$row->bobot}}')" type="button" class="btn btn-inverse-success btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Ubah Data Produk">
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
            <div class="alert alert-warning mt-5"><span class="font-weight-bold">Pemberitahuan!</span> total nilai bobot tidak boleh melebihi 1</div>
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
            <label for="inputPassword" class="col-sm-2 col-form-label">Kriteria</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" required id="kriteria" value="{{old('kriteria')}}" name="kriteria" placeholder="Kriteria">
            </div>
          </div>
          <div class="form-group row">
              <label for="inputPassword" class="col-sm-2 col-form-label">Jenis</label>
              <div class="col-sm-10">
                  <select  class="form-control" id="jenis" required value="{{old('jenis')}}" name="jenis">
                      <option value="">-- Pilih Jenis --</option>
                      <option value="Benefit">Benefit</option>
                      <option value="Cost">Cost</option>
                  </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Bobot</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" required id="bobot" value="{{old('bobot')}}" name="bobot" placeholder="Bobot">
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
    document.getElementById('kriteria').value = '';
    document.getElementById('bobot').value = '';
    document.getElementById('jenis').value = '';
    document.getElementById('modalTitle').innerHTML = 'Tambah Kriteria';
    document.getElementById('form').action = '/dashboard/add-kriteria';
  }
  
  function updateData(id,kriteria,jenis,bobot){
    document.getElementById('kriteria').value = kriteria;
    document.getElementById('bobot').value = bobot;
    document.getElementById('jenis').value = jenis;
    document.getElementById('modalTitle').innerHTML = 'Perbarui Kriteria';
    document.getElementById('form').action = `/dashboard/update-kriteria/${id}`;
  }

  function deleteProduct(id){
    document.getElementById('btnDelete').href = `/dashboard/delete-kriteria/${id}`;
  }

 
</script>

@endsection