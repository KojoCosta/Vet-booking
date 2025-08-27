<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{ asset('images/logo-img.jpg') }}" type="image/jpg" />

  <title>{{ config('app.name', 'Laravel') }}</title>

  {{-- Bootstrap & Icons --}}
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/icons.css') }}" rel="stylesheet"> {{-- Boxicons + Linearicons --}}
  <link href="{{ asset('css/bootstrap-icons.min.css') }}" rel="stylesheet"> {{-- Optional if using bi icons --}}
  
  {{-- SweetAlert & Custom Styles --}}
  <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

  {{-- Sidebar Animation --}}
  <style>
    .owner-sidebar {
      transition: transform 0.3s ease;
    }
    .owner-sidebar.hidden {
      transform: translateX(-100%);
    }
  </style>

  @stack('styles')
</head>
<body>

  {{-- Topbar & Sidebar --}}
  @include('dashboard.owner.partials.topbar')
  <div class="d-flex">
    @include('dashboard.owner.partials.sidebar')
    <main class="flex-grow-1 p-4">
      @yield('content')
    </main>
  </div>

  {{-- Scripts --}}
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
  <script src="{{ asset('js/sweetalert2.min.js') }}"></script>

  {{-- React Bundle --}}
  <script type="module" src="{{ asset('js/app.js') }}"></script>
  <script type="module" src="{{ asset('resources/js/app.js') }}"></script>

  @stack('scripts')

  {{-- Sidebar Toggle --}}
  <script>
    document.getElementById('sidebarToggle')?.addEventListener('click', () => {
      document.querySelector('.owner-sidebar')?.classList.toggle('hidden');
    });
  </script>

  {{-- Toast Notification --}}
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      @if(session('success'))
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'success',
          title: "{{ session('success') }}",
          showConfirmButton: false,
          timer: 2000,
          background: '#f0fdfa',
          iconColor: '#059669'
        });
      @endif
    });
  </script>
</body>
</html>