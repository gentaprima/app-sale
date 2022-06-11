<?php

use Illuminate\Support\Facades\Session;
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('home/img/logo.png') }}">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>2Kiddoz Shop</title>
    <!--
  CSS
  ============================================= -->
    <link rel="stylesheet" href="{{ asset('home/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/ion.rangeSlider.css') }}" />
    <link rel="stylesheet" href="{{ asset('home/css/ion.rangeSlider.skinFlat.css') }}" />
    <link rel="stylesheet" href="{{ asset('home/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('home/style.css') }}">
</head>

<body>
    @if (Session::has('message'))
        <p hidden="true" id="message">{{ Session::get('message') }}</p>
        <p hidden="true" id="icon">{{ Session::get('icon') }}</p>
        <p hidden="true" id="title">{{ Session::get('title') }}</p>
    @endif
    <!-- Start Header Area -->
    <header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="/"><img src="{{ asset('home/img/logo.png') }}" height="50px"
                            alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}"><a class="nav-link"
                                    href="/">Beranda</a></li>
                            <?php if (Session::get('login') == true) {  ?>
                            <li class="nav-item {{ Request::is('data-transaksi') ? 'active' : '' }}"><a
                                    class="nav-link" href="/data-transaksi">Riwayat Transaksi</a></li>
                            <li class="nav-item {{ Request::is('data-voucher') ? 'active' : '' }}"><a
                                    class="nav-link" href="/data-voucher">Voucher</a></li>
                            <li class="nav-item submenu dropdown {{ Request::is('profile') ? 'active' : '' }}">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true"
                                    aria-expanded="false">{{ Session::get('dataUsers')->full_name }}</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item "><a class="nav-link " href="/profile">Profile</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                                </ul>
                            </li>
                            <?php } else { ?>
                            <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="search_input" id="search_input_box">
            <div class="container">
                <form class="d-flex justify-content-between">
                    <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                    <button type="submit" class="btn"></button>
                    <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </header>
    <!-- End Header Area -->

    @yield('content')

    <!-- start footer Area -->
    <footer class="footer-area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>About Us</h6>
                        <p>
                            Toko yang menyediakan Anak-anak.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Alamat</h6>
                        <p>Jl. Cipinang Muara 3 No.21, Gang Z, RT.006 RW.008, Cipinang Muara, Kec. Jatinegara, Kota
                            Jakarta Timur, DKI Jakarta 13420</p>
                    </div>
                </div>
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="single-footer-widget mail-chimp">
                        <h6 class="mb-20">Instragram Feed</h6>
                        <ul class="instafeed d-flex flex-wrap">
                            <li><img src="{{ asset('home/img/i1.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('home/img/i2.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('home/img/i3.jp') }}g" alt=""></li>
                            <li><img src="{{ asset('home/img/i4.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('home/img/i5.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('home/img/i6.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('home/img/i7.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('home/img/i8.jpg') }}" alt=""></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Follow</h6>
                        <p>Akun Sosial Media</p>
                        <div class="footer-social d-flex align-items-center">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-dribbble"></i></a>
                            <a href="#"><i class="fa fa-behance"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
                <p class="footer-text m-0">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved by <a href="https://colorlib.com"
                        target="_blank">Developer</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
        </div>
    </footer>
    <!-- End footer Area -->

    <script src="{{ asset('home/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="{{ asset('home/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('home/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('home/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('home/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('home/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('home/js/countdown.js') }}"></script>
    <script src="{{ asset('home/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('home/js/owl.carousel.min.js') }}"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="{{ asset('home/js/gmaps.min.js') }}"></script>
    <script src="{{ asset('home/js/main.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('dashboard_css/assets/js/file-upload.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                item: 1,
                loop: true,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: false
            });
        })
        let icon = document.getElementById('icon');
        let title = document.getElementById('title');
        if (icon != null) {
            let message = document.getElementById('message');
            swal({
                title: title.innerHTML,
                text: message.innerHTML,
                icon: icon.innerHTML,
            });
        }
    </script>
</body>

</html>
