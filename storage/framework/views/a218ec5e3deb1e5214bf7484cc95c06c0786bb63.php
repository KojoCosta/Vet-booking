

<?php $__env->startSection('content'); ?>
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('vet.appointment-list')->html();
} elseif ($_instance->childHasBeenRendered('k06jbiD')) {
    $componentId = $_instance->getRenderedChildComponentId('k06jbiD');
    $componentTag = $_instance->getRenderedChildComponentTagName('k06jbiD');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('k06jbiD');
} else {
    $response = \Livewire\Livewire::mount('vet.appointment-list');
    $html = $response->html();
    $_instance->logRenderedChild('k06jbiD', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.veterinarian.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\vet-booking\resources\views/dashboard/veterinarian/appointments/index.blade.php ENDPATH**/ ?>