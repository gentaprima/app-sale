@extends('master_home')
@section('content')


<!-- start banner Area -->
<section class="banner-area" >
    <div class="container">
        <div class="row fullscreen align-items-center justify-content-start">
            <div class="col-lg-12">
                <div class="{{count($new_product) > 1 ? 'active-banner-slider' : '' }} owl-carousel">
                    <!-- single-slide -->
                    @foreach($new_product as $n)
                    <div class="row single-slide align-items-center d-flex">
                        <div class="col-lg-5 col-md-6">
                            <div class="banner-content">
                                <h1>Koleksi Produk Baru</h1>
                                <p>{{ $n->product_desc }}</p>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="banner-img">
                                <img class="img-fluid" src="{{asset('uploads/product/').'/'.$n->image}}" alt="">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

<!-- start features Area -->
<section class="features-area section_gap">
    <div class="container">
        <div class="row features-inner">
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="{{asset('home/img/features/f-icon1.png')}}" alt="">
                    </div>
                    <h6>Jasa Antar</h6>
                    <p>Tersedia Banyak Jasa Antar</p>
                </div>
            </div>
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="{{asset('home/img/features/f-icon2.png')}}" alt="">
                    </div>
                    <h6>Kebijakan Pengembalian</h6>
                    <p>Gratis Pengiriman Pengembalian</p>
                </div>
            </div>
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="{{asset('home/img/features/f-icon3.png')}}" alt="">
                    </div>
                    <h6>Call Center</h6>
                    <p>Terdapat Call Center yang siap melayani anda</p>
                </div>
            </div>
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="{{asset('home/img/features/f-icon4.png')}}" alt="">
                    </div>
                    <h6>Pembayaran</h6>
                    <p>Pembayaran COD Atau Via Transfer</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end features Area -->

<!-- Start category Area -->

<!-- End category Area -->

<!-- start product Area -->
<section class="owl-carousel section_gap owl-theme owl-loaded" style="margin-top: -150px">
    <!-- single product slide -->
    <div class="single-product-slider">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1>Katalog Produk</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- single product -->
                @foreach($product as $p)
                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <img class="img-fluid" src="{{asset('uploads/product/').'/'.$p->image}}" alt="">
                        <div class="product-details">
                            <h6>{{$p->product_name}}</h6>
                            <div class="price">
                                <h6>{{"Rp " . number_format($p->price,2,',','.')}}</h6>
                            </div>
                            <div class="pt-2">
                                <a class="btn btn-primary text-white" href="https://api.whatsapp.com/send?phone=089506277284&text=Saya%20Ingin%20Membeli%20Produk%20Toko%20?"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 20 20">
                                    <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                                  </svg> Order Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- end product Area -->

<!-- Start exclusive deal Area -->
<section class="exclusive-deal-area">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6" style="background-image: none;">
                <iframe  style="width: 100%;height:70vh" width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=2kiddozshop&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
            </div>
            <div class="col-lg-6 no-padding exclusive-right">
                <div class="active-exclusive-product-slider">
                    <!-- single exclusive carousel -->
                    @foreach($new_product as $n)
                    <div class="single-exclusive-slider">
                        <img class="img-fluid" src="{{asset('uploads/product/').'/'.$p->image}}" alt="">
                        <div class="product-details">
                            <div class="price">
                                <h6>{{"Rp " . number_format($p->price,2,',','.')}}</h6>
                            </div>
                            <h4>{{$p->product_name}}</h4>
                            <div class="add-bag d-flex align-items-center justify-content-center">
                                <div class="pt-2">
                                    <a class="btn btn-primary text-white" href="https://api.whatsapp.com/send?phone=089506277284&text=Saya%20Ingin%20Membeli%20Produk%20Toko%20?"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 20 20">
                                        <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                                      </svg> Order Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach               
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End exclusive deal Area -->

@endsection