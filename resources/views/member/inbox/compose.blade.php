@extends('layouts.app2')

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@stop

@section('content')


<div class="col-md-8 offset-md-2 grid-margin stretch-card">
    <div class="card">
      	<div class="card-body">
      		<h5>New Message</h5>
          
          <form action="{{ route('inbox.store2') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="exampleInputName1">To</label>
                <select class="js-example-basic-single form-control" name="user" style="text-transform: capitalize;"  required>
                  <option value="none"></option>
                  @foreach($allow as $row)
                  <option value="{{ $row->allow }}">{{ ucwords($row->a_name) . ' ( ' . $row->a_id. ' )'}}</option>
                  @endforeach
                </select>
            </div>

            <div class="form-group">
              <label for="exampleInputName1">Subject</label>
              <input type="text" name="subject" class="form-control" required>
            </div>

            <div class="form-group">
              <label for="exampleInputName1">Message</label>
              <textarea class="form-control" name="message" rows="8" placeholder="Type your message here" required></textarea>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-success btn-block">Send</button>
            </div>
          </form>

		</div>
	</div>
</div>

			
@stop

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
  // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});

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

    @if(count($errors) > 0)
      @foreach($errors->all() as $error)
        toastr.error(
        '',
        '{{ $error }}',
        {
            timeOut: 3000,
            fadeOut: 1000,
            closeButton: true
          }
        );
      @endforeach
    @endif

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