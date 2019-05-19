@extends('layouts.app2')

@section('styles')
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  
@stop

@section('content')
<button type="button" class="btn btn-primary btn-xs" style="margin-bottom: 10px;" onclick="history.back();">Back</button>
<div class="row">
  <div class="col-md-3 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Total Money Received</h4>
          <h1>₱ {{ number_format($money) }}</h1>
        </div>
      </div>
  </div>
  <div class="col-md-9 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Payments</h4>
                <div class="table-responsive">
                  <table id="paymentTable" class="table table-hover table-striped">
                    <thead>
                      <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($payments as $row)
                      <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->created_at->toDayDateTimeString() }}</td>
                        <td><h5 style="color: #0070ba;">{{ $row->description }}</h5><small>{{ $row->action }}</small></td>
                        <td>{{ '₱ '.number_format($row->amount) }}</td>
                      </tr>
                      @endforeach
                    </tbody><!-- 
                    <tfoot>
                        <tr>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                        </tr>
                    </tfoot> -->
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
        $('#paymentTable').DataTable({/*
          initComplete: function () {
                    this.api().columns([0]).every( function () {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo( $(column.footer()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
         
                                column
                                    .search( val ? '^'+val+'$' : '', true, false )
                                    .draw();
                            } );
         
                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } );
                    } );
                }, */
          "pageLength": 25,
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

      var meta = document.createElement('meta');
meta.name = "viewport";
meta.content = "width=1280,initial-scale="+window.innerWidth/1280;
document.getElementsByTagName('head')[0].appendChild(meta);
    
  </script>
@stop