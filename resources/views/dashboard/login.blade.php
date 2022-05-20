<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('dashboard_css/assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
    <link rel="stylesheet" href="{{asset('dashboard_css/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('dsahboard_css/assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- End plugin css for this page -->
</head>

<body>
    @if(Session::has('message'))
    <p hidden="true" id="message">{{ Session::get('message') }}</p>
    <p hidden="true" id="icon">{{ Session::get('icon') }}</p>
    <p hidden="true" id="title">{{ Session::get('title') }}</p>
    @endif
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="row w-100 m-0">
                <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                    <div class="card col-lg-4 mx-auto">
                        <div class="card-body px-5 py-5">
                            <h3 class="card-title text-left mb-3">Login</h3>
                            <form method="post" action="/auth">
                                @csrf
                                <div class="form-group">
                                    <label>email *</label>
                                    <input type="email" class="form-control p_input" name="email" value="{{old('email')}}">
                                </div>
                                <div class="form-group">
                                    <label>Password *</label>
                                    <input type="password" class="form-control p_input" name="password">
                                </div>
                                <!-- <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input"> Remember me </label>
                    </div>
                    <a href="#" class="forgot-pass">Forgot password</a>
                  </div> -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- row ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('dashboard_css/assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{asset('dashboard_css/assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('dashboard_css/assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('dashboard_css/assets/js/misc.js')}}"></script>
    <script src="{{asset('dashboard_css/assets/js/settings.js')}}"></script>
    <script src="{{asset('dashboard_css/assets/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{asset('dashboard_css/assets/js/dashboard.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
    <!-- endinject -->
</body>

</html>