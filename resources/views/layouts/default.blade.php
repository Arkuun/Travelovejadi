<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="assets/xbackend/icon/favicon.png" type="image/ico" />
    <title>@yield('title')</title>
    <!-- Bootstrap -->
    <link href="assets/xbackend/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="assets/xbackend/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="assets/xbackend/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="assets/xbackend/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <link href="assets/xbackend/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/xbackend/css/scroller.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="assets/xbackend/css/select.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="assets/xbackend/css/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- bootstrap-progressbar -->
    <link href="assets/xbackend/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="assets/xbackend/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="assets/xbackend/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="assets/xbackend/css/custom.css" rel="stylesheet">
    <link href="assets/xbackend/css/select2.min.css" rel="stylesheet">
    <link href="assets/xbackend/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
     @stack('css')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        @include('includes/sidebar')
        @include('includes/topbar')
        <!-- page content -->
        <div class="right_col" role="main">
           @yield('main')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
           <div class="pull-right">

            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="assets/xbackend/vendors/jquery/dist/jquery.min.js"></script>
    <!-- jQuery -->
    <script src="assets/xbackend/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/xbackend/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="assets/xbackend/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="assets/xbackend/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="assets/xbackend/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="assets/xbackend/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="assets/xbackend/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="assets/xbackend/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="assets/xbackend/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="assets/xbackend/vendors/Flot/jquery.flot.js"></script>
    <script src="{{asset('assets/xbackend/vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('assets/xbackend/vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('assets/xbackend/vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('assets/xbackend/vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{asset('assets/xbackend/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{asset('assets/xbackend/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{asset('assets/xbackend/vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{asset('assets/xbackend/vendors/DateJS/build/date.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('assets/xbackend/vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{asset('assets/xbackend/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{asset('assets/xbackend/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('assets/xbackend/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('assets/xbackend/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
     <!-- Sweetalert -->
    <script src="{{asset('assets/xbackend/js/sweetalert.min.js')}}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{asset('assets/xbackend/js/custom.min.js')}}"></script>
    <script src="{{asset('assets/xbackend/js/select2.full.min.js')}}"></script>
     <!-- Datatables -->
    <script src="{{asset('assets/xbackend/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/xbackend/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/xbackend/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{asset('assets/xbackend/js/dataTables.select.min.js')}}"></script>
    <!--TAG-->
    <!-- jQuery Tags Input -->
    <script src="{{asset('assets/xbackend/vendors/jquery.tagsinput/src/jquery.tagsinput.js')}}"></script>
    <!-- Switchery -->
    <script src="{{asset('assets/xbackend/vendors/switchery/dist/switchery.min.js')}}"></script>
    <!-- /ckeditor -->
    <script src="{{asset('assets/xbackend/vendors/ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace( 'editor1',{
             height: 350
        });
        CKEDITOR.replace( 'editor2',{
             height: 150
        });
        CKEDITOR.replace( 'editor3',{
             height: 150
        });
    </script>
    @stack('js')
  </body>
</html>
