<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>4Bid Reset Password</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('admin/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.addons.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('admin/images/4bidlogo-mini.png') }}" />
  <style>
    .auth.auth-bg-1 {
        background: url({{ asset('admin//images/auth/login.jpg') }});
        background-size: cover;
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
              <form method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                 @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <h5 class="display-4">Reset Password</h5>
                <hr>
                <div class="form-group" >
                  <label class="label">Email Address</label>
                  <div class="input-group">
                    <input type="text" name="email" class="form-control" value="{{ old('email') }}" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-email"></i>
                      </span>
                    </div>
                  </div>
                    @if ($errors->has('email'))
                        <span style="color: red;">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <button class="btn btn-primary submit-btn btn-block">Send Password Reset Link</button>
                </div>
                <div class="form-group d-flex justify-content-between">
                  <a href="{{ route('login') }}" class="text-small forgot-password text-black">Login</a>
                </div>            
                <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">Not a member ?</span>
                  <a href="{{ route('register') }}" class="text-black text-small">Create new account</a>
                </div>
              </form>
            </div>
            <p style="margin-top: 10px;" class="footer-text text-center">Copyright © 2018 4Bid. All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('admin/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/vendor.bundle.addons.js') }}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{ asset('admin/js/off-canvas.js') }}"></script>
  <script src="{{ asset('admin/js/misc.js') }}"></script>
  <!-- endinject -->
  <script>
  </script>
</body>

</html>