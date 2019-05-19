@extends('layouts.app2')

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@stop

@section('content')
<button type="button" class="btn btn-primary btn-xs" style="margin-bottom: 10px;" onclick="history.back();">Back</button>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
    	<div class="card-body">
    		<h5>Your Notifications</h5>
  			<div class="table-responsive">
  				<table class="table table-hover" id="notifTable">
  					<thead>
  						<tr>
  							<th></th>
  							<th></th>
  							<th></th>
  						</tr>
  					</thead>
  					<tbody>
  						@foreach($uNotification as $row)
              <tr @if($row->status == 0) class="table-dark text-dark" @endif>
                <td>{{ $row->id }}</td>
                <th>{{ $row->description }}</th>
                <td><a data-id="{{ $row->id }}" id="vNotif" data-token="{{ csrf_token() }}"  href="#" class="btn btn-xs btn-primary">View</a></td>
              </tr>
              @endforeach
              @foreach($finishedCar as $row)
              @if($row->duration <= $t)
              <tr @if($row->status2 == 0) class="table-dark text-dark" @endif>
                <td>{{ $row->id }}</td>
                <th>Your <span class="text-capitalize">{{ $row->brand. ' ' .$row->name. ' ' .$row->color }}</span> is finished! </th>
                <td><a href="{{ route('item.show', $row->product_id) }}" class="btn btn-xs btn-primary">View</a></td>
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
{{-- winnernotif modal --}}
  @foreach($uNotification as $row)
  <div class="modal fade" id="wNotifModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">View Notification</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card-body">
            <h4 class="card-title"><span class="font-weight-bold">Congratulations!</span></h4>
            <p class="card-description">
              {{ $row->description }}
            </p>

            <p>You can now send email to the owner <span class="text-capitalize" >{{ $row->owner }}</span> <span style="font-size: 11px;">{{ $row->owner_id }}</span></p>

            <form class="forms-sample" method="POST" action="{{ route('inbox.store') }}" id="storeMessageForm">
              {{ csrf_field() }}
              <input type="hidden" name="highestbidder" value="{{ $row->owner_index }}">
              <div class="form-group">
                <label for="exampleInputEmail1">To</label>
                <input type="text" class="form-control text-capitalize" value="{{ $row->owner }}" disabled required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Subject</label>
                <input type="text" class="form-control" name="subject" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Message</label>
                <textarea class="form-control" name="message" required rows="6"></textarea>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" form="storeMessageForm">Send</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach{{-- winnernotif modal --}}
		
@stop

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
	$('#notifTable').DataTable({
      "order": [[ 0, "desc" ]],
      "columnDefs": [
          {
              "targets": [ 0 ],
              "visible": false,
              "searchable": false
          }
      ]
    });

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

   	

	/*view notif*/
  $(document).on('click', '#vNotif', function(e) {
    var id = $(this).data('id');
    var token = $(this).data("token");
    $.ajax(
        {
            url: "notification/update/"+id,
            type: 'DELETE',
            dataType: "JSON",
            data: {
                "id": id,
                "_method": 'DELETE',
                "_token": token,
            },
            success: function ()
            {
              $('#wNotifModal'+id).modal('show');
              // console.log(id);
                // $('#members_table #'+id).remove();
            }
        });

  });/*view notif*/
</script>
@stop