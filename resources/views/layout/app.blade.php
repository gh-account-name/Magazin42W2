<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
    <script src="{{asset('public/js/bootstrap.bundle.js')}}"></script>
</head>
<style>
    body{
        color: black !important;
        background:linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)),
        url('https://wallpaper.dog/large/20515514.jpg');
        /* background-size: cover; */
    }
    
    .container{
        background-color: white;
        min-height: 100vh;
        padding-bottom: 30px;
        border-top: 1px solid transparent;
    }
</style>
<body>
<script src="{{asset('public/js/vue.global.js')}}"></script>
@include('layout.navbar')
@yield('main')
</body>
</html>