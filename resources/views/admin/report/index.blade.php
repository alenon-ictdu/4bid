@extends('layouts.app2')

@section('styles')
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  
@stop

@section('content')
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Payments</h4>
                <div class="table-responsive">
                  <table id="auctionedTable" class="table table-hover table-striped">
                    <thead>
                      <tr>
                        <th>Number of Reports</th>
                        <th>Name</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($reportedUser as $row)
                        @if($row->num_of_report > 0)
                        <tr>
                          <td>{{ $row->num_of_report }}</td>
                          <td class="text-capitalize">{{ $row->name. ' | ' .$row->user_id }}</td>
                          <td class="text-danger">{{ $row->num_of_report > 5 ? 'Banned':'' }}</td>
                        </tr>
                        @endif
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
	
  	<script>
    	$(document).ready( function () {
        $('#auctionedTable').DataTable({
          "pageLength": 25,
          "order": [[ 0, "desc" ]],
        });
    		// $('#auctionedTable').DataTable();
    		// $('#biddedTable').DataTable();
		} );

      var meta = document.createElement('meta');
meta.name = "viewport";
meta.content = "width=1280,initial-scale="+window.innerWidth/1280;
document.getElementsByTagName('head')[0].appendChild(meta);
    
  </script>
@stop