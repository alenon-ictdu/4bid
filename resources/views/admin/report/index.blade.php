@extends('layouts.app2')

@section('styles')
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  
@stop

@section('content')
<button type="button" class="btn btn-primary btn-xs" style="margin-bottom: 10px;" onclick="history.back();">Back</button>
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Reported Users</h4>
                <div class="table-responsive">
                  <table id="auctionedTable" class="table table-hover table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Offense</th>
                        <th>Status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($reportedUser as $row)
                        <tr>
                          <td class="text-capitalize">{{ $row->name. ' | ' .$row->reported_id }}</td>
                          <td>{{ $row->reason }}</td>
                          <td class="text-danger">Banned</td>
                          <td><a href="#" class="btn btn-xs btn-success" data-toggle="modal" data-target="#descriptionModal{{ $row->id }}">Description</a></td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
        </div>
      </div>
  </div>
</div>

@foreach($reportedUser as $row)
<!-- Modal -->
<div class="modal fade" id="descriptionModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Description</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-capitalize">{{ $row->description }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach

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