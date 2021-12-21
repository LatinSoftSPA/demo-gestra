<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <meta name="theme-color" content="#db5945">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'APP') }} LS - (Version {{ config('app.version', 'X') }})</title>
    <link rel="icon" href="{{{ asset('img/favicon.ico') }}}" type="image/ico">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <!-- Google Font -->
    <!-- Styles -->

    <link rel="stylesheet" href="adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="adminlte/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="adminlte/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="adminlte/css/AdminLTE.min.css">

    <link rel="stylesheet" href="adminlte/css/myStile.css">


    <style type="text/css">
        .fondo {
            background-image: url("{{ asset('adminlte/img/lock23.png') }}") #fff;
        }
    </style>
</head>

<body class="fondo">
    <div class="container-fluid">
        @yield('content')
    </div>
</body>

</html>