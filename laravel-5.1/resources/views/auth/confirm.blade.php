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
        <p class="login-box-msg">Reset Password Confirmation</p>

        <div id="form_feedback"></div>
        
        <div id="form_field">
          <form id="form_1">
            <input type="hidden" id="form_1_token" value="{{ csrf_token() }}">
            <input type="hidden" id="form_1_reset_token" value="{{ $reset_token }}">

            <div class="form-group has-feedback">
              <input type="password" class="form-control" id="form_1_password" placeholder="new password">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
          
            <div class="form-group has-feedback">
              <input type="password" class="form-control" id="form_1_password_confirmation" placeholder="retype new password">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <button type="submit" id="form_1_button_submit" class="btn btn-primary btn-block btn-flat">Change Password</button>
          </form>
        </div>
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
		$.post("/auth/confirm",
			{
				_token: $("#form_1_token").val(),
				reset_token: $("#form_1_reset_token").val(),
				password: $("#form_1_password").val(),
				password_confirmation: $("#form_1_password_confirmation").val(),
			},
		function(data,status){
			if (data == 'OK')
			{
				$("#form_feedback").empty().html("<div class='callout callout-success'><h5>Success, password changed.</h5></div>");
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
