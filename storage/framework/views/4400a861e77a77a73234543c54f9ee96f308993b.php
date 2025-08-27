<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Vet Booking')); ?></title>
    <link rel="icon" href="<?php echo e(asset('images/logo-img.jpg')); ?>" type="image/jpg" />

    
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/icons.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/bootstrap-icons.min.css')); ?>" rel="stylesheet">

    
    <link href="<?php echo e(asset('css/sweetalert2.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet">

    
    <style>
        .owner-sidebar {
            transition: transform 0.3s ease;
        }
        .owner-sidebar.hidden {
            transform: translateX(-100%);
        }
    </style>
    <?php echo \Livewire\Livewire::styles(); ?>

</head>
<body>

    
    <?php echo $__env->make('dashboard.veterinarian.partials.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="d-flex">
        <?php echo $__env->make('dashboard.veterinarian.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <main class="flex-grow-1 p-4">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    
    <script src="<?php echo e(asset('js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery-3.5.1.js')); ?>"></script>
    <script src="<?php echo e(asset('js/sweetalert2.min.js')); ?>"></script>
    
    <script>
        document.getElementById('sidebarToggle')?.addEventListener('click', () => {
            document.querySelector('.owner-sidebar')?.classList.toggle('hidden');
        });
    </script>

    
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
</html><?php /**PATH C:\xampp\htdocs\vet-booking\resources\views/dashboard/veterinarian/layout.blade.php ENDPATH**/ ?>