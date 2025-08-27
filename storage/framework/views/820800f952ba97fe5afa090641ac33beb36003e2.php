<div class="bg-white border-end vh-100 p-3" style="width: 240px;">
  <h5 class="mb-4">Vet Panel</h5>
  <ul class="nav flex-column">
    <li class="nav-item mb-2">
      <a href="<?php echo e(route('veterinarian.dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('veterinarian.dashboard') ? 'active fw-bold' : 'text-dark'); ?>">
        <i class="bx bx-house me-2"></i> Dashboard
      </a>
    </li>
    <li class="nav-item mb-2">
      <a href="<?php echo e(route('veterinarian.appointments.index')); ?>" class="nav-link <?php echo e(request()->routeIs('veterinarian.appointments.index') ? 'active fw-bold' : 'text-dark'); ?>">
        <i class="bx bx-calendar-check me-2"></i> Appointments
      </a>
    </li>
    <li class="nav-item mb-2">
      <a href="<?php echo e(route('veterinarian.profile.edit')); ?>" class="nav-link <?php echo e(request()->routeIs('veterinarian.profile.edit') ? 'active fw-bold' : 'text-dark'); ?>">
        <i class="bx bx-user-circle me-2"></i> Profile
      </a>
    </li>
    <li class="nav-item mt-4">
      <form method="POST" action="<?php echo e(route('logout')); ?>">
        <?php echo csrf_field(); ?>
        <button class="btn btn-outline-danger w-100">
          <i class="bx bx-box-arrow-right me-2"></i> Logout
        </button>
      </form>
    </li>
  </ul>
</div><?php /**PATH C:\xampp\htdocs\vet-booking\resources\views/dashboard/veterinarian/partials/sidebar.blade.php ENDPATH**/ ?>