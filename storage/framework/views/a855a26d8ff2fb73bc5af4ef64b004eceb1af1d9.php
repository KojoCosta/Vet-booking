

<?php $__env->startSection('title', 'Owner Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
  <h2 class="mb-4">Welcome, <?php echo e(auth()->user()->name); ?></h2>

  <div class="card mb-4">
    <div class="card-header bg-info text-white">Upcoming Appointments</div>
    <div class="card-body">
      <?php if($appointments->count()): ?>
        <ul class="list-group">
          <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <?php echo e($appt->pet->name); ?> with Dr. <?php echo e($appt->veterinarian->user->name ?? '—'); ?>

              <span class="badge bg-primary"><?php echo e(\Carbon\Carbon::parse($appt->scheduled_at)->format('M d, H:i')); ?></span>
            </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      <?php else: ?>
        <p>No upcoming appointments.</p>
      <?php endif; ?>
    </div>
  </div>
</div>
<div id="owner-pets-root"></div>

<?php $__env->startPush('scripts'); ?>
  
  <script src="<?php echo e(asset('resources/js/app.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.owner.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\vet-booking\resources\views/dashboard/owner/index.blade.php ENDPATH**/ ?>