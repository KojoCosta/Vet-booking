

<?php $__env->startSection('content'); ?>
      <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.appointment-list')->html();
} elseif ($_instance->childHasBeenRendered('OcgRtG8')) {
    $componentId = $_instance->getRenderedChildComponentId('OcgRtG8');
    $componentTag = $_instance->getRenderedChildComponentTagName('OcgRtG8');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('OcgRtG8');
} else {
    $response = \Livewire\Livewire::mount('admin.appointment-list');
    $html = $response->html();
    $_instance->logRenderedChild('OcgRtG8', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\vet-booking\resources\views/dashboard/admin/appointments/react.blade.php ENDPATH**/ ?>