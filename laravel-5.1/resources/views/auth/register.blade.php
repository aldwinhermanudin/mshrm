<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>2016 mshrm ⋅ Account</title>
    
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <link rel="stylesheet" href="{{ asset('/LTEAdmin/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('/LTEAdmin/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/LTEAdmin/plugins/iCheck/square/blue.css') }}">
    
    <script src="{{ asset('/LTEAdmin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    
  </head>
  <body class="hold-transition register-page">
    <div class="register-box">
      <div class="register-logo">
        <b>Mitra</b>Siaga
      </div>
      
      <div class="register-box-body">
        <p class="login-box-msg">Register</p>
        
        <div id="form_feedback"></div>
        
		<div id="form_field">
          <form id="form_1">
            <input type="hidden" id="form_1_token" value="{{ csrf_token() }}">
            
            <div class="form-group has-feedback">
              <input type="text" class="form-control" id="form_1_nip" placeholder="nip" autocomplete="off">
              <span class="glyphicon glyphicon-th-list form-control-feedback"></span>
            </div>
            
            <div class="form-group has-feedback">
              <input type="text" class="form-control" id="form_1_name" placeholder="full name" autocomplete="off">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
          
            <div class="form-group has-feedback">
              <input type="email" class="form-control" id="form_1_email" placeholder="email" onChange="javascript:this.value=this.value.toLowerCase();" autocomplete="off">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            
            <button type="submit" id="form_1_button_submit" class="btn btn-primary btn-block btn-flat">Register</button>
          </form>
        </div>
	    
        <br>
        
        <a href="{{ url('/auth/login') }}"><p>Login</p></a>
        
      </div>
    </div>
    
<script src="{{ asset('/LTEAdmin/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/LTEAdmin/plugins/iCheck/icheck.min.js') }}"></script>
    
<script>
	$(function () {
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' // optional
		});
		});
</script>
    
<script>
$(document).ready(function(){

	$("#form_1").submit(function(event)
	{	
		$("#form_feedback").empty().html("<div style='text-align:center;' class='overlay'><i class='fa fa-refresh fa-spin'></i></div><br>");
		$("#form_1_button_submit").prop('disabled', true);
		$.post("/auth/register",
			{
				_token: $("#form_1_token").val(),
				nip: $("#form_1_nip").val(),
				email: $("#form_1_email").val(),
				name: $("#form_1_name").val(),
			},
		function(data,status){
			if (data == 'OK')
			{
				$("#form_feedback").empty().html("<div class='callout callout-success'><h5>Success, check your email for password.</h5></div>");
				$("#form_1_button_submit").prop('disabled', false);
			}
			else
			{
				$("#form_feedback").empty().html(data);
				$("#form_1_button_submit").prop('disabled', false);
			}
		}).fail(function(data,status){ 
				$("#form_feedback").empty().html("<div class='callout callout-warning'><h5>Error, try again soon.</h5></div>");
				$("#form_1_button_submit").prop('disabled', false);
		});
		event.preventDefault();
	});
});
</script>

  </body>
</html>
