

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0">Manage Members</h2>
        <a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-primary">
        <i class="bx bx-user-plus me-1"></i> Add Member
        </a>
    </div>

            
        <form action="<?php echo e(route('admin.users.index')); ?>" method="GET" class="row g-2 mb-4">
            <div class="col-md-5">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search by name or email..."
                value="<?php echo e(request('search')); ?>"
            >
            </div>
            <div class="col-md-3">
            <select name="role" class="form-select">
                <option value="">All Roles</option>
                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($r); ?>" <?php echo e(request('role') === $r ? 'selected' : ''); ?>>
                    <?php echo e(ucfirst($r)); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            </div>
            
            <div class="col-md-1 d-grid">
            <button type="submit" class="btn btn-outline-info">
                <i class="bx bx-filter"></i> Filter
            </button>
            </div>
        </form>


    
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col">
            <div class="card h-100 shadow-sm text-center">
                <div class="card-body text-center">
                    <img src="<?php echo e($user->avatar ? asset('storage/'.$user->avatar) : asset('images/default.jpg')); ?>" alt="Avatar of <?php echo e($user->name); ?>"
                        class="rounded-circle mt-3" width="90" height="90" >
                    <div class="card-body">
                        <h5 class="card-title mb-1"><?php echo e($user->name); ?></h5>
                        <p class="card-text text-muted mb-2"><?php echo e($user->email); ?></p>
                        <span class="badge bg-secondary mb-3"><?php echo e(ucfirst($user->role)); ?></span>
                        <div>
                            <a href="<?php echo e(route('admin.users.edit', $user)); ?>" class="btn btn-sm btn-outline-primary" >
                                <i class="bx bx-pencil-square me-1"></i> Edit Member
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12">
            <div class="alert alert-danger text-center mb-0">
            No members found matching your search.
            </div>
        </div>
        <?php endif; ?>
    </div>

    
    <div class="mt-4">
        <?php echo e($users->withQueryString()->links('pagination::bootstrap-5')); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\vet-booking\resources\views/dashboard/admin/users/index.blade.php ENDPATH**/ ?>