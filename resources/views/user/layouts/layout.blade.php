<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>News</title>

        <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        @stack('styles')
        <style>
            footer {
                background-color: #f8f9fa;
                padding: 20px 0;
                position: absolute;
                bottom: 0;
                width: 100%;
            }
        </style>
    </head>
    <body >

         {{-- @include('layouts.header') --}}

            @yield('content')

         {{-- @include('layouts.footer') --}}

        <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}" rel="stylesheet"></script>
    </body>
</html>
