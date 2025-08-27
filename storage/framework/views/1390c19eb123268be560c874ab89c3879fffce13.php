

<?php $__env->startSection('title', 'Appointments'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
  <h2 class="h4 mb-4">All Appointments</h2>

  
  <form method="GET" class="row g-2 mb-3">
    <div class="col-md-3">
      <select name="vet_id" class="form-select">
        <option value="">All Vets</option>
        <?php $__currentLoopData = $vets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($vet->id); ?>" <?php echo e(request('vet_id') == $vet->id ? 'selected' : ''); ?>>
            <?php echo e($vet->user->name); ?>

          </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
    </div>
    <div class="col-md-3">
      <select name="status" class="form-select">
        <option value="">All Statuses</option>
        <?php $__currentLoopData = ['upcoming', 'completed', 'cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($status); ?>" <?php echo e(request('status') == $status ? 'selected' : ''); ?>>
            <?php echo e(ucfirst($status)); ?>

          </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
    </div>
    <div class="col-md-3">
      <input type="date" name="date" value="<?php echo e(request('date')); ?>" class="form-control">
    </div>
    <div class="col-md-3">
      <button type="submit" class="btn btn-outline-primary w-100">Filter</button>
    </div>
  </form>

  
  <table class="table table-bordered table-hover">
    <thead class="table-light">
      <tr>
        <th>Pet</th>
        <th>Owner</th>
        <th>Veterinarian</th>
        <th>Scheduled At</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td><?php echo e($appt->pet->name); ?></td>
          <td><?php echo e($appt->pet->owner->user->name ?? '—'); ?></td>
          <td><?php echo e($appt->veterinarian->user->name ?? '—'); ?></td>
          <td><?php echo e(\Carbon\Carbon::parse($appt->scheduled_at)->format('M d, Y h:i A')); ?></td>
          <td>
            <span class="badge bg-<?php echo e($appt->status_badge_class); ?>">
              <?php echo e($appt->status_label); ?>

            </span>

            <div id="status-control-<?php echo e($appt->id); ?>"></div>
            <script>
              window.reactMounts = window.reactMounts || [];
              window.reactMounts.push({
                id: "status-control-<?php echo e($appt->id); ?>",
                component: "AppointmentStatusControl",
                props: {
                  appointmentId: <?php echo e($appt->id); ?>,
                  currentStatus: "<?php echo e($appt->status); ?>"
                }
              });
            </script>
          </td>
          <td>
            <a href="<?php echo e(route('admin.appointments.edit', $appt)); ?>" class="btn btn-sm btn-outline-primary">Edit</a>
            <form action="<?php echo e(route('admin.appointments.destroy', $appt)); ?>" method="POST" class="d-inline">
              <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
              <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this appointment?')">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="7" class="text-center text-muted">No appointments found.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>

  <div class="mt-3">
    <?php echo e($appointments->links()); ?>

  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('dashboard.admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\vet-booking\resources\views/dashboard/admin/appointments/index.blade.php ENDPATH**/ ?>