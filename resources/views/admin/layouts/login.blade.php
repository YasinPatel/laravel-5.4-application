<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('params.appTitle')}}</title>

    <!-- Styles -->
    <link href="{{ asset('/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

</head>
<style media="screen">
.navbar-inverse, .btn-primary {
  background-color: #3b5998;
  border-color: #3b5998;
  color: #fff;
}
.navbar-inverse .navbar-brand {
    color: #fff;
}
a{
  color: #3b5998;
}
</style>
<body>
    <div id="app">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container-fluid">
              <a class="navbar-brand" href="javascript:;">{{ config('params.appTitle')}}</a>
              <!-- <a class="navbar-brand" href="#">
                <img alt="Brand" src="...">
              </a> -->
            </div>
        </nav>
        @yield('main_contant')
    </div>
</body>
</html>
<script src="{{asset('js/jquery-2.2.3.min.js')}}"></script>
<script>
     setTimeout(function(){
         $('.alert-dismissable').slideUp();
     },2000);
</script>
