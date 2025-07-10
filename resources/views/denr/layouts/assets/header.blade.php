    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{URL::asset('/img/denr_logo.png')}}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{URL::asset('/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{URL::asset('/vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{URL::asset('/dist/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{URL::asset('/vendor/morrisjs/morris.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{URL::asset('/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- DataTables CSS -->
    <link href="{{URL::asset('/vendor/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{URL::asset('/vendor/datatables-responsive/dataTables.responsive.css')}}" rel="stylesheet">

    <script src="{{URL::asset('/vendor/jquery/jquery.min.js')}}"></script>

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <script>
        
        $(document).ready( function () {
                
            $('#table').dataTable( {
                    
                "aaSorting": [[ 0, "asc" ]]
                    
            }).columnFilter();
                
        } );
            
    </script>

    <style type="text/css">

    @media print {

      #mybutton { 
            display:none; 
            visibility:hidden; 
            float:right;
            margin-top:30px;
        }
        
        #gen_link {
            display:none; 
            visibility:hidden; 
            float:right;
            margin-top:30px;
        }
            
    }


        .modalDialog2 {
            overflow-y:auto;
            position: fixed;
            font-family: Arial, Helvetica, sans-serif;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.8);
            z-index: 99999;
            opacity:0;
            -webkit-transition: opacity 400ms ease-in;
            -moz-transition: opacity 400ms ease-in;
            transition: opacity 400ms ease-in;
            pointer-events: none;
        }

        .modalDialog2:target {
            opacity:1;
            pointer-events: auto;
        }

        .modaltextarea {
            font-size:1.1em;
            line-height:1em;
            border:none;
            resize:none;
            width:300px;
            height:80px;
            margin:3px;
            overflow:hidden;
            padding:0px 0px 0px 4px;
        }

        .modalDialog2 > div {
            width:450px;
            position: relative;
            margin: 10% auto;
            /*padding: 5px 20px 13px 20px;*/
            padding:10px;
            border-radius:6px;
            background: #fff;
            line-height:1.8em;
            
        }


        .close2 {
            background: #606061;
            color: #FFFFFF;
            line-height: 25px;
            position: absolute;
            right: -12px;
            text-align: center;
            top: -10px;
            width: 24px;
            text-decoration: none;
            font-weight: bold;
            -webkit-border-radius: 12px;
            -moz-border-radius: 12px;
            border-radius: 12px;
            -moz-box-shadow: 1px 1px 3px #000;
            -webkit-box-shadow: 1px 1px 3px #000;
            box-shadow: 1px 1px 3px #000;
        }
        .close2:hover {
            background: #F00;
            text-decoration:none;
        }

        

    
    </style>    

    @yield('page-css')