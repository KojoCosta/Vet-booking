<div class="bg-light border-end p-3 owner-sidebar" style="width: 250px;">
  <h5 class="mb-4">Owner Menu</h5>

  
  <div class="d-md-none"></div>
  <div class="d-none d-md-block"></div>

  <ul class="nav flex-column">

    
    <li class="nav-item mb-2">
      <a href="<?php echo e(route('owner.dashboard')); ?>"
         class="nav-link <?php echo e(request()->routeIs('owner.dashboard') ? 'fw-bold text-success' : 'text-dark'); ?>">
        <i class="bx bx-home-alt me-2"></i> Dashboard
      </a>
    </li>

    
    <li class="nav-item mb-2">
      <a href="<?php echo e(route('owner.pets.index')); ?>"
         class="nav-link <?php echo e(request()->is('dashboard/owner/pets*') ? 'fw-bold text-success' : 'text-dark'); ?>">
        <i class="bx bx-face me-2"></i> My Pets
      </a>
    </li>

    
    <li class="nav-item mb-2">
      <a href="<?php echo e(route('owner.appointments.index')); ?>"
         class="nav-link <?php echo e(request()->is('dashboard/owner/appointments') ? 'fw-bold text-success' : 'text-dark'); ?>">
        <i class="bx bx-calendar me-2"></i> Appointments
      </a>
    </li>

    
    <li class="nav-item mb-2">
      <a href="<?php echo e(route('owner.appointments.create')); ?>"
         class="nav-link <?php echo e(request()->is('dashboard/owner/appointments/create') ? 'fw-bold text-success' : 'text-dark'); ?>">
        <i class="bx bx-plus-circle me-2"></i> Book Appointment
      </a>
    </li>

    
    <li class="nav-item mb-2">
      <a href="<?php echo e(route('owner.profile.edit')); ?>"
         class="nav-link <?php echo e(request()->is('dashboard/owner/profile') ? 'fw-bold text-success' : 'text-dark'); ?>">
        <i class="bx bx-user-circle me-2"></i> Profile Settings
      </a>
    </li>

    
    <li class="nav-item mt-3">
      <form method="POST" action="<?php echo e(route('logout')); ?>">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-link nav-link text-danger">
          <i class="bx bx-log-out me-2"></i> Logout
        </button>
      </form>
    </li>

  </ul>
</div><?php /**PATH C:\xampp\htdocs\vet-booking\resources\views/dashboard/owner/partials/sidebar.blade.php ENDPATH**/ ?>