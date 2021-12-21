<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <title>{{ config('app.name', 'APP') }}</title>

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="{{{ asset('img/favicon.ico') }}}" type="image/ico">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{{ asset('css/bootstrap/3.3.7/bootstrap.min.css') }}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{{ asset('css/font-awesome/4.7.0/font-awesome.min.css') }}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{{ asset('css/Ionicons/2.0.0/ionicons.min.css') }}}">


  <!-- Theme style -->
  <link rel="stylesheet" href="{{{ asset('adminlte/css/AdminLTE.min.css') }}}">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="{{{ asset('adminlte/css/skins/skin-blue.min.css') }}}">



  <link rel="stylesheet" href="{{{ asset('css/myStile.css') }}}">
  <link rel="stylesheet" href="{{{ asset('css/toastr.min.css') }}}">
</head>

<body>
  @yield('content')

  <!-- REQUIRED JS SCRIPTS -->

  <!-- jQuery 3 -->
  <script src="{{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js') }}}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}}"></script>
  <!-- AdminLTE App -->
  <script src="{{{ asset('adminlte/js/adminlte.min.js') }}}"></script>
  <!-- ToasTR.js -->
  <script src="{{{ asset('adminlte/js/toastr.min.js') }}}"></script>

  @yield('listadoJS')
  <!--
    Optionally, you can add Slimscroll and FastClick plugins.
    Both of these plugins are recommended to enhance the
    user experience.
  -->
</body>

</html>