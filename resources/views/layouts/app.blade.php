<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('public/images/currency.png')}}" type="image/png" />

    <title>{{ config('app.name', 'Laravel') }}</title>

     {{-- Local Bootstrap CSS --}}
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">

    {{-- Local Bootstrap Icons (optional) --}}
    <link href="{{ asset('public/css/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/sweetalert2.min.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        {{-- @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>
<body class="bg-light">
    <div id="app">
        <body class="antialiased text-gray-800 dark:text-gray-200">
  <div class="min-h-screen flex">

    {{-- Main content area --}}
    <div class="flex-1 flex flex-col">
     
              <div class="py-1">
                

                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                  </x-dropdown-link>
                </form>
              </div>
            </div>
          </div>
          
        </div>
      </header>
      
      {{-- Page content --}}
      <main class="flex-1 p-6">
        @yield('content')
      </main>
    </div>
  </div>

    <!-- Local Bootstrap JS Bundle -->
     
    <script src="{{ asset('public/js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('public/js/app.js') }}"></script>
    <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/popper.min.js') }}"></script>

    <!-- Your app JS -->
    <script src="{{ asset('public/assets/js/app.js') }}"></script>
    
    <script src="{{ asset('public/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/jquery-3.5.1.js') }}"></script>

    @if(session('success'))
        <script>
        Swal.fire({
            icon: 'success',
            title: '{{ session('success') }}',
            toast: true,
            position: 'top-end',
            timer: 3000,
            showConfirmButton: false
        });
        </script>
    @endif
<script src="{{ mix('js/app.js') }}"></script>

    @stack('scripts')
</body>
</html>
