<nav class="navbar navbar-expand-lg navbar-light bg-dark border-bottom px-4 py-2">
  <div class="container-fluid">
    <span class="navbar-brand h5 mb-0 text-white">Welcome, {{ auth()->user()->name }}</span>

    <ul class="navbar-nav ms-auto">
      <li class="nav-item dropdown bg-white">
        <a class="nav-link dropdown-toggle" href="#" id="vetDropdown" role="button" data-bs-toggle="dropdown">
          <i class="bx bx-user-circle"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="vetDropdown">
          <li>
            <a class="dropdown-item " href="{{ route('veterinarian.profile.edit') }}">Profile</a>
        </li>
          <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="dropdown-item text-danger">Logout</button>
            </form>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>