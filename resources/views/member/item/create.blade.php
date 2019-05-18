@extends('layouts.app2')

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
	<style>
		.form-control {
		    border: 1px solid #91979a;
		    font-family: "Poppins", sans-serif;
		    font-size: 0.75rem;
		    padding: 11px 0.75rem;
		    line-height: 14px;
		    font-weight: 
		}

    /* The alert message box */
    .info {
      background-color: white;
      padding: 20px;
      color: white;
      margin-bottom: 15px;
      border-left: 2px solid black;
      -webkit-box-shadow: 0px 1px 15px 1px rgba(69,65,78,0.55);
      box-shadow: 0px 1px 15px 1px rgba(69,65,78,0.55);
      background-color: #dc6428;
    }

    /* The close button */
    .closebtn {
      margin-left: 15px;
      color: white;
      font-weight: bold;
      float: right;
      font-size: 22px;
      line-height: 20px;
      cursor: pointer;
      transition: 0.3s;
    }

    /* When moving the mouse over the close button */
    .closebtn:hover {
      color: black;
    }

	</style>
@stop

@section('content')

<div class="row">
  <div class="col-md-8 offset-md-2">
      <div class="info" role="alert">
        Posting a car cost ₱ 2000
      </div>
  </div>
</div>
<form name="storeForm" id="storeForm" action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data">
<div class="col-md-8 offset-md-2">
	@if(count($errors) > 0)
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
	  <strong>Error(s):</strong> 
       <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
       </ul>
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
	@endif
  
  
    
	{{-- <h4 style="margin-top: 10px; margin-bottom: 20px;">Post a car</h4> --}}
	<div class="row" style="background-color: white;">
		
		{{ csrf_field() }}
		
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h5>Please based it on your OR/CR</h5>
              	<div class="form-group">
                  <label for="exampleInputName1">Car ID<span class="required-field">*</span></label>
                  <input type="text" class="form-control" value="{{ $productID }}" disabled required>
                  <input type="hidden" name="product_id" value="{{ $productID }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Car Model<span class="required-field">*</span></label>
                  <input name="name" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Floor price</label>
                  <input name="price" type="number" min="1" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Color</label>
                  <input name="color" type="text" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Style<span class="required-field">*</span></label>
                  <input name="style" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Brand ( e.g toyato, audi) <span class="required-field">*</span></label>
                  <input name="brand" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Series<span class="required-field">*</span></label>
                  <input name="series" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Denomination<span class="required-field">*</span></label>
                  <input name="denomination" type="text" class="form-control" required>
                </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <br>
                <div class="form-group">
                  <label for="exampleInputName1">Piston Displacement<span class="required-field">*</span></label>
                  <input name="piston" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">No. of cylinder<span class="required-field">*</span></label>
                  <input name="cylinder" type="number" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Fuel<span class="required-field">*</span></label>
                  <input name="fuel" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Mileage<span class="required-field">*</span></label>
                  <input name="milage" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Year<span class="required-field">*</span></label>
                  <select name="year" class="form-control">
                  	<option value="none" required> -- Select Year -- </option>
                  	@foreach($yearsArr as $row)
					           <option value="{{ $row }}">{{ $row }}</option>
                  	@endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Car images<span class="required-field">*</span></label>
                  <input name="product_image[]" id="productImage" type="file" class="form-control-file" required multiple>
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Driver's license, OR/CR & Deed of sale<span class="required-field">*</span></label>
                  <input name="product_dod[]" type="file" class="form-control-file" required multiple>
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Duration<span class="required-field">*</span></label>
                  <input name="duration"  type="date" class="form-control" required max="{{ $maxdate }}">
                </div>
                <button style="margin-bottom: 20px;" form="storeForm" type="submit" class="btn btn-success btn-block mr-2">Register</button>
                <div id="paypalDiv"><div id="paypal-button"></div></div>
            </div>
          </div>
        </div>
        
    </div>
</div>
</form>
@stop

@section('scripts')
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>

/*  $('#productImage').on("change", function(){ 
    var numFiles = $("#productImage")[0].files.length;
    if(numFiles < 7) {
      $('#productImage').val('');
      $('#productImage').get(0).reportValidity();
      $('#productImage').get(0).setCustomValidity('Car Images must be greater than 6!');
    } else {
      // alert('success');
    }
  });*/

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
            total: '2000',
            currency: 'PHP'
          }
        }]
      });
    },
    // Execute the payment
    onAuthorize: function(data, actions) {
      return actions.payment.execute().then(function() {
        // Show a confirmation message to the buyer
        // window.alert('Your item was added wait for the admin’s approval');
        toastr.success(
        '',
        'Your item was added wait for the admin’s approval',
        {
            positionClass: 'toast-top-center',
            timeOut: 2000,
            fadeOut: 1000,
            closeButton: true,
            onHidden: function () {
                document.storeForm.submit();
              }
          }
        );
        // document.storeForm.submit();
      });
    }
  }, '#paypal-button');


</script>
<script>
$(document).ready(function(){
  $("#paypalDiv").hide();
  /*$("#registerBtn").click(function(){
    $("#paypalDiv").toggle(1000);
  });*/

  $("#storeForm").submit(function(e){
      e.preventDefault();
      // Confirm();
      // $("#paypalDiv").toggle(1000);
      var numFiles = $("#productImage")[0].files.length;
      if(numFiles < 7) {
        toastr.warning(
        '',
        'Car Images must be greater than 6!',
        {
            timeOut: 3000,
            fadeOut: 1000,
            closeButton: true
          }
        );
        // alert('Car Images must be greater than 6!');
        /*$('#productImage').val('');
        $('#productImage').get(0).reportValidity();
        $('#productImage').get(0).setCustomValidity('Car Images must be greater than 6!');*/
      } else {
        toastr.info("<button type='button' id='confirmationRevertYes' class='btn clear'>Yes</button> <button type='button' id='confirmationRevertNo' class='btn clear'>No</button>",'"Are you sure you inputted the right details?"',
        {
            positionClass: 'toast-top-center',
            closeButton: false,
            allowHtml: true,
            hideDuration: 0,
            timeOut: 0,
            extendedTimeOut: 0,
            onShown: function (toast) {
                $("#confirmationRevertYes").click(function(){
                  $("#paypalDiv").toggle(1000);
                });
                $("#confirmationRevertNo").click(function(){
                  
                });
              }
        });
      }
        /*toastr.info("<button type='button' id='confirmationRevertYes' class='btn clear'>Yes</button> <button type='button' id='confirmationRevertNo' class='btn clear'>No</button>",'"Are you sure you inputted the right details?"',
        {
            positionClass: 'toast-top-center',
            closeButton: false,
            allowHtml: true,
            hideDuration: 0,
            timeOut: 0,
            extendedTimeOut: 0,
            onShown: function (toast) {
                $("#confirmationRevertYes").click(function(){
                  $("#paypalDiv").toggle(1000);
                });
                $("#confirmationRevertNo").click(function(){
                  
                });
              }
        });*/
  });
});

function Confirm()
    {
    var x = confirm("Are you sure you inputted the right details?");
    if (x)
      $("#paypalDiv").toggle(1000);
      // return true;
    else
      return false;
    }
</script>
@stop