<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('images/logo-img.jpg')}}" type="image/jpg" />

    <title>{{ config('app.name', 'HansVet') }}</title>

    <!-- Local Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Local Bootstrap Icons (optional) -->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <script src="{{ asset('css/sweetalert2.min.js') }}"></script>
    @stack('styles')
</head>
<body style="background: linear-gradient( to left, #aa4d1b, #fcac13 ) !important;">

    <div id="app">
        <main class="py-4 container">
            @yield('content')
        </main>
    </div>

    <!-- Local Bootstrap JS Bundle -->
    <script src="{{ asset('assests/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assests/assets/js/popper.min.js') }}"></script>

    <!-- Your app JS -->
    <script src="{{ asset('assests/assets/js/app.js') }}"></script>
    
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.5.1.js') }}"></script>
    @stack('scripts')
</body>
</html>
