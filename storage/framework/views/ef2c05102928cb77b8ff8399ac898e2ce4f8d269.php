

<?php $__env->startSection('title', 'Pet Records'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0">All Pets</h2>
    <?php if(auth()->user()->role === 'owner'): ?>
      <a href="<?php echo e(route('admin.pets.create')); ?>" class="btn btn-success">
        <i class="bx bx-plus me-1"></i> Add Pet
      </a>
    <?php endif; ?>
    <a href="<?php echo e(route('admin.pets.export')); ?>" class="btn btn-outline-dark">
        <i class="bx bx-download me-1"></i> Export CSV
    </a>
  </div>

  <form method="GET" class="mb-3 d-flex align-items-center">
        <label class="me-2">Filter by species:</label>
        <select name="species" class="form-select w-auto me-2">
            <option value="">All</option>
            <?php $__currentLoopData = ['dog', 'cat', 'bird', 'other']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($type); ?>" <?php echo e(request('species') === $type ? 'selected' : ''); ?>>
                <?php echo e(ucfirst($type)); ?>

            </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <button type="submit" class="btn btn-outline-primary">Apply</button>
    </form>

  <table class="table table-bordered table-hover">
    <thead class="table-light">
      <tr>
        <th>Name</th>
        <th>Species</th>
        <th>Breed</th>
        <th>Sex</th>
        <th>Birthdate</th>
        <th>Owner</th>
        <th>Appointments</th>
        <th>Next Appointment</th>
        <th>Created</th>
      </tr>
    </thead>
    <tbody>
      <?php $__empty_1 = true; $__currentLoopData = $pets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td><?php echo e($pet->name); ?></td>
          <td><?php echo e(ucfirst($pet->species)); ?></td>
          <td><?php echo e($pet->breed); ?></td>
          <td><?php echo e(ucfirst($pet->sex)); ?></td>
          <td><?php echo e(\Carbon\Carbon::parse($pet->birthdate)->format('M d, Y')); ?></td>
          <td><?php echo e($pet->owner->user->name ?? '—'); ?></td>
          <td><?php if($pet->appointments->count()): ?> 
            <span class="badge bg-success"> <?php echo e($pet->appointments->count()); ?> active </span>
                <?php else: ?> 
            <span class="badge bg-secondary">None</span> 
                <?php endif; ?>
          </td>
          <td><?php echo e(optional($pet->appointments->sortBy('date')->first())->date ?? '—'); ?></td>
          <td><?php echo e($pet->created_at->diffForHumans()); ?></td>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
          <td colspan="7" class="text-center text-muted">No pets found.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

  <div class="mt-3">
    <?php echo e($pets->links()); ?>

  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\vet-booking\resources\views/dashboard/admin/pets/index.blade.php ENDPATH**/ ?>