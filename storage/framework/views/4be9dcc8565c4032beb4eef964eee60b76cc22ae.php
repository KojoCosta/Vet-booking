<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="icon" href="<?php echo e(asset('images/logo-img.jpg')); ?>" type="image/jpg" />

    <title><?php echo e(config('app.name', 'HansVet')); ?></title>

    <!-- Local Bootstrap CSS -->
    <link href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" rel="stylesheet">

    <!-- Local Bootstrap Icons (optional) -->
    <link href="<?php echo e(asset('assets/css/icons.css')); ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo e(asset('assets/css/custom.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(asset('css/sweetalert2.min.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body style="background: linear-gradient( to left, #aa4d1b, #fcac13 ) !important;">

    <div id="app">
        <main class="py-4 container">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    <!-- Local Bootstrap JS Bundle -->
    <script src="<?php echo e(asset('assests/assets/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assests/assets/js/popper.min.js')); ?>"></script>

    <!-- Your app JS -->
    <script src="<?php echo e(asset('assests/assets/js/app.js')); ?>"></script>
    
    <script src="<?php echo e(asset('js/sweetalert2.all.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/jquery-3.5.1.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\vet-booking\resources\views/layouts/log.blade.php ENDPATH**/ ?>