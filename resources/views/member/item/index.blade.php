@extends('layouts.app2')

@section('styles')
	 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
@stop

@section('content')
<button type="button" class="btn btn-primary btn-xs" style="margin-bottom: 10px;" onclick="history.back();">Back</button>
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
  	<div class="card">
    	<div class="card-body">
    		<h4 class="card-title">Auctioned Items</h4>
              <div class="table-responsive">
                <table id="auctionedTable" class="table table-hover table-striped">
                  <thead>
                    <tr>
                      <th></th>
	                    <th></th>
	                    <th>Car Description</th>
	                    <th>Floor Price</th>
	                    <th>Highest Bid</th>
	                    <th>Highest Bidder</th>
	                    <th>Due Date</th>
	                    <th>Status</th>
	                    <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($products as $row)
                    <tr>
                      <td>{{ $row->id }}</td>
                      <td><img src="{{ asset('uploads/images/'.$row->thumbnail) }}"></td>
                      <td>{{ $row->brand. ' ' .$row->name. ' ' .$row->color. ' ' .$row->style. ' ' .$row->series }}</td>
                      <td>₱ {{ number_format($row->price) }}</td>
                      <td>{{ $row->h_bid != 'none' ? '₱ '.number_format($row->h_bid):'' }}</td>
                      <td class="text-capitalize">{{ $row->h_bidder != 'none' ? $row->h_bidder:'' }}</td>
                      <td>{{ $row->duration }}</td>
                      <td>
                          @if($today >= $row->duration2) 
                            <span class="badge badge-dark ml-1">Not Available</span> 
                          @else 
                            @if($row->status == 0) 
                              <span class="badge badge-default ml-1">Pending</span> 
                            @endif 

                            @if($row->status == 1) 
                              <span class="badge badge-success ml-1">Approved</span> 
                            @endif 

                            @if($row->status == 2) 
                              <span class="badge badge-danger ml-1">Declined</span>
                            @endif 
                          @endif
                      </td>
                      <td><a href="{{ route('item.show', $row->product_id) }}" class="btn btn-xs btn-secondary">View</a> @if($row->status == 0) <a href="{{ route('item.edit', $row->product_id) }}" class="btn btn-xs btn-secondary">Edit</a>@endif @if($row->status == 0 && (strtotime($row->created_at) > strtotime('-3 days')) ) <button type="submit" class="btn btn-xs btn-secondary" form="deleteItem{{$row->id}}">Delete</button>
                          <form id="deleteItem{{$row->id}}" method="POST" action="{{ route('item.destroy', $row->id) }}" onsubmit="return ConfirmDelete()">
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                            {{ method_field('DELETE') }}
                          </form> @endif </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
    	</div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
  	<div class="card">
    	<div class="card-body">
    		<h4 class="card-title">My Bidded Items</h4>
              <div class="table-responsive">
                <table id="biddedTable" class="table table-hover table-striped">
                  <thead>
                    <tr>
                      <th></th>
	                    <th>Car Description</th>
	                    <th>Bid</th>
	                    <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($bidHistory as $row)
                    <tr>
                      <td>{{ $row->id }}</td>
                    	<td>{{ $row->product->brand. ' ' .$row->product->name. ' ' .$row->product->color. ' ' .$row->product->style. ' ' .$row->product->series }}</td>
                    	<td>₱ {{ number_format($row->bid) }}</td>
                      <td>{{ date('M d, Y h:i:s a', strtotime($row->created_at)) }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
    	</div>
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
    	$(document).ready( function () {
        $('#auctionedTable').DataTable({
          "order": [[ 0, "desc" ]],
          "columnDefs": [
              {
                  "targets": [ 0 ],
                  "visible": false,
                  "searchable": false
              }
          ]
        });

        $('#biddedTable').DataTable({
          "order": [[ 0, "desc" ]],
          "columnDefs": [
              {
                  "targets": [ 0 ],
                  "visible": false,
                  "searchable": false
              }
          ]
        });
    		// $('#auctionedTable').DataTable();
    		// $('#biddedTable').DataTable();
		} );

      // confirm delete
    function ConfirmDelete()
    {
    var x = confirm("Are you sure you want to delete this item?");
    if (x)
      return true;
    else
      return false;
    }
  </script>
@stop