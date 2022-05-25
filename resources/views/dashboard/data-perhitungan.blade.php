@extends('master_dashboard')

@section('title','Data Pelanggan Terbaik')
@section('content')
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">Data Perhitungan Pelanggan Tebaik</h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Perhitungan Pelanggan Tebaik</li>
      </ol>
    </nav>
  </div>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <a href="#" data-toggle="modal" data-target="#modalDelete" style="float: right;" type="a" class="btn btn-outline-success mb-5">Hitung Normalisasi</a>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th> # </th>
                  <th> Nama Lengkap </th>
                  <th> Email </th>
                  <th> Volume Belanja </th>
                  <th> Total Belanja </th>
                  <th> Hasil </th>
                  <!-- <th> Aksi </th> -->
                </tr>
              </thead>
              <tbody>
                @foreach($dataPerhitungan as $row)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$row->full_name}}</td>
                  <td>{{$row->email}}</td>
                  <td>{{$row->n_volume_belanja}}</td>
                  <td>{{$row->n_total_belanja}}</td>
                  <td>{{$row->n_total}}</td>

                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="alert alert-success mt-5">Berdasarkan perhitungan menggunakan metode Waspas, Pelanggan terbaik jatuh pada : <span class="font-weight-bold">{{$dataPerhitungan[0]->full_name}}</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->

</div>

<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " style="width: 800px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Hitung Nromalisasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Anda yakin ingin menghitung pelanggan terbaik bulan ini?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="/dashboard/calculate-normalisasi" class="btn btn-primary">Hitung</a>
        </form>
      </div>
    </div>
  </div>
</div>

<script>



</script>

@endsection