
<div class="mb-3">
  <label for="name" class="form-label">Pet Name</label>
  <input type="text" name="name" id="name" class="form-control"
         value="<?php echo e(old('name', $pet->name ?? '')); ?>" required>
  <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="text-danger small"><?php echo e($message); ?></div>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>


<div class="mb-3">
  <label for="species" class="form-label">Species</label>
  <input type="text" name="species" id="species" class="form-control"
         value="<?php echo e(old('species', $pet->species ?? '')); ?>" required>
  <?php $__errorArgs = ['species'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="text-danger small"><?php echo e($message); ?></div>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>


<div class="mb-3">
  <label for="breed" class="form-label">Breed</label>
  <input type="text" name="breed" id="breed" class="form-control"
         value="<?php echo e(old('breed', $pet->breed ?? '')); ?>">
  <?php $__errorArgs = ['breed'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="text-danger small"><?php echo e($message); ?></div>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>


<div class="mb-3">
  <label for="birthdate" class="form-label">Birthdate</label>
  <input type="date" name="birthdate" id="birthdate" class="form-control"
         value="<?php echo e(old('birthdate', $pet->birthdate ?? '')); ?>">
  <?php $__errorArgs = ['birthdate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="text-danger small"><?php echo e($message); ?></div>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>


<div class="mb-3">
  <label for="sex" class="form-label">Sex</label>
  <select name="sex" id="sex" class="form-select" required>
    <option value="">Choose...</option>
    <option value="male" <?php echo e(old('sex', $pet->sex ?? '') === 'male' ? 'selected' : ''); ?>>Male</option>
    <option value="female" <?php echo e(old('sex', $pet->sex ?? '') === 'female' ? 'selected' : ''); ?>>Female</option>
  </select>
  <?php $__errorArgs = ['sex'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="text-danger small"><?php echo e($message); ?></div>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div><?php /**PATH C:\xampp\htdocs\vet-booking\resources\views/dashboard/owner/pets/_form.blade.php ENDPATH**/ ?>