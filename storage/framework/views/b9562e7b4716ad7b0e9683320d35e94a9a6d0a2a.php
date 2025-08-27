

<?php $__env->startSection('content'); ?>
<h4 class="mb-4">Book an Appointment</h4>

<form method="POST" action="<?php echo e(route('owner.appointments.store')); ?>">
  <?php echo csrf_field(); ?>

  <div class="mb-3">
        <label for="pet_id" class="form-label">Pet</label>
        <select name="pet_id" class="form-select" required>
            <option value="">Select Pet</option>
            <?php $__currentLoopData = $pets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($id); ?>" <?php echo e(old('pet_id') == $id ? 'selected' : ''); ?>><?php echo e($name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="vet_id" class="form-label">Veterinarian</label>
        <select name="vet_id" class="form-select" required>
            <option value="">Select Veterinarian</option>
            <?php $__currentLoopData = $vets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($vet->id); ?>" <?php echo e(old('vet_id') == $vet->id ? 'selected' : ''); ?>>
                    <?php echo e($vet->user->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="scheduled_at" class="form-label">Date & Time</label>
        <input type="datetime-local" name="scheduled_at" class="form-control" value="<?php echo e(old('scheduled_at')); ?>" required>
    </div>

    <div class="mb-3">
        <label for="notes" class="form-label">Notes</label>
        <textarea name="notes" class="form-control"><?php echo e(old('notes')); ?></textarea>
    </div>

  <button type="submit" class="btn btn-primary">Book Appointment</button>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.owner.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\vet-booking\resources\views/dashboard/owner/appointments/create.blade.php ENDPATH**/ ?>