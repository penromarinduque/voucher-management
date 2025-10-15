<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PENRO Document Action and Tracking System') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body >
    <div id="app" >
        <nav class="navbar navbar-default navbar-static-top" style="background-image: URL('/img/banner3.jpg'); height: 130px; width: 100%; ">
            <div class="container">
                <div class="navbar-header" style="padding: 0px 0px 0px 200px; ">

                    

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{route('welcome')}}" style="color: #FFF; text-shadow: 1px 2px 6px #000; opacity: 1; font-size: 14px; font-weight: 100; font-family: arial; width: 100%">
            
                        <div style="width: 6%; float: left;">
                            <img src="{{URL::asset('/img/denr_logo.png')}}" style="float: left; width: 100%;" />
                        </div>

                        <div style="width: 92%; float: left; padding: 0px 0px 0px 10px;">
                            REPUBLIC OF THE PHILIPPINES
                            <hr style="height: 1px; margin-top: 5px; margin-bottom: 5px;" />
                            <b style="font-size: 18px;">DEPARTMENT OF ENVIRONMENT AND NATURAL RESOURCES</b> <br/>
                            MIMAROPA REGION <br/>
                            PENRO - MARINDUQUE
                        </div>

                    </a>

                </div>

                
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
