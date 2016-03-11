@extends('core.app')

@section('content')
  <title>2016 mshrm ⋅ User Registrar</title>
  <br>
  
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">

	    <h5>User Registrar</h5>

	    <hr>
	    
		<div id="form_feedback"></div>
		<hr>
		
		<div id="form_field">
          <input type="hidden" id="_token" value="{{ csrf_token() }}">

		  <h5 style="font-size:12px;">NRP</h5>
		  <input type="text" class="form-control" id="nrp" placeholder="nrp" autocomplete="off">
		  
		  <h5 style="font-size:12px;">Email Address</h5>
		  <input type="email" class="form-control" id="email" placeholder="alamat email" autocomplete="off" onChange="javascript:this.value=this.value.toLowerCase();">
		  
		  <h5 style="font-size:12px;">Username</h5>
		  <input type="text" class="form-control" id="username" placeholder="username" autocomplete="off">
		  
		  <h5 style="font-size:12px;">Nama lengkap</h5>
		  <input type="text" class="form-control" id="nama_lengkap" placeholder="nama lengkap" autocomplete="off">

		  <h5 style="font-size:12px;">Password</h5>
		  <input type="password" class="form-control" id="password" placeholder="password" autocomplete="off">
  
		  <h5 style="font-size:12px;">Konfirmasi Password</h5>
		  <input type="password" class="form-control" id="password_confirmation" placeholder="retype password" autocomplete="off">
        </div>
        <hr>

        <div id="form_utils">
          <button type="button" id="button_register" class="btn btn-info btn-sm">Register</button>
        </div>
        
      </div> 
    </div>
  </div>

  <br>
  <br>
  <br>

<script>
$(document).ready(function(){

	$("#button_register").click(function(){
		$("#form_feedback").empty().html("<p style='font-size:12px; text-align:center;'><em><img style='width:8px;' src='/assets/gifs/loading.gif' /> Working</em></p>");
		var ajax_token = $("#_token").val();
		var ajax_nrp = $("#nrp").val();
		var ajax_email = $("#email").val();
		var ajax_username = $("#username").val();
		var ajax_nama_lengkap = $("#nama_lengkap").val();
		var ajax_password = $("#password").val();
		var ajax_password_confirmation = $("#password_confirmation").val();
		
		$.post("/system/UserRegister",
			{
				_token: ajax_token,
				nrp: ajax_nrp,
				email: ajax_email,
				username: ajax_username,
				nama_lengkap: ajax_nama_lengkap,
				password: ajax_password,
				password_confirmation: ajax_password_confirmation,
			},
		function(data,status){
			if (data == 'OK')
			{
				$("#form_feedback").empty().html("<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><h5 style='font-size:12px;'>Success.</h5></div>");
			}
			else
			{
				$("#form_feedback").empty().html(data);
			}
		}).fail(function(data,status){ 
				$("#form_feedback").empty().html("<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><h5 style='font-size:12px;'>Error, try again soon.</h5></div>");
		});
	});

});
</script>
@endsection
