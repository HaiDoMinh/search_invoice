<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HLNC-CMS | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{!! asset('admin-lte/bower_components/bootstrap/dist/css/bootstrap.min.css') !!}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{!! asset('admin-lte/bower_components/font-awesome/css/font-awesome.min.css') !!}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{!! asset('admin-lte/bower_components/Ionicons/css/ionicons.min.css') !!}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{!! asset('admin-lte/bower_components/select2/dist/css/select2.min.css') !!}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{!! asset('admin-lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}">

    <!-- AdminLTE Skins. Choose a skin from the css/skins the load. -->
    <link rel="stylesheet" href="{!! asset('admin-lte/dist/css/skins/_all-skins.min.css') !!}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{!! asset('admin-lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{!! asset('admin-lte/bower_components/bootstrap-daterangepicker/daterangepicker.css') !!}">

    <link rel="stylesheet" href="{!! asset('admin-lte/plugins/iCheck/all.css') !!}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{!! asset('admin-lte/dist/css/AdminLTE.min.css') !!}">

    <link rel="stylesheet" href="{!! asset('backend/css/custom.css') !!}">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">



    @yield('stylesheet')
{{--    <link rel="stylesheet" type="text/css" href="{!! asset('common/bootrap/css/bootstrap.min.css') !!}">--}}
</head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            @include('backend/layouts/__header')

            <!-- BEGIN SIDEBAR -->
            @include('backend/layouts/__sidebar')

            <div class="content-wrapper" id="page-content">

                @yield('content')
            </div> <!-- page-content -->

            @include('backend/layouts/__footer')

            <div class="control-sidebar-bg"></div>

        </div> <!-- wrapper -->

        <script> var _token = '{!! csrf_token() !!}'; </script>
        <!-- jQuery 3 -->
        <script src="{!! asset('admin-lte/bower_components/jquery/dist/jquery.min.js') !!}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{!! asset('admin-lte/bower_components/jquery-ui/jquery-ui.min.js') !!}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>$.widget.bridge('uibutton', $.ui.button);</script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{!! asset('admin-lte/bower_components/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
        <!-- daterangepicker -->
        <script src="{!! asset('admin-lte/bower_components/bootstrap-daterangepicker/daterangepicker.js') !!}"></script>
        <!-- datepicker -->
        <script src="{!! asset('admin-lte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') !!}"></script>
        <!-- CK Editor -->
        <script src="{!! asset('admin-lte/bower_components/ckeditor/ckeditor.js') !!}"></script>

        <!-- Select2 -->
        <script src="{!! asset('admin-lte/bower_components/select2/dist/js/select2.full.min.js') !!}"></script>
        <!-- DataTables -->
        <script src="{!! asset('admin-lte/bower_components/datatables.net/js/jquery.dataTables.min.js') !!}"></script>
        <script src="{!! asset('admin-lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') !!}"></script>
        <!-- SlimScroll -->
        <script src="{!! asset('admin-lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') !!}"></script>

        <script src="{!! asset('admin-lte/plugins/iCheck/icheck.min.js') !!}"></script>

        <!-- FastClick -->
        <script src="{!! asset('admin-lte/bower_components/fastclick/lib/fastclick.js') !!}"></script>
        <!-- AdminLTE App -->
        <script src="{!! asset('admin-lte/dist/js/adminlte.min.js') !!}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{!! asset('admin-lte/dist/js/pages/dashboard.js') !!}"></script>
        <script src="{!! asset('common/ckeditor/ckeditor.js') !!}"></script>

        <script>
            CKEDITOR.replaceClass= "ckediter";
        </script>
        @yield('scripts')

    </body>
</html>
