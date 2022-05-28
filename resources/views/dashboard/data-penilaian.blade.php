@extends('master_dashboard')

@section('title','Data Penilaian Alternatif')
@section('content')
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">Data Alternatif Pelanggan terbaik bulan ini</h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Alternatif Pelanggan terbaik bulan ini</li>
      </ol>
    </nav>
  </div>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th> # </th>
                  <th> Nama Lengkap </th>
                  <th> Volume Belanja </th>
                  <th> Total Belanja </th>
                  <th> Ekspedisi </th>
                  <!-- <th> Aksi </th> -->
                </tr>
              </thead>
              <tbody>
                @foreach($dataPenilaian as $row)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$row->full_name}}</td>
                  <td>{{$row->volume_belanja}}</td>
                  <td>{{$row->total_belanja}}</td>
                  <td>{{$row->ekspedisi}}</td>

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
            <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="email" value="{{old('email')}}" name="email" placeholder="Email">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="fullName" value="{{old('fullName')}}" name="fullName" placeholder="Nama Lengkap">
            </div>
          </div>
         
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">No Telepon</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="phoneNumber" value="{{old('phoneNumber')}}" name="phoneNumber" placeholder="No Telepon">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="alamat" value="{{old('alamat')}}" name="alamat" placeholder="Alamat">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Kecamatan</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="kecamatan" value="{{old('kecamatan')}}" name="kecamatan" placeholder="Kecamatan">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Kabupaten</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="kabupaten" value="{{old('kabupaten')}}" name="kabupaten" placeholder="Kabupaten">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Provinsi</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="provinsi" value="{{old('provinsi')}}" name="provinsi" placeholder="provinsi">
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
<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width: 800px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Detail Pelanggan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
        <div class="row">
            <div class="col-4" style="padding:50px;">
                <img src="" id="detailPhoto" alt="" style="width: 90%;">
            </div>
            <div class="col-8">
                <div class="row mt-5">
                    <div class="col-6">
                        <p>Email</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold" id="detailEmail"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p>Nama Lengkap</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold" id="detailFullName"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p>No Telepon</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold" id="detailPhonenumber"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p>Alamat</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold" id="detailAlamat"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p>Kecamatan</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold" id="detailKecamatan"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p>Kabupaten</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold" id="detailKabupaten"></p>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-6">
                        <p>Provinsi</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold" id="detailProvinsi"></p>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>


  
</script>

@endsection