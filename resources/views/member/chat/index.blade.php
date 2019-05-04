@extends('layouts.app2')

@section('styles')

@stop

@section('content')
<div class="row">
	<div class="col-md-6 offset-md-3 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          	<h4 class="card-title">Admin</h4>
          	<div class="jumbotron" style="background-color: #cbcdcf; height: 500px; overflow-y: scroll;">
          		<div id="chatlogs">
              		Loading...
            	</div>
			  	<!-- <div align='right' style='margin-top:5px; width: 100%;'> <small>date</small> <p class='btn btn-rounded btn-primary'>dsadsadsa</p></div>
			  	<div style='margin-top:5px; width: 100%;'><p class='btn btn-rounded btn-secondary'>dsadsadsa</p> <small>date</small> </div> -->
			</div>
			<form name="form1">
	          <input type="hidden" name="admin_id" value="{{ $admin->id }}">
	          <input type="hidden" name="user_id" disabled value="{{ Auth::user()->id }}" />
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
@stop

@section('scripts')
<script>
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
          $('#chatlogs').load('/adminchats/'+'{{ Auth::user()->id }}'+'/{{ $admin->id }}'); 
          /*var elem = document.getElementById('chatDiv');
          elem.scrollTop = elem.scrollHeight;*/
        }, 1000 );
    });

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
        
        xmlhttp.open('GET','/insertuserchat?admin_id='+admin_id+'&msg='+msg+'&user_id='+user_id,true);
        xmlhttp.send();
        form1.msg.value = '';
    }
</script>

@stop