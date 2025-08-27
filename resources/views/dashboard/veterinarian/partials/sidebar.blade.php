<div class="bg-white border-end vh-100 p-3" style="width: 240px;">
  <h5 class="mb-4">Vet Panel</h5>
  <ul class="nav flex-column">
    <li class="nav-item mb-2">
      <a href="{{ route('veterinarian.dashboard') }}" class="nav-link {{ request()->routeIs('veterinarian.dashboard') ? 'active fw-bold' : 'text-dark' }}">
        <i class="bx bx-house me-2"></i> Dashboard
      </a>
    </li>
    <li class="nav-item mb-2">
      <a href="{{ route('veterinarian.appointments.index') }}" class="nav-link {{ request()->routeIs('veterinarian.appointments.index') ? 'active fw-bold' : 'text-dark' }}">
        <i class="bx bx-calendar-check me-2"></i> Appointments
      </a>
    </li>
    <li class="nav-item mb-2">
      <a href="{{ route('veterinarian.profile.edit') }}" class="nav-link {{ request()->routeIs('veterinarian.profile.edit') ? 'active fw-bold' : 'text-dark' }}">
        <i class="bx bx-user-circle me-2"></i> Profile
      </a>
    </li>
    <li class="nav-item mt-4">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-outline-danger w-100">
          <i class="bx bx-box-arrow-right me-2"></i> Logout
        </button>
      </form>
    </li>
  </ul>
</div>