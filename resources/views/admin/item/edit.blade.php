@extends('layouts.app2')

@section('styles')
	<style>
		.form-control {
		    border: 1px solid #91979a;
		    font-family: "Poppins", sans-serif;
		    font-size: 0.75rem;
		    padding: 11px 0.75rem;
		    line-height: 14px;
		    font-weight: 
		}
	</style>
@stop

@section('content')
<form name="updateForm" id="updateForm" action="{{ route('product.update', [$product->product_id, $product->id]) }}" method="POST" enctype="multipart/form-data">
<div class="col-md-8 offset-md-2">
	@if(count($errors) > 0)
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
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
	<h4 style="margin-top: 10px; margin-bottom: 20px;">Edit item details</h4>
	<div class="row" style="background-color: white;">
		
		{{ csrf_field() }}
		
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              	<div class="form-group">
                  <label for="exampleInputName1">Product ID<span class="required-field">*</span></label>
                  <input type="text" class="form-control" value="{{ $product->product_id }}" disabled required>
                  <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Name of item<span class="required-field">*</span></label>
                  <input name="name" type="text" class="form-control" required value="{{ $product->name }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Floor price</label>
                  <input type="number" min="1" class="form-control" value="{{ $product->price }}" name="price">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Color</label>
                  <input name="color" type="text" class="form-control" value="{{ $product->color }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Style<span class="required-field">*</span></label>
                  <input name="style" type="text" class="form-control" required value="{{ $product->style }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Brand<span class="required-field">*</span></label>
                  <input name="brand" type="text" class="form-control" required value="{{ $product->brand }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Series<span class="required-field">*</span></label>
                  <input name="series" type="text" class="form-control" required value="{{ $product->series }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Denomination<span class="required-field">*</span></label>
                  <input name="denomination" type="text" class="form-control" required value="{{ $product->denomination }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Driver's license, OR/CR & Deed of sale<span class="required-field">*</span></label>
                  <input type="file" class="form-control-file" name="product_dod[]" multiple>
                </div>
                <hr>
                <h5>Driver's license, OR/CR & Deed of sale</h5>
                <small>Click the image to remove</small>
                <div class="form-group" id="imageGroup">
                  @foreach($productDOD as $photo)
                  <label id="imageRow_{{$photo->id}}" style="position: relative; display: inline;">
                    <a href="#" id="btnImageRemove" data-id="{{ $photo->id }}">
                    <img id="image_{{ $product->id }}" src="{{ asset('uploads/dod/'.$photo->image) }}" style="width:30%;" name="">
                    </a>
                    <input type="hidden" name="dod{{ $photo->id }}" value="dod{{ $photo->id }}">
                  </label>
                  @endforeach
                </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputName1">Piston Displacement<span class="required-field">*</span></label>
                  <input name="piston" type="text" class="form-control" required value="{{ $product->piston }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">No. of cylinder<span class="required-field">*</span></label>
                  <input name="cylinder" type="number" class="form-control" required value="{{ $product->cylinder }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Fuel<span class="required-field">*</span></label>
                  <input name="fuel" type="text" class="form-control" required value="{{ $product->fuel }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Mileage<span class="required-field">*</span></label>
                  <input name="milage" type="text" class="form-control" required value="{{ $product->milage }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Year<span class="required-field">*</span></label>
                  <select name="year" class="form-control">
                  	<option value="none" required> -- Select Year -- </option>
                  	@foreach($yearsArr as $row)
					           <option @if($row == $product->year) selected @endif value="{{ $row }}">{{ $row }}</option>
                  	@endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Duration<span class="required-field">*</span></label>
                  <input name="duration" value="{{ $product->duration }}"  type="date" class="form-control" required >
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Car Images<span class="required-field">*</span></label>
                  <input type="file" class="form-control-file" name="product_image[]" multiple>
                </div>
                <button style="margin-bottom: 20px;" form="updateForm" type="submit" class="btn btn-success btn-block mr-2">Update</button>
                {{-- <div id="paypalDiv"><div id="paypal-button"></div></div> --}}
                <hr>
                <h5>Car Images</h5>
                <small>Click the image to remove</small>
                <div class="form-group" id="imageGroup">
                  @foreach($productImages as $photo)
                  <label id="imageRow_{{$photo->id}}" style="position: relative; display: inline;">
                    <a href="#" id="btnImageRemove" data-id="{{ $photo->id }}">
                    <img id="image_{{ $product->id }}" src="{{ asset('uploads/images/'.$photo->image) }}" style="width:30%;" name="">
                    </a>
                    <input type="hidden" name="{{ $photo->id }}" value="{{ $photo->id }}">
                  </label>
                  @endforeach
                </div>
            </div>
          </div>
        </div>
        
    </div>
</div>
</form>
@stop

@section('scripts')
<script>
        $('body').delegate('#imageGroup #btnImageRemove', 'click', function(e) {
            var id = $(this).data(id);
            console.log('image_'+id['id']);
            $('#imageGroup #imageRow_'+id['id']).remove();
        });
    </script>
@stop