<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="/authenticate/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/authenticate/css/style.css">
  <link rel="stylesheet" href="/authenticate/css/adminlte.min.css">
  <link rel="stylesheet" href="/authenticate/plugins/datapicker/datepicker3.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  @include('layouts.menu')
  @yield('content')
  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
      "Focus on being productive instead of busy."
    </div>
    Copyright &copy; 2018-<?php echo date("Y"); ?> <a href="https://github.com/alexandrucanavoiu/TemperatureHumidityLoggerGraph" target="_blank">TemperatureHumidityLoggerGraph</a>.
  </footer>
</div>
<script src="/authenticate/plugins/jquery/jquery.min.js"></script>
<script src="/authenticate/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/authenticate/js/adminlte.min.js"></script>
<script src="/authenticate/plugins/datapicker/bootstrap-datepicker.js"></script>
</body>
</html>
