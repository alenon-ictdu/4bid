@extends('layouts.app2')

@section('styles')
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  
@stop

@section('content')
<div class="col-md-12 grid-margin stretch-card">
  	<div class="card">
    	<div class="card-body">
    		<h4 class="card-title">Users</h4>
              <div class="table-responsive">
                <table id="auctionedTable" class="table table-hover table-striped">
                  <thead>
                    <tr>
                      	<th></th>
	                    <th></th>
	                    <th></th>
	                    <th></th>
	                    <th>Name</th>
                      	<th>Email</th>
	                    <th>Contact</th>
	                    <th>Address</th>
	                    <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $row)
                    <tr>
                      <td>{{ $row->id }}</td>
                      <td>@foreach($onlineUsers as $ou) @if($row->id == $ou->id) Online @endif @endforeach</td>
                      <td>@foreach($onlineUsers as $ou) @if($row->id == $ou->id) <i class="fa fa-circle text-success"></i> @endif @endforeach</td>
                      <td><img src="{{ $row->image == '' ? asset('admin/images/faces/default_image.png'):asset('uploads/user/'.$row->image) }}"></td>
                      <td class="text-capitalize">{{ $row->firstname. ' ' .$row->middlename. ' ' .$row->lastname }}</td>
                      <td>{{ $row->email }}</td>
                      <td>{{ $row->contact }}</td>
                      <td>{{ $row->address }}</td>
                      <td><a class="btn btn-xs btn-warning" href="{{ route('user.show', $row->id) }}" >View</a></td>
                    </tr>
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
        	"pageLength": 25,
          "order": [[ 0, "desc" ]],
          "columnDefs": [
              {
                  "targets": [ 0 ],
                  "visible": false,
                  "searchable": false
              },
              {
                  "targets": [ 1 ],
                  "visible": false,
                  "searchable": true
              }
          ]
        });
    		// $('#auctionedTable').DataTable();
    		$('#biddedTable').DataTable();
		} );
  </script>
@stop