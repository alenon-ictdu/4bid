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
              <form method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">
                 @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <h5 class="display-4">Reset Password</h5>
                <hr>
                <input type="hidden" name="email" class="form-control" value="{{ $email or old('email') }}" required>
                {{-- <div class="form-group" >
                  <label class="label">Email Address</label>
                  <div class="input-group">
                    <input type="text" name="email" class="form-control" value="{{ $email or old('email') }}" required>
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
                </div> --}}
                <div class="form-group" >
                  <label class="label">New Password</label>
                  <div class="input-group">
                    <input type="password" name="password" class="form-control" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-lock"></i>
                      </span>
                    </div>
                  </div>
                    @if ($errors->has('password'))
                        <span style="color: red;">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group" >
                  <label class="label">Confirm Password</label>
                  <div class="input-group">
                    <input type="password" name="password_confirmation" class="form-control" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-lock"></i>
                      </span>
                    </div>
                  </div>
                    @if ($errors->has('password_confirmation'))
                        <span style="color: red;">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <button class="btn btn-primary submit-btn btn-block">Reset Password</button>
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