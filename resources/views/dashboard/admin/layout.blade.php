<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('images/logo-img.jpg')}}" type="image/jpg" />

    <title>{{ config('app.name', 'Laravel') }}</title>


    {{-- Local Bootstrap CSS --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    {{-- Local Bootstrap Icons (optional) --}}
    <link href="{{ asset('css/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">


    {{-- Local Fonts --}}
    <link href="{{ asset('font/bootstrap-icons.woff2') }}" rel="stylesheet">

    {{-- Optional custom styles --}}
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert2.css') }}" rel="stylesheet">
    @stack('scripts')
    @livewireStyles

</head>
<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <button class="btn btn-outline-primary d-md-none m-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
                <i class="bx bx-list"></i> Menu
            </button>
            <!-- Static Sidebar for md and up -->
            <div class="d-none d-md-block col-md-3 col-lg-2 px-0">
                @include('dashboard.admin.partials.sidebar')
            </div>

            {{-- Main Content --}}
            <div class="col py-3">
                @include('dashboard.admin.partials.topbar')

                <div class="p-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    {{-- Local Bootstrap JS --}}
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>

    {{-- React Bundle --}}
  <script type="module" src="{{ asset('js/app.js') }}"></script>
  <script type="module" src="{{ asset('resources/js/app.js') }}"></script>

    @stack('scripts')
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

@livewireScripts
</body>
</html>