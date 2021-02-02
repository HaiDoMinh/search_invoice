<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{!! ENV('APP_NAME_LONG') !!}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/STS-W.png') }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{!! asset('admin-lte/bower_components/bootstrap/dist/css/bootstrap.min.css') !!}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{!! asset('admin-lte/bower_components/font-awesome/css/font-awesome.min.css') !!}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{!! asset('admin-lte/bower_components/Ionicons/css/ionicons.min.css') !!}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{!! asset('admin-lte/dist/css/AdminLTE.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin-lte/plugins/iCheck/square/blue.css') !!}">

    <link rel="stylesheet" href="{!! asset('css/app.css') !!}">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition login-page">


    @yield('content')


    <script> var _token = '{!! csrf_token() !!}'; </script>
    <script src="{!! asset('admin-lte/bower_components/jquery/dist/jquery.min.js') !!}"></script>
    <script src="{!! asset('admin-lte/bower_components/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('admin-lte/plugins/iCheck/icheck.min.js') !!}"></script>

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
    </script>

</body>
</html>
