<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>

        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500" rel="stylesheet">
        {{-- font awesome --}}
        <link rel="stylesheet" href="{{asset('css/all.css')}}">
        {{-- styles --}}
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        @yield('style')

    </head>
    <body>
        @include('layouts.navbar')
        <div class="main-section">
            </div>
        @include('layouts.sidebar')
        @auth
            @include('layouts.uploadform')
        @endauth
        @yield('content')

        <script
            src="https://code.jquery.com/jquery-3.4.0.js"
            integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
            crossorigin="anonymous">
        </script>
        <script>
            $(document).ready(() => {
                ('content');
                // start toggle side nav
                $('#top-nav-menu-btn').click(() => {
                    $('#sidebar').fadeToggle(500);
                })
                // end toggle side nav

                // start toggle upload section
                $('#upload-icon-btn').click(() => {
                    $('#upload-section').fadeToggle(500);
                });
                //


            }); //end on load
        </script>
        @yield('script')


    </body>
</html>
