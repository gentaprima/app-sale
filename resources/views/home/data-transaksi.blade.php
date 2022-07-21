@extends('master_home')
@section('content')
<?php

use Illuminate\Support\Facades\Session;

?>
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
  <div class="container">
    <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
      <div class="col-first">
        <h1>Riwayat Transaksi</h1>
        <nav class="d-flex align-items-center">
          <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
          <a href="#">Riwayat Transaksi</a>
        </nav>
      </div>
    </div>
  </div>
</section>
<!-- End Banner Area -->

<!--================Login Box Area =================-->
<section class="login_box_area section_gapp">
  <div class="container">
    <div class="cart_inner">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">ID Pesanan</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Status</th>
              <th scope="col">Rating</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($dataTransaction as $row)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td class="font-weight-bold"> {{$row->id_order}} </td>
              <td>
                <h5>{{$row->date}}</h5>
              </td>
              <td>
                @php if($row->status == 1){ @endphp
                <span class="badge badge-warning">Menunggu Diterima</span>
                @php }else{ @endphp
                <span class="badge badge-success">Selesai</span>
                @php } @endphp
              </td>
              <td>
                @php if($row->status == 2){ @endphp
                  @php if($row->rating == 0){ @endphp
                  <button style="background: none;border:none;" onclick="addRating('{{$row->id_order}}')" data-toggle="modal" data-target="#modalRating"><b>Klik untuk kirim rating dan ulasan</b></button>
                  @php }else{ @endphp
                      @php for($i = 0; $i < $row->rating;$i++){ @endphp
                      <span class="icon">★</span>
                      @php } @endphp
                  @php } @endphp
                @php } @endphp
              </td>
              <td>
                @php if($row->status == 1){ @endphp
                <button data-toggle="modal" data-target="#modalConfirm" onclick="confirmOrder('{{$row->id_order}}')" class="btn btn-outline-default btn-sm"><i class="fa fa-check"></i></button>
                @php } @endphp
                <button data-toggle="modal" data-target="#modalDetail" onclick="detailOrder('{{$row->id_order}}')" class="btn btn-outline-default btn-sm"><i class="fa fa-eye"></i></button>
              </td>

            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
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
<div class="modal fade" id="modalConfirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Konfirmasi Pesanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Anda yakin ingin mengkonfirmasi pesanan diterima?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a id="btnConfirm" type="button" class="btn btn-primary">Konfirmasi</a>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalRating" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Rating dan Ulasan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formRating" action="/add-rating" method="post">
          @csrf
          <div class="form-group row">
            <label for="" class="col-sm-1">Rating</label>
            <div class="col-sm-11">
              <center>
                <div class="rating">
                  <label>
                    <input required type="radio" name="rating" value="1" />
                    <span class="icon">★</span>
                  </label>
                  <label>
                    <input required type="radio" name="rating" value="2" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                  </label>
                  <label>
                    <input required type="radio" name="rating" value="3" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                  </label>
                  <label>
                    <input required type="radio" name="rating" value="4" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                  </label>
                  <label>
                    <input required type="radio" name="rating" value="5" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                  </label>
                </div>
              </center>
            </div>

          </div>
          <div class="form-group row">
            <label for="" class="col-sm-2">Ulasan</label>
            <div class="col-sm-10">
              <textarea required type="text" class="form-control" name="ulasan"></textarea>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Konfirmasi</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function confirmOrder(id) {
    document.getElementById("btnConfirm").href = `/confirmOrder/${id}`
  }

  function addRating(id) {
    document.getElementById("formRating").action = `/add-rating/${id}`
  }

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
        document.getElementById('expedition').innerHTML = data.data['description'];
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