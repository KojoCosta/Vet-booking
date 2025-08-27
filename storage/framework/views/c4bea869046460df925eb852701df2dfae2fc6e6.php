<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo e(asset('images/logo-img.jpg')); ?>" type="image/jpg" />

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>


    
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">

    
    <link href="<?php echo e(asset('css/bootstrap-icons.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/icons.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/sweetalert2.min.css')); ?>" rel="stylesheet">


    
    <link href="<?php echo e(asset('font/bootstrap-icons.woff2')); ?>" rel="stylesheet">

    
    <link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/sweetalert2.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo \Livewire\Livewire::styles(); ?>


</head>
<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <button class="btn btn-outline-primary d-md-none m-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
                <i class="bx bx-list"></i> Menu
            </button>
            <!-- Static Sidebar for md and up -->
            <div class="d-none d-md-block col-md-3 col-lg-2 px-0">
                <?php echo $__env->make('dashboard.admin.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            
            <div class="col py-3">
                <?php echo $__env->make('dashboard.admin.partials.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="p-4">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </div>
    </div>
    
    <script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/chart.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery-3.5.1.js')); ?>"></script>
    <script src="<?php echo e(asset('js/sweetalert2.min.js')); ?>"></script>

    
  <script type="module" src="<?php echo e(asset('js/app.js')); ?>"></script>
  <script type="module" src="<?php echo e(asset('resources/js/app.js')); ?>"></script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
    <script>
document.addEventListener('DOMContentLoaded', () => {
  <?php if(session('success')): ?>
    Swal.fire({
      toast: true,
      position: 'top-end',
      icon: 'success',
      title: "<?php echo e(session('success')); ?>",
      showConfirmButton: false,
      timer: 2000,
      background: '#f0fdfa',
      iconColor: '#059669'
    });
  <?php endif; ?>
});
</script>

<?php echo \Livewire\Livewire::scripts(); ?>

</body>
</html><?php /**PATH C:\xampp\htdocs\vet-booking\resources\views/dashboard/admin/layout.blade.php ENDPATH**/ ?>