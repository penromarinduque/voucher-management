 <!-- jQuery -->
    <script src="{{URL::asset('/vendor/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{URL::asset('/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{URL::asset('/vendor/metisMenu/metisMenu.min.js')}}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{URL::asset('/vendor/raphael/raphael.min.js')}}"></script>
    <script src="{{URL::asset('/vendor/morrisjs/morris.min.js')}}"></script>
    <script src="{{URL::asset('/data/morris-data.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{URL::asset('/dist/js/sb-admin-2.js')}}"></script>

    <script src="{{URL::asset('/js/item/tbl_item.js')}}"></script>

    <!-- DataTables JavaScript -->
    <script src="{{URL::asset('/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('/vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('/vendor/datatables-responsive/dataTables.responsive.js')}}"></script>




    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

    <script>
    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
    // popover demo
    $("[data-toggle=popover]")
        .popover()
    </script>


    <script type="text/javascript">
        
        function MM_openBrWindow(theURL, winName){
            var left = (screen.width/2)-(1050/2);
            var top = (screen.height/2)-(610/2);
            window.open(theURL,winName, 'toolbar=yes, menubar=yes, width=1070, height=540, left='+left+', top='+top);
        }

        function MM_openBrWindow2(theURL, winName){
            var left = (screen.width/2)-(1050/2);
            var top = (screen.height/2)-(610/2);
            window.open(theURL,winName, 'toolbar=yes, menubar=yes, width=1070, height=540, left='+left+', top='+top);
        }

        function MM_openBrWindow_list(theURL, winName){
            var left = (screen.width/2)-(1250/2);
            var top = (screen.height/2)-(600/2);
            window.open(theURL,winName, 'toolbar=yes, menubar=yes, width=1250, height=570, left='+left+', top='+top);
        }

        if (!!window.performance && window.performance.navigation.type === 2) {
              // value 2 means "The page was accessed by navigating into the history"
              console.log('Reloading');
              window.location.reload(); // reload whole page

        }

    </script>

    @yield('page-js')