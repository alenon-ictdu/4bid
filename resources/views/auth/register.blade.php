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
            <h2 class="text-center mb-4">Register</h2>
            <div class="auto-form-wrapper">
              <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Firstname" name="firstname" value="{{ old('firstname') }}" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <small style="color: red;">@if ($errors->has('firstname'))!@endif</small>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Middlename" name="middlename" value="{{ old('middlename') }}">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <small style="color: red;">@if ($errors->has('middlename'))!@endif</small>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Lastname" name="lastname" value="{{ old('lastname') }}" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <small style="color: red;">@if ($errors->has('lastname'))!@endif</small>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Telephone/Mobile Number" name="contact" value="{{ old('contact') }}" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <small style="color: red;">@if ($errors->has('contact'))!@endif</small>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Home/Business Address" name="address" value="{{ old('address') }}" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <small style="color: red;">@if ($errors->has('address'))!@endif</small>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Email Address" name="email" value="{{ old('email') }}" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <small style="color: red;">@if ($errors->has('email'))!@endif</small>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <small style="color: red;">@if ($errors->has('password'))!@endif</small>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" >
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <small style="color: red;">@if ($errors->has('password_confirmation'))!@endif</small>
                      </span>
                    </div>
                  </div>
                </div>

                <!-- <div class="form-group">
                  <div class="input-group">
                    <input type="password" class="form-control" placeholder="Paypal Account" name="paypal" >
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <small style="color: red;">@if ($errors->has('paypal'))!@endif</small>
                      </span>
                    </div>
                  </div>
                </div> -->

                <div class="form-group">
                    <select class="form-control" name="type">
                      <option value="none"> -- Type of Bidder -- </option>
                      <option value="ftb">First Time Bidder</option>
                      <option value="rb">Regular Bidder</option>
                    </select>
                </div>

                <div class="text-block my-3">

                  <input type="checkbox" value="" name="terms_checkbox" id="terms_checkbox"><span class="text-small">I have read and accept the Terms of Agreement. <a href="#" data-toggle="modal" data-target="#termsMdal" class="text-small">"4Bid Terms of Agreement"</a></span>
                  <br>
                  
                </div>
                
                <div class="form-group" style="margin-top: 20px;">
                  <button id="submitID"  class="btn btn-primary submit-btn btn-block" disabled>Submit</button>
                </div>
                <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">Already have and account ?</span>
                  <a href="{{ route('login') }}" class="text-black text-small">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <!-- Modal -->
<div class="modal fade" id="termsMdal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Terms of Agreement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>1. You must be a registered bidder or buyer to participate in this Auction. A "bidder number" can be obtained upon the online registration and pay a non-refundable Registration Fee of one thousand pesos (1,000.00) for security purposes.</p>
        <p>2. Auctioneer or seller must upload his/her valid Driver’s license, OR/CR and Deeds of sale, if required, upon the registration of the item to be auctioned. The auctioneer or seller must pay a non-refundable posting fee of two thousand pesos (2,000.00).</p>
        <p>3. The Auctioneer or seller shall regulate the bidding. He has the right to refuse any bid or withdraw any lot(s) from the sale within two (2) days without a reason thereof. </p>
        <p>4. Bidders or buyers are advised to bid clearly inputting the amount when they agree with the amount requested by the Auctioneer. The highest bidder or buyer shall be the Purchaser when the countdown timer is finished.</p>
        <p>5. The particulars, descriptions, measurement and quantities in the catalogue are for the purpose of identification of the car and are NOT WARRANTIES in any way as to the correctness thereof.</p>
        <p>6. The auctioneer does not guarantee the information on the sticker of the items specifications and will not arbitrate base only on information.</p>
        <p>7. Items declared "Working" and "Quick Tested" will be sold on an "AS IS, WHERE IS" "NO WARRANTY" "NO GUARANTEE", basis and are sold with all faults if any. 4BID, accepts no responsibility for anycar/s sold upon the fall of the hammer. The winning bidder is not allowed to WITHDRAW, RETURN, CANCEL and REFUND any lot(s) after being declared as the purchaser.</p>
        <p>8. Payments are strictly in the form of cash, manager's check or direct deposit to the Auctioneer's PayPal account.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('admin/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/vendor.bundle.addons.js') }}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{ asset('admin/js/off-canvas.js') }}"></script>
  <script src="{{ asset('admin/js/misc.js') }}"></script>
  <script>
  $(document).ready(function(){
    $("#terms_checkbox").click(function(){
      $("#submitID").prop("disabled", !this.checked);
      // $("#submitID").toggle();
      // alert('click');
    });
  });
  </script>
  
  
  <!-- endinject -->
</body>

</html>