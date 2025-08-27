

<?php $__env->startSection('title', 'Veterinarian Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <h2 class="h4 mb-4">Welcome, Dr. <?php echo e(auth()->user()->name); ?></h2>

    
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Your Profile</h5>
            <p><strong>Name (as used in the clinic):</strong> <?php echo e($vet->vet_name ?? 'Not set'); ?></p>
            <p><strong>Email:</strong> <?php echo e(auth()->user()->email); ?></p>
            <p><strong>Specialty:</strong> <?php echo e($vet->specialization ?? 'Not set'); ?></p>
            <p><strong>Phone:</strong> <?php echo e($vet->phone ?? 'Not set'); ?></p>
        </div>
    </div>

    
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Appointments Overview</h5>
            <p><strong>Total Appointments:</strong> <?php echo e($appointmentCount); ?></p>
        </div>
    </div>
</div>


<div class="row mb-4">
    <?php
        $statuses = ['pending', 'confirmed', 'completed', 'cancelled'];
        $colors = ['warning', 'primary', 'success', 'danger'];
    ?>

    <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3 mb-3">
            <div class="card border-<?php echo e($colors[$index]); ?>">
                <div class="card-body text-center">
                    <h6 class="text-uppercase text-<?php echo e($colors[$index]); ?>"><?php echo e(ucfirst($status)); ?></h6>
                    <h3 class="fw-bold"><?php echo e($statusCounts[$status] ?? 0); ?></h3>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.veterinarian.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\vet-booking\resources\views/dashboard/veterinarian/index.blade.php ENDPATH**/ ?>