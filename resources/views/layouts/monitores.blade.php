<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'APP') }}</title>
  <link rel="icon" href="{{{ asset('img/favicon.ico') }}}" type="image/ico">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="{{{ asset('css/monitores/style.css') }}}">
  <link rel="stylesheet" href="{{{ asset('css/bootstrap/4.1.3/bootstrap.min.css') }}}">


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


</head>

<body>
  @yield('content')

  <!-- REQUIRED JS SCRIPTS -->
  <script src="{{{ asset('js/jquery/3.4.1/jquery.min.js') }}}"></script>
  <!-- Bootstrap -->
  <script src="{{{ asset('js/bootstrap/4.1.3/bootstrap.min.js') }}}"></script>

  @yield('listadoJS')
</body>
</html>