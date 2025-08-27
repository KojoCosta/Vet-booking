

<?php $__env->startSection('content'); ?>
<h4 class="mb-4">Add a New Pet</h4>

<?php if($errors->any()): ?>
  <div class="alert alert-danger">
    <strong>There were some problems with your input:</strong>
    <ul class="mb-0">
      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($error); ?></li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
  </div>
<?php endif; ?>

<form method="POST" action="<?php echo e(route('owner.pets.store')); ?>">
  <?php echo csrf_field(); ?>

   <?php echo $__env->make('dashboard.owner.pets._form', ['pet' => null], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


  <button type="submit" class="btn btn-success">Save Pet</button>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.owner.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\vet-booking\resources\views/dashboard/owner/pets/create.blade.php ENDPATH**/ ?>