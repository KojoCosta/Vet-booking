<div class="bg-light border-end p-3 owner-sidebar" style="width: 250px;">
  <h5 class="mb-4">Owner Menu</h5>

  {{-- Responsive placeholders (optional) --}}
  <div class="d-md-none"></div>
  <div class="d-none d-md-block"></div>

  <ul class="nav flex-column">

    {{-- Dashboard --}}
    <li class="nav-item mb-2">
      <a href="{{ route('owner.dashboard') }}"
         class="nav-link {{ request()->routeIs('owner.dashboard') ? 'fw-bold text-success' : 'text-dark' }}">
        <i class="bx bx-home-alt me-2"></i> Dashboard
      </a>
    </li>

    {{-- My Pets --}}
    <li class="nav-item mb-2">
      <a href="{{ route('owner.pets.index') }}"
         class="nav-link {{ request()->is('dashboard/owner/pets*') ? 'fw-bold text-success' : 'text-dark' }}">
        <i class="bx bx-face me-2"></i> My Pets
      </a>
    </li>

    {{-- Appointments --}}
    <li class="nav-item mb-2">
      <a href="{{ route('owner.appointments.index') }}"
         class="nav-link {{ request()->is('dashboard/owner/appointments') ? 'fw-bold text-success' : 'text-dark' }}">
        <i class="bx bx-calendar me-2"></i> Appointments
      </a>
    </li>

    {{-- Book Appointment --}}
    <li class="nav-item mb-2">
      <a href="{{ route('owner.appointments.create') }}"
         class="nav-link {{ request()->is('dashboard/owner/appointments/create') ? 'fw-bold text-success' : 'text-dark' }}">
        <i class="bx bx-plus-circle me-2"></i> Book Appointment
      </a>
    </li>

    {{-- Profile Settings --}}
    <li class="nav-item mb-2">
      <a href="{{ route('owner.profile.edit') }}"
         class="nav-link {{ request()->is('dashboard/owner/profile') ? 'fw-bold text-success' : 'text-dark' }}">
        <i class="bx bx-user-circle me-2"></i> Profile Settings
      </a>
    </li>

    {{-- Logout --}}
    <li class="nav-item mt-3">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-link nav-link text-danger">
          <i class="bx bx-log-out me-2"></i> Logout
        </button>
      </form>
    </li>

  </ul>
</div>