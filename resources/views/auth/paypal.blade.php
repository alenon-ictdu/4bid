<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>4Bid Register</title>
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
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <style>
    .auth.register-bg-1 {
        background: url({{ asset('admin/images/auth/register2.jpg') }}) center center no-repeat;
        background-size: cover;
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <h2 class="text-center mb-4">Payment</h2>
            <div class="auto-form-wrapper">
              <form name="registerForm" method="POST" action="{{ route('register2') }}">
                {{ csrf_field() }}

                <input type="hidden" class="form-control" placeholder="Firstname" name="firstname" value="{{ $user['firstname'] }}" required>
                <input type="hidden" class="form-control" placeholder="Middlename" name="middlename" value="{{ $user['middlename'] }}">
                <input type="hidden" class="form-control" placeholder="Lastname" name="lastname" value="{{ $user['lastname'] }}" required>
                <input type="hidden" class="form-control" placeholder="Telephone/Mobile Number" name="contact" value="{{ $user['contact'] }}" required>
                <input type="hidden" class="form-control" placeholder="Home/Business Address" name="address" value="{{ $user['address'] }}" required>
                <input type="hidden" class="form-control" placeholder="Email Address" name="email" value="{{ $user['email'] }}" required>
                <input type="hidden" class="form-control" placeholder="Password" name="password" value="{{ $user['password'] }}">
                <input type="hidden" name="type" value="{{ $user['type'] }}">
                
                <div style="display: table;margin: 0 auto;"><div id="paypal-button"></div></div>
                
              </form>
            </div>
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
  
  <script src="https://www.paypalobjects.com/api/checkout.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script>
    paypal.Button.render({
      // Configure environment
      env: 'sandbox',
      client: {
        sandbox: 'AZwi1FNgfq4Qz9HqZfAK-nr5ozHDpTHXjOubjCPxBiqtWdwqc859LKTPc3FdqzllIdkSud3vHEAqqTGo',
        production: 'demo_production_client_id'
      },
      // Customize button (optional)
      locale: 'en_US',
      style: {
        size: 'large',
        color: 'gold',
        shape: 'pill',
        label: 'pay',
      },

      // Enable Pay Now checkout flow (optional)
      commit: true,

      // Set up a payment
      payment: function(data, actions) {
        return actions.payment.create({
          transactions: [{
            amount: {
              total: '1000',
              currency: 'PHP'
            }
          }]
        });
      },
      // Execute the payment
      onAuthorize: function(data, actions) {
        return actions.payment.execute().then(function() {
          // Show a confirmation message to the buyer
          toastr.success(
          '',
          'Your account has been registered!',
          {
              positionClass: 'toast-top-center',
              timeOut: 1000,
              fadeOut: 1000,
              closeButton: true,
              onHidden: function () {
                   document.registerForm.submit();
                }
            }
          );
          // window.alert('Your account has been registered!');
          // document.registerForm.submit();
        });
      }
    }, '#paypal-button');

  </script>
  <!-- endinject -->
</body>

</html>