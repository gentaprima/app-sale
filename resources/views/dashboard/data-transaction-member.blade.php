@extends('master_dashboard')

@section('title','Data Transaksi Member')
@section('content')
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">Data Transaksi Member</h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Transaksi Member</li>
      </ol>
    </nav>
  </div>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped dataTable js-basic-example mt-3">
              <thead>
                <tr>
                  <th> # </th>
                  <th> ID Order </th>
                  <th> Nama Pemesan </th>
                  <th> Tanggal </th>
                  <th> Subtotal </th>
                  <th> Aksi </th>
                </tr>
              </thead>
              <tbody>
                @foreach($dataTransaction as $row)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$row->id_order}}</td>
                  <td>{{$row->full_name}}</td>
                  <td>{{$row->date}}</td>
                  <td>@php echo number_format($row->subtotal, 2, ".", ","); @endphp</td>
                  </center>
                  <td>
                    <center>
                      <span data-toggle="modal" data-target="#modalDetail">
                        <button id="btn_verif" onclick="detailOrder('{{$row->id_order}}')" type="button" class="btn btn-inverse-primary btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Detail Transaksi">
                          <i class="mdi mdi-account-card-details"></i>
                        </button>
                      </span>
                      <span>
                        <a href="/dashboard/print-faktur-member/{{$row->id_order}}" target="_blank" id="btn_verif" style="padding-top:12px;"  class="btn btn-inverse-success btn-rounded btn-icon">
                          <i class="mdi mdi-printer"></i>
                        </a>
                      </span>
                      <!-- <span data-toggle="modal" data-target="#modalDelete">
                        <button type="button" onclick="" class="btn btn-inverse-danger btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Delete Data">
                          <i class="mdi mdi-delete"></i>
                        </button>
                      </span> -->
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

<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="width: 800px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Detail Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>Detail Pemesan</h4>
        <div class="row mt-5">
          <div class="col-sm-3">
            <p>Nama Pembeli</p>
            <p class="font-weight-bold" id="fullName"></p>
          </div>
          <div class="col-sm-3">
            <p>Email</p>
            <p class="font-weight-bold" id="email"></p>
          </div>
          <div class="col-sm-3">
            <p>No Telepon</p>
            <p class="font-weight-bold" id="phoneNumber"></p>
          </div>
          <div class="col-sm-3">
            <p>alamat</p>
            <p class="font-weight-bold" id="alamat"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-3">
            <p>Provinsi</p>
            <p class="font-weight-bold" id="provinsi"></p>
          </div>
          <div class="col-sm-3">
            <p>Kecamatan</p>
            <p class="font-weight-bold" id="kecamatan"></p>
          </div>
          <div class="col-sm-3">
            <p>Kabupaten</p>
            <p class="font-weight-bold" id="kabupaten"></p>
          </div>
          <div class="col-sm-3">
            <p>Ekspedisi</p>
            <p class="font-weight-bold" id="expedition"></p>
          </div>

        </div>
        <hr>
        <h4>Detail Pesanan</h4>
        <table id="tableData" class="table table-bordered mt-3">
          <thead>

            <tr>
              <th>#</th>
              <th>Nama Produk</th>
              <th>Harga</th>
              <th>Qty</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
          <tfoot>
            <tr>
              <th colspan="4">Diskon</th>
              <th id="discount"></th>
            </tr>
            <tr>
              <th colspan="4">SubTotal</th>
              <th id="subTotal"></th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
{{-- <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <label for="inputPassword" class="col-sm-2 col-form-label">Nama Produk</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="productName" value="{{old('productName')}}" name="productName" placeholder="Nama Produk">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Deskripsi</label>
            <div class="col-sm-10">
              <textarea type="text" class="form-control" id="description" value="{{old('description')}}" name="description" placeholder="Deskripsi"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Harga</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="price" value="{{old('price')}}" name="price" placeholder="Harga">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Foto</label>
            <div class="col-sm-10">
              <input type="file" name="image" class="file-upload-default">
              <div class="input-group col-xs-12">
                <input type="text" id="imageText" class="form-control file-upload-info" disabled placeholder="Upload Image">
                <span class="input-group-append">
                  <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                </span>
              </div>
              <p class="mt-3" id="textPhoto">(Optional) Kosongkan bila tidak ingin mengubah foto</p>
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
</div> --}}
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
  function detailOrder(id) {
    $("#tableData tbody").empty();
    $.ajax({
      dataType: 'html',
      type: 'get',
      url: `/dashboard/get-detail-order/${id}`,
      success: function(response) {
        let data = JSON.parse(response);
        document.getElementById('fullName').innerHTML = data.data['full_name'];
        document.getElementById('email').innerHTML = data.data['email'];
        document.getElementById('phoneNumber').innerHTML = data.data['phone_number'];
        document.getElementById('alamat').innerHTML = data.data['alamat'];
        document.getElementById('provinsi').innerHTML = data.data['provinsi'];
        document.getElementById('kecamatan').innerHTML = data.data['kecamatan'];
        document.getElementById('kabupaten').innerHTML = data.data['kabupaten'];
        document.getElementById('expedition').innerHTML = data.data['expedition'];
      }
    })


    $.ajax({
      dataType: 'html',
      type: 'get',
      url: `/dashboard/get-detail-order-all/${id}`,
      success: function(response) {
        let data = JSON.parse(response);
        let k = 1;
        for (let i = 0; i < data.data.length; i++) {
          var tr = $("<tr>");
          tr.append("<td>" + k++ + "</td>");
          tr.append("<td>" + data.data[i].product_name + "</td>");
          tr.append("<td>" + (data.data[i].price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + "</td>");
          tr.append("<td>" + (data.data[i].qty) + "</td>");
          tr.append("<td>" + (data.data[i].total).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + "</td>");

          $("#tableData").append(tr);
        }
        document.getElementById('subTotal').innerHTML = (data.data[0].subtotal).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        document.getElementById('discount').innerHTML = (data.data[0].discount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
      }
    })



  }
</script>

@endsection