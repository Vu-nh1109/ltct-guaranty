<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <!-- App favicon -->
    {{-- <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}"> --}}

    @yield('css')
    @stack('css')


    <!-- Bootstrap Css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Toastr Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('libs\toastr\build\toastr.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('slick/slick.css') }}" type="text/css">

    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('slick/slick.js') }}"></script>
    <!-- toastr plugin -->
    <script src="{{ asset('libs\toastr\build\toastr.min.js') }}"></script>


    @yield('js')
    @stack('js')
    
    
</head>

<body>


    <!--          Content -->
    @yield('content')
    <!--          Content -->


</body>

</html>