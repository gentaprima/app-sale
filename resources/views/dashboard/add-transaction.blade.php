@extends('master_dashboard')

@section('title','Tambah Pembelian')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Tambah Pembelian</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Pembelian</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Tambah Pembelian</h4>
                    <form action="/dashboard/add-transaction" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tipe Pelanggan</label>
                            <div class="col-sm-5">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" onclick="checkMember(this)" id="radioNonMember" value="0">Non Member<i class="input-helper"></i></label>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" onclick="checkMember(this)" id="radioMember" value="1">Member <i class="input-helper"></i></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" hidden="true" id="selectMember">
                            <label class="col-sm-2 col-form-label">Pilih Member</label>
                            <div class="col-sm-10">
                                <select class="form-control js-example-basic-single" id="number1" name="idUsers" style="width: 100%;" onchange="selectMember(this)" id="exampleFormControlSelect2">
                                    <option value="">-- Pilih Member -- </option>
                                    @foreach($dataMember as $row)
                                    <option value="{{$row->email}}">{{$row->full_name}} - {{$row->email}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Nama Lengkap</label>
                                    <div class="col-sm-8">
                                        <input type="text" required name="fullName" id="fullName" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" required name="email" id="email" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">No Telepon</label>
                                    <div class="col-sm-8">
                                        <input type="number" required name="phoneNumber" id="phoneNumber" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Alamat</label>
                                    <div class="col-sm-8">
                                        <input type="text" required name="alamat" id="alamat" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Provinsi</label>
                                    <div class="col-sm-8">
                                        <input type="text" required name="provinsi" id="provinsi" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Kecamatan</label>
                                    <div class="col-sm-8">
                                        <input type="text" required name="kecamatan" id="kecamatan" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Kabupaten</label>
                                    <div class="col-sm-8">
                                        <input type="text" required name="kabupaten" id="kabupaten" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Pilih Barang</label>
                            <div class="col-sm-3">
                                <select class="form-control js-example-basic-single" onchange="getPrice(this,'1')" id="barang1" style="width: 100%;" id="exampleFormControlSelect2" name="idProduct[]">
                                    <option value="">-- Pilih Barang -- </option>
                                    @foreach($dataProduct as $row)
                                    <option value="{{$row->id}}">{{$row->product_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" id="hargaHide1" name="price[]"">
                            <input type="hidden" id="countForm" value="1">
                            <div class="col-sm-2">
                                <input type="text" min="1" placeholder="Harga" id="harga1" class="form-control readonly" readonly>
                            </div>
                            <div class="col-sm-1">
                                <input type="number" onchange="setTotalPrice(this,'1')" min="1" placeholder="qty" id="qty1" name="qty[]" class="form-control text-center">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" placeholder="Total" id="total1" class="form-control readonly" readonly>
                                <input type="hidden" id="totalHide1" name="total[]" class="form-control readonly" readonly>
                            </div>
                            <!-- <div class="col-sm-1">
                                <button type="button" onclick="removeFieldForm()" id="delete1" class="btn btn-inverse-danger btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button>
                            </div> -->
                        </div>
                        <div id="group">

                        </div>

                        <div class="form-group row" id="groupAdd">
                            <label for="gaji" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <!-- <input type="date" class="form-control" multiple id="sampai_tanggal" name="sampai_tanggal"> -->
                                <button onclick="addForm()" type="button" class="btn btn-outline-primary mt-3" style="cursor: pointer;"> + klik untuk tambah barang</button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2">Pilih Ekpedisi</label>
                            <div class="col-sm-10">
                                <select name="idExpedition" required id="" class="form-control">
                                    <option value="">-- Pilih Expedisi --</option>
                                    @foreach($dataExpedition as $row)
                                    <option value="{{$row->id}}">{{$row->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2">Bukti Transaksi</label>
                            <div class="col-sm-10">
                                <input type="file" required name="image" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" id="imageText" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Sub Total</label>
                            <div class="col-sm-10">
                                <input type="text" readonly id="subTotal" class="form-control readonly">
                                <input type="hidden" id="subTotalHide" name="subTotal">
                                <button type="button" onclick="calculateTotal()" class="btn btn-outline-success mt-3 mb-3">Hitung Sub total</button>
                                <p style="color: red;" id="messageNotif"></p>
                                <div class="form-check mt-3">
                                    <label class="form-check-label">
                                        <input type="checkbox" onclick="showFormVoucher(this)" value="1" id="checkboxDiscount" class="form-check-input"> Memiliki kode voucher? <i class="input-helper"></i></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row" id="formVoucher" hidden="true">
                            <label for="" class="col-sm-2 col-form-label">Voucher</label>
                            <div class="col-sm-10">
                                <!-- <input type="text" id="kodeVoucher" name="kodeVoucher" class="form-control mb-4"> -->
                                <select name="kodeVoucher" id="listVoucher" class="form-control" onchange="selectVoucher(this)">
                                    <option value="">-- Pilih Voucher --</option>
                                </select>

                            </div>

                            <!-- <button type="button" onclick="calculateDiscount()" class="btn btn-outline-success mb-3 mt-3">Proses Voucher</button>
                            <p style="color:red;" id="messageVoucher" hidden="true">Kode Voucher yang anda masukan tidak terdaftar disistem.</p> -->
                        </div>
                        <div class="form-group row" id="formDiscount" hidden="true">
                            <label for="" class="col-sm-2 col-form-label">Diskon</label>
                            <div class="col-sm-10">
                                <input type="text" id="discount" class="form-control readonly" readonly>
                                <input type="hidden" id="discountHide" name="discount" class="form-control readonly" readonly>
                            </div>
                        </div>
                        <div class="form-group row" id="formGrandTotal" hidden="true">
                            <label for="" class="col-sm-2 col-form-label">Total Pembayaran</label>
                            <div class="col-sm-10">
                                <input type="text" id="grandTotal" readonly class="form-control readonly">
                                <input type="hidden" name="grandTotal" id="grandTotalHide">
                            </div>
                        </div>
                        <hr>
                        <div class="form group row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <button class="btn btn-outline-success">Proses Transaksi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->

</div>
<script>
    function checkMember(check) {
        let checked = check.value;
        if (checked == 1) {
            document.getElementById("selectMember").hidden = false
            document.getElementById("radioNonMember").checked = false
        } else {
            document.getElementById("selectMember").hidden = true
            document.getElementById("radioMember").checked = false
        }
        lockInput(checked);
    }

    function lockInput(typeCustomers) {
        if (typeCustomers == 1) {
            document.getElementById('fullName').readOnly = true;
            document.getElementById('fullName').value = "";
            $("#fullName").addClass("readonly");
            document.getElementById('email').readOnly = true;
            document.getElementById('email').value = "";
            $("#email").addClass("readonly");
            document.getElementById('phoneNumber').readOnly = true;
            document.getElementById('phoneNumber').value = "";
            $("#phoneNumber").addClass("readonly");
            document.getElementById('alamat').readOnly = true;
            document.getElementById('alamat').value = "";
            $("#alamat").addClass("readonly");
            document.getElementById('provinsi').readOnly = true;
            document.getElementById('provinsi').value = "";
            $("#provinsi").addClass("readonly");
            document.getElementById('kecamatan').readOnly = true;
            document.getElementById('kecamatan').value = "";
            $("#kecamatan").addClass("readonly");
            document.getElementById('kabupaten').readOnly = true;
            document.getElementById('kabupaten').value = "";
            $("#kabupaten").addClass("readonly");
        } else {
            document.getElementById('fullName').readOnly = false;
            document.getElementById('fullName').value = "";
            $("#fullName").removeClass("readonly");
            document.getElementById('email').readOnly = false;
            document.getElementById('email').value = "";
            $("#email").removeClass("readonly");
            document.getElementById('phoneNumber').readOnly = false;
            document.getElementById('phoneNumber').value = "";
            $("#phoneNumber").removeClass("readonly");
            document.getElementById('alamat').readOnly = false;
            document.getElementById('alamat').value = "";
            $("#alamat").removeClass("readonly");
            document.getElementById('provinsi').readOnly = false;
            document.getElementById('provinsi').value = "";
            $("#provinsi").removeClass("readonly");
            document.getElementById('kecamatan').readOnly = false;
            document.getElementById('kecamatan').value = "";
            $("#kecamatan").removeClass("readonly");
            document.getElementById('kabupaten').readOnly = false;
            document.getElementById('kabupaten').value = "";
            $("#kabupaten").removeClass("readonly");
        }
    }

    function selectMember(select) {
        $.ajax({
            type: 'GET',
            dataType: 'html',
            url: `/dashboard/get-customer-by-email/${select.value}`,
            success: function(response) {
                let resp = JSON.parse(response);
                let id = resp.data['id'];
                document.getElementById('fullName').value = resp.data['full_name'];
                document.getElementById('email').value = resp.data['email'];
                document.getElementById('phoneNumber').value = resp.data['phone_number'];
                document.getElementById('alamat').value = resp.data['alamat'];
                document.getElementById('provinsi').value = resp.data['provinsi'];
                document.getElementById('kecamatan').value = resp.data['kecamatan'];
                document.getElementById('kabupaten').value = resp.data['kabupaten'];
                getVoucher(id);
            }

        })
    }

    function getPrice(price, idInputPrice) {
        $.ajax({
            type: 'GET',
            dataType: 'html',
            url: `/dashboard/get-product-by-id/${price.value}`,
            success: function(response) {
                let resp = JSON.parse(response);
                document.getElementById('harga' + idInputPrice).value = 'Rp ' + resp.data.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                document.getElementById('hargaHide' + idInputPrice).value = resp.data.price
            }

        })
    }

    function setTotalPrice(qty, idInputTotal) {
        let price = document.getElementById('hargaHide' + idInputTotal).value;
        console.log(qty.value * price);
        document.getElementById('totalHide' + idInputTotal).value = qty.value * price
        document.getElementById('total' + idInputTotal).value = 'Rp ' + (qty.value * price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function addForm() {
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
        let countForm = document.getElementById("countForm").value;
        document.getElementById("countForm").value = parseInt(countForm) + 1;
        var formGroup = document.createElement('div');
        formGroup.setAttribute('class', 'form-group row')
        formGroup.setAttribute('id', 'form' + $("#countForm").val());
        var colFirst = document.createElement("label");
        colFirst.setAttribute('class', 'col-sm-2 col-form-label');
        colFirst.innerHTML = 'Pilih Barang';
        var colSecond = document.createElement("div");
        colSecond.setAttribute('class', 'col-sm-3');
        var tagSelect = document.createElement('select');
        tagSelect.setAttribute('class', 'form-control js-example-basic-single');
        tagSelect.setAttribute('id', 'barang' + $("#countForm").val())
        tagSelect.setAttribute('name', 'idProduct[]')
        tagSelect.setAttribute('onchange', 'getPrice(this,' + $("#countForm").val() + ')')
        selectData('barang' + $("#countForm").val());

        var colThird = document.createElement('div');
        colThird.setAttribute('class', 'col-sm-2')
        tagInputPrice = document.createElement('input');
        tagInputPrice.setAttribute('class', 'form-control readonly');
        tagInputPrice.setAttribute('placeholder', 'Harga');
        tagInputPrice.setAttribute('id', 'harga' + $("#countForm").val());
        tagInputPriceHide = document.createElement('input');
        tagInputPriceHide.setAttribute('class', 'form-control readonly');
        tagInputPriceHide.setAttribute('readonly', true);
        tagInputPriceHide.setAttribute('placeholder', 'Harga');
        tagInputPriceHide.setAttribute('type', 'hidden');
        tagInputPriceHide.setAttribute('id', 'hargaHide' + $("#countForm").val());
        tagInputPriceHide.setAttribute('name', 'price[]');

        var colFourth = document.createElement('div');
        colFourth.setAttribute('class', 'col-sm-1')
        tagInputQty = document.createElement('input');
        tagInputQty.setAttribute('class', 'form-control text-center');
        tagInputQty.setAttribute('placeholder', 'Qty');
        tagInputQty.setAttribute('type', 'number');
        tagInputQty.setAttribute('min', '1');
        tagInputQty.setAttribute('name', 'qty[]');
        tagInputQty.setAttribute('id', 'harga' + $("#countForm").val());
        tagInputQty.setAttribute('onchange', 'setTotalPrice(this,' + $("#countForm").val() + ')');

        var colFifth = document.createElement('div');
        colFifth.setAttribute('class', 'col-sm-3')
        tagInputTotal = document.createElement('input');
        tagInputTotal.setAttribute('class', 'form-control readonly');
        tagInputTotal.setAttribute('placeholder', 'Total');
        tagInputTotal.setAttribute('id', 'total' + $("#countForm").val());
        tagInputTotalHide = document.createElement('input');
        tagInputTotalHide.setAttribute('class', 'form-control');
        tagInputTotalHide.setAttribute('placeholder', 'Total');
        tagInputTotalHide.setAttribute('type', 'hidden');
        tagInputTotalHide.setAttribute('name', 'total[]');
        tagInputTotalHide.setAttribute('id', 'totalHide' + $("#countForm").val());

        var colsix = document.createElement('div');
        colsix.setAttribute('class', 'col-sm-1')
        buttonDelete = document.createElement('button');
        buttonDelete.setAttribute('class', 'btn btn-inverse-danger btn-rounded btn-icon');
        buttonDelete.setAttribute('type', 'button');
        buttonDelete.setAttribute('onclick', 'deleteForm(' + $("#countForm").val() + ')');
        buttonDelete.setAttribute('id', 'delete' + $("#countForm").val());
        iconButton = document.createElement('i');
        iconButton.setAttribute('class', 'mdi mdi-delete');
        iconButton.setAttribute('placeholder', 'Total');


        colSecond.appendChild(tagSelect)
        colThird.appendChild(tagInputPriceHide)
        colThird.appendChild(tagInputPrice)
        colFourth.appendChild(tagInputQty);
        colFifth.appendChild(tagInputTotal);
        colFifth.appendChild(tagInputTotalHide);
        buttonDelete.appendChild(iconButton);
        colsix.appendChild(buttonDelete);
        formGroup.appendChild(colFirst);
        formGroup.appendChild(colSecond);
        formGroup.appendChild(colThird);
        formGroup.appendChild(colFourth);
        formGroup.appendChild(colFifth);
        formGroup.appendChild(colsix);
        $("#group").append(formGroup);
        document.getElementById('harga' + $("#countForm").val()).readOnly = true
        document.getElementById('total' + $("#countForm").val()).readOnly = true
    }

    function selectData(idSelect) {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: `/dashboard/get-all-product`,
            success: function(response) {
                $("#" + idSelect).append('<option value="">-- Pilih Barang --</option>');
                $.each(response.data, function(key, value) {
                    $("#" + idSelect).append('<option value=' + value.id + '>' + value.product_name + '</option>');
                })
            }

        })
    }

    function getVoucher(id) {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: `/dashboard/get-voucher/${id}`,
            success: function(response) {
                $.each(response.data, function(key, value) {
                    $("#listVoucher").append('<option value=' + value.code_voucher + '>' + value.code_voucher + ' - ' + value.description + ' - Berlaku sampai ' + value.expired_in + '</option>');
                })
            }
        })
    }

    function selectVoucher(val) {
        let voucher = val.value;
        calculateDiscount(voucher);
    }

    function deleteForm(id) {
        $("#form" + id).remove();
        let countForm = document.getElementById("countForm").value;
        document.getElementById("countForm").value = parseInt(countForm) - 1;
    }

    function calculateTotal() {
        let product = document.getElementById('barang1').value;
        let qty = document.getElementById('qty1').value;
        if (product != '' && qty != '') {
            let countForm = $("#countForm").val();
            let total = 0;
            console.log(countForm);
            for (let i = 1; i <= countForm; i++) {
                let totalPrice = document.getElementById('totalHide' + i).value;
                total += parseInt(totalPrice)
            }
            document.getElementById("subTotal").value = 'Rp ' + total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            document.getElementById("subTotalHide").value = total
            document.getElementById('messageNotif').innerHTML = ''
        } else {
            document.getElementById('messageNotif').innerHTML = 'Silahkan Pilih barang dan input jumlah beli terlebih dahulu.'
        }
    }

    function showFormVoucher(check) {
        if (check.value == 1) {
            document.getElementById('checkboxDiscount').value = 0;
            document.getElementById("formVoucher").hidden = false;
            // document.getElementById("formGrandTotal").hidden = false;
            document.getElementById("formDiscount").hidden = false
            document.getElementById("formGrandTotal").hidden = false
            document.getElementById('discount').value = ""
            document.getElementById('discountHide').value = ""
            document.getElementById('grandTotal').value = ""
            document.getElementById('grandTotalHide').value = ""
        } else {
            document.getElementById('checkboxDiscount').value = 1;
            document.getElementById("formVoucher").hidden = true;
            document.getElementById("formDiscount").hidden = true
            document.getElementById("formGrandTotal").hidden = true
            // document.getElementById("formGrandTotal").hidden = true;

        }
    }

    function calculateDiscount(voucher) {
        // let voucher = document.getElementById('kodeVoucher').value;
        $.ajax({
            type: 'get',
            dataType: 'html',
            url: `/dashboard/checkVoucher/${voucher}`,
            success: function(response) {
                let data = JSON.parse(response);
                if (data.data == null) {
                    document.getElementById("messageVoucher").hidden = false
                    document.getElementById("formDiscount").hidden = true
                    document.getElementById("formGrandTotal").hidden = true
                    document.getElementById("messageVoucher").innerHTML = 'Kode Voucher yang anda masukan tidak terdaftar disistem.'
                } else {
                    if (data.status == true) {

                        let subTotal = document.getElementById('subTotalHide').value;
                        document.getElementById("formDiscount").hidden = false
                        document.getElementById("formGrandTotal").hidden = false
                        // document.getElementById("messageVoucher").hidden = true
                        document.getElementById('discount').value = 'Rp ' + (data.data['total_discount']).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        document.getElementById('discountHide').value = data.data['total_discount']
                        document.getElementById('grandTotal').value = 'Rp ' + (subTotal - data.data['total_discount']).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        document.getElementById('grandTotalHide').value = subTotal - data.data['total_discount']
                    } else {
                        // document.getElementById("messageVoucher").hidden = false
                        document.getElementById("messageVoucher").innerHTML = 'Maaf, kode voucher sudah digunakan.'
                        document.getElementById("formDiscount").hidden = true
                        document.getElementById("formGrandTotal").hidden = true
                    }


                }
            }
        })
    }
</script>
@endsection