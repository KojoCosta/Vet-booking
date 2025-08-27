

<?php $__env->startSection('content'); ?>
<h4 class="mb-4">My Pets</h4>


<form method="GET" class="mb-3">
  <div class="input-group" style="max-width: 300px;">
    <select name="species" class="form-select" onchange="this.form.submit()" aria-label="Filter by species">
      <option value="">All Species</option>
      <?php $__currentLoopData = $speciesList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($type); ?>" <?php echo e($species === $type ? 'selected' : ''); ?>>
          <?php echo e(\Illuminate\Support\Str::title($type)); ?>

        </option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php if($species): ?>
      <a href="<?php echo e(route('owner.pets.index')); ?>" class="btn btn-outline-secondary">Reset</a>
    <?php endif; ?>
  </div>
</form>


<a href="<?php echo e(route('owner.pets.create')); ?>" class="btn btn-primary mb-3">
  <i class="bx bx-plus-circle me-1"></i> Add Pet
</a>


<table class="table table-bordered table-hover">
  <thead class="table-light">
    <tr>
      <th>Name</th>
      <th>Species</th>
      <th>Breed</th>
      <th>Sex</th>
      <th>Birthdate</th>
      <th class="text-center">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php $__empty_1 = true; $__currentLoopData = $pets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <tr>
        <td><?php echo e($pet->name); ?></td>
        <td><?php echo e(ucfirst($pet->species)); ?></td>
        <td><?php echo e($pet->breed ?? '—'); ?></td>
        <td><?php echo e(ucfirst($pet->sex)); ?></td>
        <td><?php echo e($pet->birthdate ? \Carbon\Carbon::parse($pet->birthdate)->format('M d, Y') : '—'); ?></td>
        <td class="text-center">
          <a href="<?php echo e(route('owner.pets.edit', $pet)); ?>"
             class="btn btn-sm btn-outline-primary me-2"
             aria-label="Edit <?php echo e($pet->name); ?>">
            <i class="bx bx-edit"></i>
          </a>

          <form method="POST"
                action="<?php echo e(route('owner.pets.destroy', $pet)); ?>"
                class="d-inline"
                onsubmit="return confirm('Delete <?php echo e($pet->name); ?>?')">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit"
                    class="btn btn-sm btn-outline-danger"
                    aria-label="Delete <?php echo e($pet->name); ?>">
              <i class="bx bx-trash"></i>
            </button>
          </form>
        </td>
      </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <tr>
        <td colspan="6" class="text-muted text-center">No pets found.</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.owner.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\vet-booking\resources\views/dashboard/owner/pets/index.blade.php ENDPATH**/ ?>