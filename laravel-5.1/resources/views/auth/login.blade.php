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
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <b>Mitra</b>Siaga
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Log in</p>
        
        <div id="form_feedback">
			@if (count($errors) > 0)
			<div class="callout callout-warning">
		      <ul>
			    @foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			    @endforeach
			  </ul>
			</div> 
			@endif
        </div>

        <form action="{{ url('/auth/login') }}" method="post">
		  <input type="hidden" name="_token" value="{{ csrf_token() }}">
			
          <div class="form-group has-feedback">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" onChange="javascript:this.value=this.value.toLowerCase();" autocomplete="off">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox" id="remember"> Remember Me
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>
        
        <br>

        <a href="{{ url('/auth/register') }}"><p>Register</p></a>
        <a href="{{ url('/auth/password') }}"><p>Reset Password</p></a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

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
  </body>
</html>
