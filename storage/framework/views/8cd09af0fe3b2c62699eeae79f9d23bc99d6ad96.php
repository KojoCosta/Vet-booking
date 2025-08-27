<div class="bg-light border-end p-3 h-100">
    <div class="sidebar-header mb-4">
            
        <img src="<?php echo e(asset('public/images/logo-img.jpg')); ?>" width="80" class="logo-icon-2" alt="">
        <h4 class="logo-text text-secondary">HansVet</h4>
    </div> 
    <div class="">
        <?php echo $__env->make('dashboard.admin.partials.sidebar-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\vet-booking\resources\views/dashboard/admin/partials/sidebar.blade.php ENDPATH**/ ?>