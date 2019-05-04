@extends('layouts.app2')

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@stop

@section('content')


<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      	<div class="card-body">
      		<h5>Sent</h5>
			<div class="table-responsive">
				<table class="table table-hover" id="sentTable">
					<thead>
						<tr>
							<th></th>
							<th>To</th>
							<th>Subject</th>
							<th>Message</th>
							<th>Date</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($sentMessages as $row)
						<tr>
							<td>{{ $row->id }}</td>
							<th class="text-capitalize">{{ $row->user->firstname. ' ' .$row->user->middlename. ' ' .$row->user->lastname }}</th>
							<td class="text-capitalize">{{ $row->subject }}</td>
							<td>{{ strlen($row->message) > 50 ? substr($row->message, 0, 50). '...':$row->message }}</td>
							<td>{{ date('M d, Y h:i:s A', strtotime($row->created_at)) }}</td>
							<td><a data-toggle="modal" data-target="#sentModal{{ $row->id }}" href="#" class="btn btn-xs btn-secondary">View</a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
       		</div>
		</div>
	</div>
</div>

{{-- inbox modal	 --}}
@foreach($inboxArr as $row)       	
<div class="modal fade" id="inboxModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <h4 class="card-title">From: <span class="font-weight-bold">{{ $row->from_name }}</span></h4>
          <p class="card-description">
            Subject: <span class="font-weight-bold">{{ $row->subject }}</span>
          </p>
          <p>
            {{ $row->message }}
          </p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach

{{-- sent modal	 --}}
@foreach($sentMessages as $row)       	
<div class="modal fade" id="sentModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <h4 class="card-title">To: <span class="font-weight-bold">{{ $row->user->firstname. ' ' .$row->user->middlename. ' ' .$row->user->lastname }}</span></h4>
          <p class="card-description">
            Subject: <span class="font-weight-bold">{{ $row->subject }}</span>
          </p>
          <p>
            {{ $row->message }}
          </p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach

@foreach($inboxArr as $row)   
<!-- Modal -->
<div class="modal fade" id="messageModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="forms-sample" method="POST" action="{{ route('inbox.store') }}" id="storeMessageForm{{ $row->id }}">
          {{ csrf_field() }}
          <input type="hidden" name="highestbidder" value="{{ $row->from }}">
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="storeMessageForm{{ $row->id }}">Send</button>
      </div>
    </div>
  </div>
</div>
@endforeach
			
@stop

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
	$('#inboxTable').DataTable({
      "order": [[ 0, "desc" ]],
      "columnDefs": [
          {
              "targets": [ 0 ],
              "visible": false,
              "searchable": false
          }
      ]
    });

    $('#sentTable').DataTable({
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

   	

	/*DELETE MEMBER*/
	$(document).on('click', '#viewInbox', function(e) {
		var id = $(this).data('id');
		var token = $(this).data("token");
		$.ajax(
        {
            url: "inbox/update/"+id,
            type: 'DELETE',
            dataType: "JSON",
            data: {
                "id": id,
                "_method": 'DELETE',
                "_token": token,
            },
            success: function ()
            {
            	$('#inboxModal'+id).modal('show');
            	// console.log(id);
                // $('#members_table #'+id).remove();
            }
        });

	});/*DELETE MEMBER*/
</script>
@stop