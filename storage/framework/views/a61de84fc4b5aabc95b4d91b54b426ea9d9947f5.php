

<?php $__env->startSection('content'); ?>
<h4 class="mb-4">My Appointments</h4>

<form method="GET" class="mb-4">
    <div class="row g-2">
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">All Statuses</option>
                <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                <option value="confirmed" <?php echo e(request('status') == 'confirmed' ? 'selected' : ''); ?>>Confirmed</option>
                <option value="completed" <?php echo e(request('status') == 'completed' ? 'selected' : ''); ?>>Completed</option>
            </select>
        </div>

        <div class="col-md-3">
            <select name="pet_id" class="form-select">
                <option value="">All Pets</option>
                <?php $__currentLoopData = $pets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($id); ?>" <?php echo e(request('pet_id') == $id ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="col-md-2">
            <input type="date" name="from" class="form-control" value="<?php echo e(request('from')); ?>">
        </div>

        <div class="col-md-2">
            <input type="date" name="to" class="form-control" value="<?php echo e(request('to')); ?>">
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>

        <div class="col-md-2">
            <a href="<?php echo e(route('owner.appointments.index')); ?>" class="btn btn-outline-secondary w-100">Reset</a>
        </div>
    </div>
</form>

<table class="table table-bordered table-hover">
  <thead class="table-light">
    <tr>
      <th>Pet</th>
      <th>Veterinarian</th>
      <th>Date & Time</th>
      <th>Status</th>
      <th class="text-center">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <tr>
        <td><?php echo e($appt->pet->name ?? '—'); ?></td>
        <td><?php echo e($appt->veterinarian->user->name ?? '—'); ?></td>
        <td><?php echo e($appt->scheduled_at ? \Carbon\Carbon::parse($appt->scheduled_at)->format('M d, Y H:i') : '—'); ?></td>
        <td>
          <span class="badge bg-<?php echo e(match($appt->status) {
            'upcoming' => 'info',
            'completed' => 'success',
            'canceled' => 'secondary',
            default => 'dark'
          }); ?>">
            <?php echo e(ucfirst($appt->status)); ?>

          </span>
        </td>
        <td class="text-center">
          <?php if($appt->status === 'upcoming'): ?>
            <form method="POST" action="<?php echo e(route('owner.appointments.cancel', $appt)); ?>"
                  class="d-inline" onsubmit="return confirm('Cancel this appointment?')">
              <?php echo csrf_field(); ?>
              <?php echo method_field('PATCH'); ?>
              <button type="submit" class="btn btn-sm btn-outline-danger" aria-label="Cancel Appointment">
                <i class="bx bx-x-circle"></i> Cancel
              </button>
            </form>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <tr><td colspan="5" class="text-muted text-center">No appointments found.</td></tr>
    <?php endif; ?>
  </tbody>
</table>

<div class="mt-3">
  <?php echo e($appointments->links()); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.owner.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\vet-booking\resources\views/dashboard/owner/appointments/index.blade.php ENDPATH**/ ?>