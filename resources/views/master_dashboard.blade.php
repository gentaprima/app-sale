<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title')</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('dashboard_css/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard_css/assets/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{asset('dashboard_css/assets/vendors/jvectormap/jquery-jvectormap.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard_css/assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard_css/assets/vendors/owl-carousel-2/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard_css/assets/vendors/owl-carousel-2/owl.theme.default.min.css')}}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="{{asset('dashboard_css/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard_css/style.css')}}">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{ asset('home/img/logo.png') }}" />
  <link rel="stylesheet" href="{{asset('dashboard_css/assets/vendors/select2/select2.min.css')}}">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.dataTables.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
  <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.4.0/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.flash.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.print.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <!-- <a class="sidebar-brand brand-logo" href="index.html"><img src="{{asset('dashboard_css/assets/images/logo.svg')}}" alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="{{asset('dashboard_css/assets/images/logo-mini.svg')}}" alt="logo" /></a> -->
        <h5 class="sidebar-brand brand-logo" style="text-align: left; color:#FFF;"><img src="{{ asset('home/img/logo.png') }}" height="50px" alt=""></h5>
      </div>
      <ul class="nav">
        <li class="nav-item profile">
          <div class="profile-desc">
            <div class="profile-pic">
              <div class="count-indicator">
                <img class="img-xs rounded-circle " src="{{asset('dashboard_css/assets/images/faces/face15.jpg')}}" alt="">
                <span class="count bg-success"></span>
              </div>
              <div class="profile-name">
                <h5 class="mb-0 font-weight-normal">{{ Session::get('dataUsers')->full_name }}</h5>
                @php if(Session::get('dataUsers')->role == 1){ @endphp
                <span>Super Admin</span>
                @php }else{ @endphp
                  <span>Pelayan</span>
                @php } @endphp
              </div>
            </div>

          </div>
        </li>
        <li class="nav-item nav-category">
          <span class="nav-link">Navigation</span>
        </li>
        <li class="nav-item menu-items {{ Request::is('dashboard') ? 'active' : '' }}">
          <a class="nav-link " href="/dashboard">
            <span class="menu-icon">
              <i class="mdi mdi-home-variant"></i>
            </span>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item menu-items {{ Request::is('dashboard/data-produk') ? 'active' : '' }}">
          <a class="nav-link " href="/dashboard/data-produk">
            <span class="menu-icon">
              <i class="mdi mdi-library-books"></i>
            </span>
            <span class="menu-title">Data Produk</span>
          </a>
        </li>
        <li class="nav-item menu-items {{ Request::is('dashboard/data-pelanggan') ? 'active' : '' }}">
          <a class="nav-link" href="/dashboard/data-pelanggan">
            <span class="menu-icon">
              <i class="mdi mdi-account-card-details"></i>
            </span>
            <span class="menu-title">Data Konsumen</span>
          </a>
        </li>
        <li class="nav-item menu-items {{ Request::is('dashboard/data-hadiah') ? 'active' : '' }}">
          <a class="nav-link " href="/dashboard/data-hadiah">
            <span class="menu-icon">
              <i class="mdi mdi-library-books"></i>
            </span>
            <span class="menu-title">Data Hadiah</span>
          </a>
        </li>
        <li class="nav-item menu-items {{ Request::is('dashboard/data-pelayan') ? 'active' : '' }}">
          <a class="nav-link " href="/dashboard/data-pelayan">
            <span class="menu-icon">
              <i class="mdi mdi-library-books"></i>
            </span>
            <span class="menu-title">Data Pelayan</span>
          </a>
        </li>
        <!-- <li class="nav-item menu-items {{ Request::is('dashboard/data-ekspedisi') ? 'active' : '' }}">
          <a class="nav-link" href="/dashboard/data-ekspedisi">
            <span class="menu-icon">
              <i class="mdi mdi-truck"></i>
            </span>
            <span class="menu-title">Data Ekspedisi</span>
          </a>
        </li> -->
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <span class="menu-icon">
              <i class="mdi mdi-chart-bar"></i>
            </span>
            <span class="menu-title">Penjualan</span>
            <i class="menu-arrow"></i>
          </a>

          <div class="collapse {{ Request::is('dashboard/data-transaction-member') ||  Request::is('dashboard/data-transaction-non-member') || Request::is('dashboard/add-transaction') ? 'show' : '' }}" id="auth">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link {{ Request::is('dashboard/add-transaction') ? 'active' : '' }}" href="/dashboard/add-transaction"> Tambah Pembelian</a></li>
              <li class="nav-item"> <a class="nav-link {{ Request::is('dashboard/data-transaction-non-member') ? 'active' : '' }}" href="/dashboard/data-transaction-non-member"">Data Penjualan (Non Member)</a></li>
              <li class=" nav-item"> <a class="nav-link {{ Request::is('dashboard/data-transaction-member') ? 'active' : '' }}" href="/dashboard/data-transaction-member">Data Penjualan (Member)</a></li>
            </ul>
          </div>
        </li>
        @php if(Session::get('dataUsers')->role == 1){ @endphp
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-calculator"></i>
            </span>
            <span class="menu-title">Metode</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse {{ Request::is('dashboard/data-kriteria') || Request::is('dashboard/data-penilaian') || Request::is('dashboard/data-perhitungan')  ? 'show' : '' }}" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link {{ Request::is('dashboard/data-kriteria') ? 'active' : '' }}" href="/dashboard/data-kriteria"> Data Kriteria</a></li>
              <li class=" nav-item"> <a class="nav-link {{ Request::is('dashboard/data-penilaian') ? 'active' : '' }}" href="/dashboard/data-penilaian">Data Penilaian</a></li>
              <li class="nav-item"> <a class="nav-link {{ Request::is('dashboard/data-perhitungan') ? 'active' : '' }}" href="/dashboard/data-perhitungan">Perhitungan Konsumen terbaik</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#ui-report" aria-expanded="false" aria-controls="ui-report">
            <span class="menu-icon">
              <i class="mdi mdi-table"></i>
            </span>
            <span class="menu-title">Laporan</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse {{ Request::is('dashboard/report-member') || Request::is('dashboard/report-non-member')  || Request::is('dashboard/report-konsumen-terbaik')? 'show' : '' }}" id="ui-report">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link {{ Request::is('dashboard/report-member') ? 'active' : '' }}" href="/dashboard/report-member"> Laporan (member)</a></li>
              <li class=" nav-item"> <a class="nav-link {{ Request::is('dashboard/report-non-member') ? 'active' : '' }}" href="/dashboard/report-non-member">Laporan (non member)</a></li>
              <li class=" nav-item"> <a class="nav-link {{ Request::is('dashboard/report-konsumen-terbaik') ? 'active' : '' }}" href="/dashboard/report-konsumen-terbaik">Laporan Konsumen Terbaik</a></li>
            </ul>
          </div>
        </li>
        @php } @endphp
      </ul>
    </nav>
    <!-- partial -->
    <div class=" container-fluid page-body-wrapper">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">

            <li class="nav-item dropdown">
              <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                <div class="navbar-profile">
                  <img class="img-xs rounded-circle" src="{{asset('dashboard_css/assets/images/faces/face15.jpg')}}" alt="">
                  <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ Session::get('dataUsers')->full_name }}</p>
                  <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                <h6 class="p-3 mb-0">Profile</h6>
                <div class="dropdown-divider"></div>
                <a href="/dashboard/profile" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-settings text-success"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Profil</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="/logout" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-logout text-danger"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Log out</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-format-line-spacing"></span>
          </button>
        </div>
      </nav>
      <!-- content -->
      <div class="main-panel">
        @if(Session::has('message'))
        <p hidden="true" id="message">{{ Session::get('message') }}</p>
        <p hidden="true" id="icon">{{ Session::get('icon') }}</p>
        <p hidden="true" id="title">{{ Session::get('title') }}</p>
        @endif
        @yield('content')
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2022 <a href="#" target="_blank">App Sale</a>. All rights reserved.</span>

          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{asset('dashboard_css/assets/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{asset('dashboard_css/assets/vendors/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('dashboard_css/assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
  <script src="{{asset('dashboard_css/assets/vendors/jvectormap/jquery-jvectormap.min.js')}}"></script>
  <script src="{{asset('dashboard_css/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
  <script src="{{asset('dashboard_css/assets/vendors/owl-carousel-2/owl.carousel.min.js')}}"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{asset('dashboard_css/assets/js/off-canvas.js')}}"></script>
  <script src="{{asset('dashboard_css/assets/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('dashboard_css/assets/js/misc.js')}}"></script>
  <script src="{{asset('dashboard_css/assets/js/settings.js')}}"></script>
  <script src="{{asset('dashboard_css/assets/js/todolist.js')}}"></script>
  <script src="{{asset('dashboard_css/assets/js/file-upload.js')}}"></script>
  <!-- endinject -->

  <!-- Custom js for this page -->
  <script src="{{asset('dashboard_css/assets/js/dashboard.js')}}"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="{{asset('dashboard_css/assets/vendors/select2/select2.min.js')}}"></script>
  <script src="{{asset('dashboard_css/assets/js/select2.js')}}"></script>
  <!-- <script src="{{asset('dashboard_css/jquery-datatable/jquery.dataTables.js')}}"></script>
  <script src="{{asset('dashboard_css/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
  <script src="{{asset('dashboard_css/jquery-datatable/extensions/export/dataTables.buttons.min.j')}}s"></script>
  <script src="{{asset('dashboard_css/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
  <script src="{{asset('dashboard_css/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
  <script src="{{asset('dashboard_css/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
  <script src="{{asset('dashboard_css/jquery-datatable/extensions/export/vfs_fonts.j')}}s"></script>
  <script src="{{asset('dashboard_css/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
  <script src="{{asset('dashboard_css/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script> -->
  <!-- <script src="{{asset('dashboard_css/js/tables/jquery-datatable.js')}}"></script> -->
  <script>
    $(document).ready(function() {
      $.noConflict()
      table = $('#table').DataTable({
        paging: false,
        ordering: false,
        info: false,
        searching: true,
        dom: 'lrt',
        "buttons": ['excelHtml5', 'print', 'pdfHtml5','csvHtml5','copyHtml5']
      });
      $('table').removeClass('dataTable')
      $('table').removeClass('no-footer')
      $('#searchBox').keyup(function() {
        table.search($(this).val()).draw();
      });
      $('#pdf').click(function() {
        table.buttons(0, 2).trigger()
      });
      $('#excel').click(function() {
        table.buttons(0, 0).trigger()
      })
      $('#print').click(function() {
        table.buttons(0, 1).trigger()
      })
      $('#csv').click(function() {
        table.buttons(0, 3).trigger()
      })
      $('#copy').click(function() {
        table.buttons(0, 4).trigger()
      })
    });
  </script>
  <script>
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
  <script>
    $(document).ready(function() {
      $.noConflict()
      $('.js-example-basic-single').select2();
      $('.js-example-basic-singlee').select2();
    });
  </script>
  <!-- End custom js for this page -->
</body>

</html>