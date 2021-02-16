<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <title>NSU Portal | North South University</title>
    <link rel="stylesheet" href="/css/NSU_CSS/bootstrap.min.css">
    <link rel="stylesheet" href="/css/NSU_CSS/font-awesome.min.css">
    <link rel="stylesheet" href="/css/NSU_CSS/login-style.css">
    <script type="text/javascript" src="/js/NSU_JS/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="/js/NSU_JS/login.js"></script>
    <script type="text/javascript">
        var ctoday = 1609274475000;
    </script>
    <link rel="shortcut icon" href="assets/images/nsu_logo_title.png" />
</head>

<body>
<div id="navbar" class="navbar navbar-default navbar-collapse faculty-header">
    <div class="navbar-container  container" id="navbar-container">
        <div class="navbar-header pull-left">
            <a href="#" class="navbar-brand">
                <img src="https://rds3.northsouth.edu/assets/images/logo-wide.png" style="max-width:340px">
            </a>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<div class="main-container ace-save-state container" id="main-container">
    <div class="page-content main-content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center" style="margin-top:20px;margin-bottom:20px;">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <div class="login-form">
                    <h3>RDS</h3>
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <img src="https://rds3.northsouth.edu/images/login.png" width="80" height="80"
                                 style="margin-top:10px;">
                        </div>
                        <div class="col-md-9">
                            <form method="post" action={{ route('login') }}>
                                @csrf
                                <p class="headings">NSU Portal : Login<br/><br/></p>
                                <div class="row">
                                    <div class="col-md-3">Username</div>
                                    <div class="col-md-9">
                                        <div class="form-group ">
                                            <input type="text" name="id"  class="form-control @error('id') is-invalid @enderror"
                                                   placeholder="Please enter your User Name"
                                                   id="id" value="{{ old('id') }}"  maxlength="7" autofocus required>
                                            <i class="fa fa-user"></i>
                                            @error('id')
                                                <span class="invalid-feedback text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Password</div>
                                    <div class="col-md-9">
                                        <div class="form-group ">
                                            <input type="password" name="password" class="form-control @error('email') is-invalid @enderror"
                                                   placeholder="Please enter your Password"
                                                   id="password" autofocus required>
                                            <i class="fa fa-user"></i>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" name="commit" value="Next" class="btn btn-success pull-right"/>
                                <div class="clearfix" style="margin-bottom:10px;"></div>
                            </form>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    @if (Route::has('password.request'))
                        <a class="link pull-right" href="{{ route('password.request') }}">Forgot your password?</a>
                    @endif
                    <a class="link" href="{{route('register')}}">Register</a>
                    <div class="time"><span id="txt">Current Server Time: 02:12:15 AM</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="footer-inner">
                <div class="footer-content">
                    <span class="blue">Developed &amp; Maintained By <span class="font-weight-bold text-primary">Full_OF_BUGS</span></span>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

