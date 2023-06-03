<!-- Google classroom start  -->
<li class="<?php echo e(Nav::isRoute('googleclassroom.setting')); ?>">
    <a href="javaScript:void();">
        <span><?php echo e(__('Google Class Room')); ?></span><i class="feather icon-chevron-right"></i>
    </a>
    <ul class="vertical-submenu">
        <li class="<?php echo e(Nav::isRoute('googleclassroom.setting')); ?>"><a href="<?php echo e(route('googleclassroom.setting')); ?>"><?php echo e(__('Setting')); ?></a></li>
        <li class="<?php echo e(Nav::isRoute('googleclassroom.index')); ?>"><a href="<?php echo e(route('googleclassroom.index')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
        <li class="<?php echo e(Nav::isRoute('googleclassroom.allclass')); ?>"><a href="<?php echo e(route('googleclassroom.allclass')); ?>"><?php echo e(__('All Class')); ?></a></li>
    </ul>
</li>
<!-- Google classroom end  --><?php /**PATH C:\laragon\www\eclass_5.4\Modules/Googleclassroom\Resources/views/layouts/admin_sidebar_menu.blade.php ENDPATH**/ ?>