@extends('layouts.app2')

@section('styles')
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  
@stop

@section('content')
<div class="col-md-12 grid-margin stretch-card">
  	<div class="card">
    	<div class="card-body">
    		<h4 class="card-title">Declined Cars</h4>
              <div class="table-responsive">
                <table id="auctionedTable" class="table table-hover table-striped">
                  <thead>
                    <tr>
                      <th></th>
	                    <th></th>
	                    <th>Car Description</th>
                      <th>Auctioneer</th>
	                    <th>Floor Price</th>
	                    <th>Due Date</th>
	                    <th>Status</th>
	                    <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($products as $row)
                    @if($row->status == 2)
                    <tr>
                      <td>{{ $row->id }}</td>
                      <td><img src="{{ asset('uploads/images/'.$row->thumbnail) }}"></td>
                      <td>{{ $row->brand. ' ' .$row->name. ' ' .$row->color. ' ' .$row->style. ' ' .$row->series }}</td>
                      <td style="text-transform: capitalize;">{{ $row->user }}</td>
                      <td>₱ {{ $row->price }}</td>
                      <td>{{ $row->duration }}</td>
                      <td>@if($row->status == 0) <span class="badge badge-default ml-1">Pending</span> @endif @if($row->status == 1) <span class="badge badge-success ml-1">Approved</span> @endif @if($row->status == 2) <span class="badge badge-danger ml-1">Declined</span> @endif</td>
                      <td><div class="dropdown">
                          <button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown">
                            Actions
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('product.show', $row->product_id) }}" >View</a>
                            <a class="dropdown-item" href="{{ route('product.edit', $row->product_id) }}">Edit</a>
                          </div>
                        </div> 
                      </td>
                    </tr>
                    @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
    	</div>
    </div>
</div>
@stop

@section('scripts')
	
  	<script>
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
    		// $('#auctionedTable').DataTable();
    		$('#biddedTable').DataTable();
		} );

    var meta = document.createElement('meta');
meta.name = "viewport";
meta.content = "width=1280,initial-scale="+window.innerWidth/1280;
document.getElementsByTagName('head')[0].appendChild(meta);
  </script>
@stop