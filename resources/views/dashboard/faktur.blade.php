<html>

<head>
    <title>Faktur Pembayaran</title>
    <style>
        #tabel {
            font-size: 15px;
            border-collapse: collapse;
        }

        #tabel td {
            padding-left: 5px;
            border: 1px solid black;
        }

        @media print {
            @page {
                margin: 0;
            }

            body {
                margin: 1.6cm;
            }
        }
    </style>
    <script>
        window.print();
    </script>
</head>

<body style='font-family:tahoma; font-size:8pt;'>
    <center>
        <table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                <span style='font-size:12pt'><b>Toko Serbaguna</b></span></br>
                {{$dataTransaction[0]->alamat}}, {{$dataTransaction[0]->kecamatan}}-{{$dataTransaction[0]->kabupaten}}, {{$dataTransaction[0]->provinsi}} </br>
                Telp : 0594094545
            </td>
            <td style='vertical-align:top' width='30%' align='left'>
                <b><span style='font-size:12pt'>FAKTUR PENJUALAN</span></b></br>
                No Transaksi. : {{$dataTransaction[0]->id_order}}</br>
                Tanggal :{{$dataTransaction[0]->date}}</br>
            </td>
        </table>
        <table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                Nama Pelanggan : {{$dataTransaction[0]->full_name}}</br>
                Alamat : {{$dataTransaction[0]->alamat}}, {{$dataTransaction[0]->kecamatan}}-{{$dataTransaction[0]->kabupaten}}, {{$dataTransaction[0]->provinsi}}
            </td>
            <td style='vertical-align:top' width='30%' align='left'>
                No Telp :0891231231232
            </td>
        </table>
        <table cellspacing='0' style='width:550px; font-size:8pt; font-family:calibri;  border-collapse: collapse;' border='1'>

            <tr align='center'>
                <td width='10%'>#</td>
                <td width='20%'>Nama Barang</td>
                <td width='13%'>Harga</td>
                <td width='4%'>Qty</td>
                <td width='13%'>Total Harga</td>
            </tr>
            @php $subtotal = 0; @endphp
            @foreach($dataTransaction as $row)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$row->product_name}}</td>
                <td>Rp @php echo number_format($row->price, 2, ".", ","); @endphp</td>
                <td>{{$row->qty}}</td>
                <td style='text-align:right'>Rp @php echo number_format($row->total, 2, ".", ","); @endphp</td>
            </tr>
            @php $subtotal += $row->total; @endphp
            @endforeach
            <tr>
                <td colspan='4'>
                    <div style='text-align:right'>Diskon</div>
                </td>
                <td style='text-align:right'>Rp @php echo number_format($row->discount, 2, ".", ","); @endphp</td>
            </tr>
            <tr>
                <td colspan='4'>
                    <div style='text-align:right'>Total</div>
                </td>
                <td style='text-align:right'>Rp @php echo number_format($subtotal, 2, ".", ","); @endphp</td>
            </tr>
           
           
        </table>

        <table style='width:650; font-size:7pt;' cellspacing='2'>
            <tr>
                <td align='center'>Diterima Oleh,</br></br><u>(............)</u></td>
                <td style='border:1px solid black; padding:5px; text-align:left; width:30%'></td>
                <td align='center'>TTD,</br></br><u>(...........)</u></td>
            </tr>
        </table>
    </center>
</body>

</html>