<ul class="nav flex-column">
        {{-- Dashboard --}}
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'fw-bold bg-success-subtle text-primary-emphasis rounded' : 'text-dark' }}">
                <i class="bx bx-home-alt me-2 text-info"></i> Home
            </a>
        </li>

        {{-- Users --}}
        <li class="nav-item mt-4">
            <h6 class="text-uppercase fw-bolder text-warning-emphasis strong"><hr/>Users</h6>
            <a href="{{ route('admin.users.index') }}"
               class="nav-link {{ request()->routeIs('admin.users.index') ? 'fw-bold bg-success-subtle text-primary-emphasis rounded' : 'text-dark' }}">
                <i class="bx bx-user me-2 text-success"></i> All Users
            </a>
            <a href="{{ route('admin.users.create') }}"
               class="nav-link {{ request()->routeIs('admin.users.create') ? 'fw-bold bg-success-subtle text-primary-emphasis rounded' : 'text-dark' }}">
                <i class="bx bx-user-plus me-2 text-warning"></i> Add User
            </a>
        </li>

        {{-- Pets --}}
        <li class="nav-item mt-4">
            <h6 class="text-uppercase fw-bolder text-warning-emphasis strong"><hr/>Pets</h6>
            <a href="{{ route('admin.pets.index') }}"
               class="nav-link {{ request()->routeIs('admin.pets.index') ? 'fw-bold bg-success-subtle text-primary-emphasis rounded' : 'text-dark' }}">
                <i class="bx bx-data me-2 text-pink"></i> All Pets
            </a>
            {{--<a href="{{ route('admin.pets.create') }}"
               class="nav-link {{ request()->routeIs('admin.pets.create') ? 'fw-bold bg-success-subtle text-primary-emphasis rounded' : 'text-dark' }}">
                <i class="bx bx-plus-circle me-2 text-danger"></i> Add Pet
            </a>--}}
        </li>

        {{-- Appointments --}}
        <li class="nav-item mt-4">
            <h6 class="text-uppercase fw-bolder text-warning-emphasis strong"><hr/>Appointments</h6>
            <a href="{{ route('admin.appointments.index') }}"
               class="nav-link {{ request()->routeIs('admin.appointments.index') ? 'fw-bold bg-success-subtle text-primary-emphasis rounded' : 'text-dark' }}">
                <i class="bx bx-calendar-check me-2 text-primary"></i> View Appointments
            </a>
            <a href="{{ route('admin.appointments.create') }}"
               class="nav-link {{ request()->routeIs('admin.appointments.create') ? 'fw-bold bg-success-subtle text-primary-emphasis rounded' : 'text-dark' }}">
                <i class="bx bx-calendar-plus me-2 text-success"></i> Book Appointment
            </a>
            <a href="{{ route('admin.appointments.react') }}"
               class="nav-link {{ request()->routeIs('admin.appointments.react') ? 'fw-bold bg-success-subtle text-primary-emphasis rounded' : 'text-dark' }}">
                <i class="bx bx-chat me-2 text-warning"></i> React to Appointment
            </a>
        </li>
    </ul>