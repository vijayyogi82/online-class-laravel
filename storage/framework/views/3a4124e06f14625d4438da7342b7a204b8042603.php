<!-- This will append in sidebar menu -->
<!-- li start-->
<li class="<?php echo e(Nav::isRoute('create.certificate')); ?>">
    <a href="<?php echo e(route('create.certificate')); ?>" class="menu">
        <span><?php echo e(__('Manage Certificate')); ?></span>
    </a>
</li>
<li class="<?php echo e(Nav::isRoute('certificate.setting')); ?>">
    <a href="<?php echo e(route('certificate.setting')); ?>" class="menu">
        <span><?php echo e(__('Certificate Setting')); ?></span>
    </a>
</li>
<!-- li end --><?php /**PATH C:\laragon\www\eclass_5.4\Modules/Certificate\Resources/views/admin/sidebar_menu.blade.php ENDPATH**/ ?>