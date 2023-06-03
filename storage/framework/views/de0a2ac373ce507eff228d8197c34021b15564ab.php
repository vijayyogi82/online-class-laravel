<li class="<?php echo e(Nav::isRoute('ebook-categories')); ?> <?php echo e(Nav::isRoute('ebook')); ?> <?php echo e(Nav::isRoute('ebook-reviews')); ?> <?php echo e(Nav::isRoute('ebook-orders')); ?>">
    <a href="javaScript:void();" class="menu"><i class="feather icon-user text-secondary"></i>
        <span><?php echo e(__('Ebooks')); ?><div class="sub-menu truncate"><?php echo e(__('Ebook, Category, Reviews, Orders')); ?></div></span>
        <i class="feather icon-chevron-right"></i>
    </a>
    <ul class="vertical-submenu">
        <li class="<?php echo e(Nav::isRoute('ebook-categories')); ?>"><a href="<?php echo e(route('ebook-category')); ?>"><?php echo e(__('Category')); ?></a></li>
        <li class="<?php echo e(Nav::isRoute('ebook')); ?>"><a href="<?php echo e(route('ebook')); ?>"><?php echo e(__('Ebooks')); ?></a></li>
        <li class="<?php echo e(Nav::isRoute('ebook-reviews')); ?>"><a href="<?php echo e(route('ebook-reviews')); ?>"><?php echo e(__('Reviews')); ?></a></li>
        <li class="<?php echo e(Nav::isRoute('ebook-orders')); ?>"><a href="<?php echo e(route('ebook-orders')); ?>"><?php echo e(__('Orders')); ?></a></li>
    </ul>
</li><?php /**PATH C:\laragon\www\eclass_5.4\Modules/Ebook\Resources/views/sidebar/sidebar_menu.blade.php ENDPATH**/ ?>