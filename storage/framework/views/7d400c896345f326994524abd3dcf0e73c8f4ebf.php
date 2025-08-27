<div>
    
    <select wire:model="statusFilter" class="form-select mb-3 w-auto">
        <option value="all">All</option>
        <option value="<?php echo e(\App\Models\AppointmentReaction::STATUS_PENDING); ?>">Pending</option>
        <option value="<?php echo e(\App\Models\AppointmentReaction::STATUS_APPROVED); ?>">Approved</option>
        <option value="<?php echo e(\App\Models\AppointmentReaction::STATUS_DECLINED); ?>">Declined</option>
    </select>

    
    <?php if(session()->has('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php elseif(session()->has('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    
    <div wire:loading wire:target="updateAppointmentStatus,updateReactionStatus" class="text-muted small mb-2">
        Updating...
    </div>

    
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo e($appointment->pet->name ?? 'Unknown Pet'); ?></h5>
                        <p><strong>Owner:</strong> <?php echo e($appointment->pet->owner->user->name ?? 'N/A'); ?></p>
                        <p><strong>Scheduled:</strong> <?php echo e($appointment->scheduled_at); ?></p>

                        
                        <p>
                            <strong>Appointment Status:</strong>
                            <span class="badge bg-<?php echo e($appointment->status_badge_class); ?>">
                                <?php echo e($appointment->status_label); ?>

                            </span>
                        </p>

                        
                        <p>
                            <strong>Reaction:</strong>
                            <span class="badge bg-<?php echo e($appointment->reaction->status_badge_class ?? 'secondary'); ?>">
                                <?php echo e($appointment->reaction->status_label ?? 'No reaction'); ?>

                            </span>
                        </p>

                        
                        <label class="form-label"><strong>Update Appointment:</strong></label>
                        <select wire:change="updateAppointmentStatus(<?php echo e($appointment->id); ?>, $event.target.value)" class="form-select mb-2">
                            <option value="">Choose</option>
                            <option value="<?php echo e(\App\Models\Appointment::STATUS_PENDING); ?>">Pending</option>
                            <option value="<?php echo e(\App\Models\Appointment::STATUS_CONFIRMED); ?>">Confirmed</option>
                            <option value="<?php echo e(\App\Models\Appointment::STATUS_CANCELED); ?>">Canceled</option>
                        </select>

                        
                        <label class="form-label"><strong>Update Reaction:</strong></label>
                        <select wire:change="updateReactionStatus(<?php echo e($appointment->id); ?>, $event.target.value)" class="form-select">
                            <option value="">Choose</option>
                            <option value="<?php echo e(\App\Models\AppointmentReaction::STATUS_PENDING); ?>">Pending</option>
                            <option value="<?php echo e(\App\Models\AppointmentReaction::STATUS_APPROVED); ?>">Approve</option>
                            <option value="<?php echo e(\App\Models\AppointmentReaction::STATUS_DECLINED); ?>">Decline</option>
                        </select>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-muted">No appointments found for this filter.</p>
        <?php endif; ?>
    </div>
</div><?php /**PATH C:\xampp\htdocs\vet-booking\resources\views/livewire/vet/appointment-list.blade.php ENDPATH**/ ?>