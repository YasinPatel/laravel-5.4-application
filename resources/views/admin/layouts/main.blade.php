<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" />

  <title>{{ config('params.appTitle') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  @include('admin.layouts.css')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  @include('admin.layouts.top_header')
  @include('admin.layouts.sidebar')

  <div class="content-wrapper">
    @yield('main_contant')
  </div>
  <!-- @include('admin.layouts.footer') -->

</div>
</body>
@include('admin.layouts.scripts')
@yield('custom_scripts')
</html>
