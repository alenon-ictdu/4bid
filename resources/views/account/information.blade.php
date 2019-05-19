@extends('layouts.app2')

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<style>
  .alt-info {
    display: none;
  }

  @media (max-width: 440px) {
    .alt-info {
      display: block !important;
      margin-top: 10px;
    }

    #info {
      display: none !important;
    }

    #user-img {
      margin: 0 auto !important;
    }
  }
</style>
@stop

@section('content')
<button type="button" class="btn btn-primary btn-xs" style="margin-bottom: 10px;" onclick="history.back();">Back</button>
@if(count($errors) > 0)
<div class="col-md-6 offset-md-3">
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
</div>
@endif

<div class="col-md-6 offset-md-3 grid-margin stretch-card">
    <div class="card">
      	<div class="card-body">
        <h4 class="card-title">Account Information</h4>
        <div class="media border p-3">
    		  <img id="user-img" src="{{ Auth::user()->image == '' ? asset('admin/images/faces/default_image.png'):asset('uploads/user/'.Auth::user()->image) }}" class="mr-3 mt-3 rounded-circle" style="width:100px;height: 100px;">
          
    		  <div class="media-body" id="info">
    		    <h4 style="margin-top: 20px;" class="text-capitalize display-3 user-name">{{ Auth::user()->firstname. ' ' .Auth::user()->middlename. ' ' .Auth::user()->lastname }}</h4>
    		    <p class="user-contact">{{ Auth::user()->email }} {{ Auth::user()->user_type == 2 ? '| '. Auth::user()->user_id : '' }}</p>
    		  </div>
		    </div>
        <div class="alt-info">
          <h5 class="text-capitalize">{{ Auth::user()->firstname. ' ' .Auth::user()->middlename. ' ' .Auth::user()->lastname }}</h5>
          <p>{{ Auth::user()->email }} {{ Auth::user()->user_type == 2 ? '| '. Auth::user()->user_id : '' }}</p>
        </div>
        
		<hr>
		<form class="forms-sample" method="POST" action="{{ route('account-information.update') }}" enctype="multipart/form-data">
			{{ csrf_field() }}
            @if(Auth::user()->user_type == 2)
            <div class="form-group">
              <label>Registration Date: {{ date('M d, Y', strtotime( Auth::user()->created_at )) }}</label>
            </div>
            @endif
            <div class="form-group">
              <label>Upload Photo</label>
              <input type="file" name="image" class="form-control-file">
            </div>
            <div class="form-group">
              <label>Firstname</label>
              <input type="text" name="firstname" class="form-control" placeholder="Firstname" value="{{ Auth::user()->firstname }}" required="">
            </div>
            <div class="form-group">
              <label>Middlename</label>
              <input type="text" name="middlename" class="form-control" placeholder="Middlename" value="{{ Auth::user()->middlename }}" required="">
            </div>
            <div class="form-group">
              <label>Lastname</label>
              <input type="text" name="lastname" class="form-control" placeholder="Lastname" value="{{ Auth::user()->lastname }}" required="">
            </div>
            <div class="form-group">
              <label>Telephone/Mobile Number</label>
              <input type="text" name="contact" class="form-control" placeholder="Telephone/Mobile Number" value="{{ Auth::user()->contact }}" required="">
            </div>
            <div class="form-group">
              <label>Home/Business Address</label>
              <input type="text" name="address" class="form-control" placeholder="Home/Business Address" value="{{ Auth::user()->address }}" required="">
            </div>
            <div class="form-group">
              <label>Email address</label>
              <input type="email" name="email" class="form-control" id="exampleInputEmail3" placeholder="Email" value="{{ Auth::user()->email }}" required="">
            </div>
            @if(Auth::user()->user_type == 2)
            <div class="form-group">
              <label>Type of Bidder</label>
              <select class="form-control" name="type">
              	<option value="none"> -- Type of Bidder -- </option>
              	<option @if(Auth::user()->type == 'ftb') selected @endif value="ftb">First Time Bidder</option>
              	<option @if(Auth::user()->type == 'rb') selected @endif value="rb">Regular Bidder</option>
              </select>
            </div>
            @endif
            <button type="submit" class="btn btn-success mr-2">Save Changes</button>
          </form>
      	</div>
	</div>
</div>
@stop

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
	@if(Session::has('success'))
		toastr.success(
    '',
    '{{ Session::get('success') }}',
    {
        timeOut: 3000,
        fadeOut: 1000,
        closeButton: true
      }
    );
	@endif
</script>
@stop