

<?php $__env->startSection('content'); ?>
<div class="container">
  <h4>Edit Profile</h4>
  <form method="POST" action="<?php echo e(route('owner.profile.update')); ?>">
    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

    <div class="mb-3">
      <label>Name</label>
      <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $user->name)); ?>">
    </div>

    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" value="<?php echo e(old('email', $user->email)); ?>">
    </div>

    <div class="mb-3">
      <label>New Password</label>
      <input type="password" name="password" class="form-control">
    </div>

    <div class="mb-3">
      <label>Confirm Password</label>
      <input type="password" name="password_confirmation" class="form-control">
    </div>

    <button class="btn btn-outline-primary">Update Profile</button>
  </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.owner.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\vet-booking\resources\views/dashboard/owner/profile/edit.blade.php ENDPATH**/ ?>