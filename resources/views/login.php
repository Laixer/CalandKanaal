<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminLTE | Sign in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="../../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="../../plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="javascript:void(0);"><b>Caland</b>Kanaal</a>
      </div>
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session </p>
        <form action="#" method="post" id="frm-login">
         <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          <div class="form-group has-feedback">
            <input name="email" type="text" class="form-control" placeholder="Email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input name="password" type="password" class="form-control" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-4 pull-right">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
          </div>
        </form>

        <a href="mailto:info@smartbox-monitoring.com">I can't access my account</a><br>

      </div>
    </div>

    <script src="../../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
		$(document).ready(function() {
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%'
			});
			$('#frm-login').submit(function(e){
				e.preventDefault();
				$('input').prop('disabled', true);
				$('button[type="submit"]').text('Signing in').addClass('disabled');
				$.post( "/login", {email:$('input[name="email"]').val(),password:$('input[name="password"]').val(),_token:$('input[name="_token"]').val()}, function(data){
					var $rs = data;
					if ($rs.error) {
						$('.login-box-msg').html('<font color="red">Email/password invalid</font>');
						$('input').prop('disabled', false);
						$('input[name="password"]').val("");
						$('button[type="submit"]').text('Sign In').removeClass('disabled');
					} else {
						 window.location.replace($rs.location);
					}
				});
			});
		});
	</script>
  </body>
</html>
