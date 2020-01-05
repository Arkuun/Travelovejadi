<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>........</title>
    <!-- Bootstrap -->
    <link href="assets/xbackend/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="assets/xbackend/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="assets/xbackend/css/main.css" rel="stylesheet">
    <!-- Custom Style -->
    <link href="assets/xbackend/css/util.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="assets/xbackend/icon/favicon.png">
    <link rel="manifest" href="">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="">
    <meta name="theme-color" content="#ffffff">
</head>
<body style="background-color: #666666;">
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" method="post" action="
                {{route('checklogin')}}">
                    {!! csrf_field() !!}
                    @if(session('message'))
                      <div class="alert alert-{{session('message')['status']}}">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          {{ session('message')['desc'] }}
                      </div>
                      @endif

                    <div class="text-center">
                        <img src="assets/xbackend/logo/login.png" width="">
                    </div>
                    <span class="login100-form-title p-b-43">
                        Login
                    </span>
                    @if ($errors->has('username'))
                        <div class="alert alert-info" role="alert">
                         {{ $errors->first('username') }}
                        </div>
                    @endif
                    <label for="uname"><b>Email</b></label>
                    <div class="wrap-input100">
                        <input class="input100" type="text" name="email" autofocus="" required="">
                    </div>
                    <label for="uname"><b>Password</b></label>
                    <div class="wrap-input100">
                        <input class="input100" type="password" name="password" required="">
                    </div>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button><br/><br/><br/>
                        <center><p>&copy; 2018  <br/> </p></center>
                    </div>
                </form>
                <div class="login100-more" style="background-image: url('assets/xbackend/logo/login_bg.jpg')">
                    <div class="text-center">
                        <img src="assets/xbackend/logo/loginx.png" width="100px" style="margin-top: 40px;">
                    </div>
                    <h3 align="center" class="bg"></h3>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
