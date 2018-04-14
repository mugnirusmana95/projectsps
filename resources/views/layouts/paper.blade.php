<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{asset('icon.png')}}">
    <title>@yield('paper_title')</title>
    <link rel="stylesheet" href="{{asset('css/paper.css')}}">
  </head>
  <body onload="window.print()">
    <div class="page">
      @yield('paper_main')
    </div>
  </body>
</html>
