<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                background-image: URL('/img/banner3.jpg');
                background-size: cover;
                font-family: 'Raleway', sans-serif;

            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 90px;
                font-weight: bold;
                color: #FFF;
                text-shadow: 1px 3px 2px #000;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 14px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                color: #F0F0F0;
                text-shadow: 0px 2px 1px #000;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/denr/dashboard') }}">Dashboard</a>
                    @else
                        <a href="{{ url('/') }}">Back</a>
                        <!-- <a href="{{ url('/register') }}">Register</a> -->
                    @endif
                </div>
            @endif

            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="color: #FFF; text-shadow: 1px 0px 5px #000; font-weight: bold; background-color:#D3D3D3; ">
                                <img src="{{URL::asset('/img/denr_logo.png')}}" width="100" height="100" style="float: left; margin-right: 10px;" />
                                REPUBLIC OF THE PHILIPPINES <br/>
                                <hr style="height: 4px; background-color: #848484;  margin-top: 5px; margin-bottom: 5px;" />
                                <b style="text-transform: uppercase;">Department of Environment and Natural Resources</b><br/>
                                MIMAROPA REGION <br/>
                                PENRO - MARINDUQUE
                            </div>
                            <div class="panel-heading" style="color: #5B5B5B; font-weight: bold;" > Login</div>
                            <div class="panel-body" style="font-family: Arial; padding: 40px 100px 100px 100px;">
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    
                                        <div class="col-md-12">
                                            <input id="username" type="username" class="form-control" name="username" value="{{ old('username') }}" autofocus autocomplete="off" placeholder="Username">

                                            @if ($errors->has('username'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('username') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        
                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control" name="password" placeholder="Password">

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">
                                                Login
                                            </button>

                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                Forgot Your Password?
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="panel-footer" >2018</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
