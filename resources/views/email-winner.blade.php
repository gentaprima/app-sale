<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h3>Halo, {{$nama}}!</h3>
<p>Selamat anda telah menjadi pemenang konsumen terbaik toko kami periode bulan <b><?= date("F", mktime(0, 0, 0, $bulan, 10)) ?> </b> tahun <b>{{$tahun}}</b></p>
<p>Untuk hadiah silahkan diambil di toko kami.</p>

<p>Terimakasih sudah berbelanja ditoko kami.</p>

</body>
</html>

