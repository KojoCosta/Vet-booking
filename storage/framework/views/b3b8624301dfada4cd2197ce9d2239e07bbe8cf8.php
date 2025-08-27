<ul class="nav flex-column">
        
        <li class="nav-item">
            <a href="<?php echo e(route('admin.dashboard')); ?>"
               class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'fw-bold bg-success-subtle text-primary-emphasis rounded' : 'text-dark'); ?>">
                <i class="bx bx-home-alt me-2 text-info"></i> Home
            </a>
        </li>

        
        <li class="nav-item mt-4">
            <h6 class="text-uppercase fw-bolder text-warning-emphasis strong"><hr/>Users</h6>
            <a href="<?php echo e(route('admin.users.index')); ?>"
               class="nav-link <?php echo e(request()->routeIs('admin.users.index') ? 'fw-bold bg-success-subtle text-primary-emphasis rounded' : 'text-dark'); ?>">
                <i class="bx bx-user me-2 text-success"></i> All Users
            </a>
            <a href="<?php echo e(route('admin.users.create')); ?>"
               class="nav-link <?php echo e(request()->routeIs('admin.users.create') ? 'fw-bold bg-success-subtle text-primary-emphasis rounded' : 'text-dark'); ?>">
                <i class="bx bx-user-plus me-2 text-warning"></i> Add User
            </a>
        </li>

        
        <li class="nav-item mt-4">
            <h6 class="text-uppercase fw-bolder text-warning-emphasis strong"><hr/>Pets</h6>
            <a href="<?php echo e(route('admin.pets.index')); ?>"
               class="nav-link <?php echo e(request()->routeIs('admin.pets.index') ? 'fw-bold bg-success-subtle text-primary-emphasis rounded' : 'text-dark'); ?>">
                <i class="bx bx-data me-2 text-pink"></i> All Pets
            </a>
            
        </li>

        
        <li class="nav-item mt-4">
            <h6 class="text-uppercase fw-bolder text-warning-emphasis strong"><hr/>Appointments</h6>
            <a href="<?php echo e(route('admin.appointments.index')); ?>"
               class="nav-link <?php echo e(request()->routeIs('admin.appointments.index') ? 'fw-bold bg-success-subtle text-primary-emphasis rounded' : 'text-dark'); ?>">
                <i class="bx bx-calendar-check me-2 text-primary"></i> View Appointments
            </a>
            <a href="<?php echo e(route('admin.appointments.create')); ?>"
               class="nav-link <?php echo e(request()->routeIs('admin.appointments.create') ? 'fw-bold bg-success-subtle text-primary-emphasis rounded' : 'text-dark'); ?>">
                <i class="bx bx-calendar-plus me-2 text-success"></i> Book Appointment
            </a>
            <a href="<?php echo e(route('admin.appointments.react')); ?>"
               class="nav-link <?php echo e(request()->routeIs('admin.appointments.react') ? 'fw-bold bg-success-subtle text-primary-emphasis rounded' : 'text-dark'); ?>">
                <i class="bx bx-chat me-2 text-warning"></i> React to Appointment
            </a>
        </li>
    </ul><?php /**PATH C:\xampp\htdocs\vet-booking\resources\views/dashboard/admin/partials/sidebar-menu.blade.php ENDPATH**/ ?>