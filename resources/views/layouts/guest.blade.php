<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('public/images/logo-img.jpg')}}" type="image/jpg" />

    <title>{{ config('app.name') }}</title>

    <!-- Local Bootstrap CSS -->
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Local Bootstrap Icons (optional) -->
    <link href="{{ asset('public/css/icons.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('public/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/custom.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Main Styles -->
    @vite(['resources/css/app.css'])
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-100">

    <!-- Navigation Bar -->
    {{--nav class="bg-dark shadow-sm">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-14 items-center">
                <a href="{{ url('/') }}" class="flex items-center">
                    <img src="{{asset('public/images/logo-img.jpg')}}"   alt="Logo" style="height: 40px; width: auto;">
                </a>

                <div class="space-x-4">
                    @guest
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="text-gray-700 hover:underline">Login</a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-gray-700 hover:underline">Register</a>
                        @endif
                    @else
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:underline">Dashboard</a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>--}}

    <!-- Page Content -->
   <div class="app">
    <main class="container py-4">
    @yield('content')
    </main>
   </div>


    <!-- Main Scripts -->
    @vite(['resources/js/app.js'])
    @stack('scripts')
    <!-- Local Bootstrap JS Bundle -->
    <script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/js/popper.min.js') }}"></script>

    <!-- Your app JS -->
    <script src="{{ asset('public/js/app.js') }}"></script>
    
    <script src="{{ asset('public/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('public/js/jquery-3.5.1.js') }}"></script>
</body>
</html>