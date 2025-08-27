<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container-fluid">
        <!-- Mobile Toggle Button -->
            

            <!-- Offcanvas Sidebar for Mobile -->
            <div class="offcanvas offcanvas-start d-md-none" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="mobileSidebarLabel">Dashboard Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
               
            </div>
        <div class="navbar-brand">Admin Dashboard</div>
        <div class="d-flex align-items-center gap-3">
            <span class="text-dark">Welcome, <?php echo e(auth()->user()->name); ?></span>
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-sm btn-outline-danger">
                    <i class="bs bs-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        </div>
     </div>
</nav><?php /**PATH C:\xampp\htdocs\vet-booking\resources\views/dashboard/admin/partials/topbar.blade.php ENDPATH**/ ?>