<nav class="navbar navbar-expand-lg navbar-light bg-dark border-bottom px-4 py-2">
  <div class="container-fluid">
    <span class="navbar-brand h5 mb-0 text-white">Welcome, <?php echo e(auth()->user()->name); ?></span>

    <ul class="navbar-nav ms-auto">
      <li class="nav-item dropdown bg-white">
        <a class="nav-link dropdown-toggle" href="#" id="vetDropdown" role="button" data-bs-toggle="dropdown">
          <i class="bx bx-user-circle"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="vetDropdown">
          <li>
            <a class="dropdown-item " href="<?php echo e(route('veterinarian.profile.edit')); ?>">Profile</a>
        </li>
          <li>
            <form method="POST" action="<?php echo e(route('logout')); ?>">
              <?php echo csrf_field(); ?>
              <button class="dropdown-item text-danger">Logout</button>
            </form>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav><?php /**PATH C:\xampp\htdocs\vet-booking\resources\views/dashboard/veterinarian/partials/topbar.blade.php ENDPATH**/ ?>