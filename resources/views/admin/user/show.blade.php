@extends('layouts.app2')

@section('styles')
<style>
  ::-webkit-scrollbar-thumb {
    border-radius: 9px;
  background: rgba(96, 125, 139,0.99);
}

.balon1, .balon2 {

  margin-top: 5px !important;
  margin-bottom: 5px !important;

  }


.balon1 a {

  background: #42a5f5;
  color: #fff !important;
  border-radius: 20px 20px 3px 20px;
  display: block;
  max-width: 75%;
  padding: 7px 13px 7px 13px;

  }

.balon1:before {

  content: attr(data-is);
  position: absolute;
  right: 15px;
  bottom: -0.8em;
  display: block;
  font-size: .750rem;
  color: rgba(84, 110, 122,1.0);
  
  }

.balon2 a {

  background: #f1f1f1;
  color: #000 !important;
  border-radius: 20px 20px 20px 3px;
  display: block;
  max-width: 75%;
  padding: 7px 13px 7px 13px;
  
  }
  
.balon2:before {

  content: attr(data-is);
  position: absolute;
  left: 13px;
  bottom: -0.8em;
  display: block;
  font-size: .750rem;
  color: rgba(84, 110, 122,1.0);
  
  }
</style>
@stop

@section('content')
<button type="button" class="btn btn-primary btn-xs" style="margin-bottom: 10px;" onclick="history.back();">Back</button>
<div class="row">
	<div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Member/Auctioneer Information</h4>
          <div class="media">
            {{-- <i class="mdi mdi-earth icon-md text-info d-flex align-self-start mr-3"></i> --}}
            <img style="border-radius: 100%; width: 15%;" src="{{ $user->image == '' ? asset('/admin/images/faces/default_image.png') : asset('/uploads/user/'.$user->image ) }}">
            <div class="media-body" style="padding-top: 20px; padding-left: 20px;">
              <p class="card-text text-capitalize font-weight-bold">{{ $user->firstname. ' ' .$user->middlename. ' ' .$user->lastname }}</p>
              <p class="card-text text-muted">{{ $user->email }}</p>
            </div>
          </div>
          <hr>
          <p>
            <span class="font-weight-bold">{{ $user->type == 'ftb' ? 'First Time Bidder':'Regular Bidder' }}</span> 
          </p>
          <p>
            Contact
            <span class="font-weight-bold">{{ $user->contact }}</span> 
          </p>
          <p>
            Address
            <span class="font-weight-bold">{{ $user->address }}</span> 
          </p>
          <hr>
        </div>
      </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Chat</h4>
          <div id="chatDiv" class="jumbotron" style="background-color: #cbcdcf; height: 300px; overflow-y: scroll;">
            <div id="chatlogs">
              Loading...
            </div>
          </div>
          <form name="form1">
          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <input type="hidden" name="admin_id" disabled value="{{ Auth::user()->id }}" />
          <div class="input-group mb-3">
            <textarea class="form-control" placeholder="Type your message here..." id="msg_area" name="msg"></textarea>
            <div class="input-group-append">
              <a class="btn btn-success" href="#" style="padding-top: 15px;" onclick="submitChat()">Send</a> 
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Items</h4>
          <div class="table-responsive">
            <table id="itemsTable" class="table table-hover table-striped">
              <thead>
                <tr>
                  <th>Description</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                  @foreach($products as $row)
                  <tr>
                    <td>{{ $row->brand. ' ' .$row->name. ' ' .$row->color. ' ' .$row->series }}</td>
                    <td> @if($row->status == 0) <span class="badge badge-default ml-1">Pending</span> @endif @if($row->status == 1) <span class="badge badge-success ml-1">Approved</span> @endif @if($row->status == 2) <span class="badge badge-danger ml-1">Declined</span> @endif </td>
                    <td><a class="btn btn-xs btn-warning" href="{{ route('product.show', $row->product_id) }}">View</a></td>
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
<script>

        function submitChat() {
            if(form1.admin_id.value == '' || form1.msg.value == '') {
                alert("Message cannot be left blank!");
                return;
            }
            var admin_id = form1.admin_id.value;
            var user_id = form1.user_id.value;
            var msg = form1.msg.value;
            var xmlhttp = new XMLHttpRequest();
            
            xmlhttp.onreadystatechange = function() {
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById('chatlogs').innerHTML = xmlhttp.responseText;
                }
            }
            
            xmlhttp.open('GET','/insertadminchat?admin_id='+admin_id+'&msg='+msg+'&user_id='+user_id,true);
            xmlhttp.send();
            form1.msg.value = '';
        }

        $(document).ready(function(e){
            $.ajaxSetup({
                cache: false
            });
            $( "#msg_area" ).keyup(function(e) {
                  var code = e.keyCode || e.which;
                 if(code == 13) { //Enter keycode
                   submitChat();
                 }
            });
            setInterval( function(){ 
              $('#chatlogs').load('/adminchats/'+'{{ $user->id }}'+'/{{ Auth::user()->id }}'); 
              /*var elem = document.getElementById('chatDiv');
              elem.scrollTop = elem.scrollHeight;*/
            }, 1000 );
        });

        </script>

 <script>
   @if(Session::has('success'))
      alert('{{ Session::get('success') }}');
   @endif
 </script>
 <script>
  $(document).ready( function () {
        /*$('#auctionedTable').DataTable({
          "order": [[ 0, "desc" ]],
          "columnDefs": [
              {
                  "targets": [ 0 ],
                  "visible": false,
                  "searchable": false
              }
          ]
        });*/
        $('#itemsTable').DataTable({
          "pageLength": 25
        });
  } );

  var meta = document.createElement('meta');
meta.name = "viewport";
meta.content = "width=1280,initial-scale="+window.innerWidth/1280;
document.getElementsByTagName('head')[0].appendChild(meta);
  </script>
@stop