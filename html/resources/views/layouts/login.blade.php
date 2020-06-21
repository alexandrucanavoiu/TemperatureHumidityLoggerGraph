<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Temperature / Humidity Datacenter</title>
  <link rel="stylesheet" href="/authenticate/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/authenticate/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
  <div class="content-wrapper">
  <br />
    @yield('content')
  </div>
  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
    "Focus on being productive instead of busy."
    </div>
    <strong>Copyright &copy; 2018-<?php echo date("Y"); ?> <a href="https://github.com/alexandrucanavoiu/TemperatureHumidityLoggerGraph">TemperatureHumidityLoggerGraph</a>.</strong>
  </footer>
</div>
<script src="/authenticate/plugins/jquery/jquery.min.js"></script>
<script src="/authenticate/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/authenticate/js/adminlte.min.js"></script>
</body>
</html>
