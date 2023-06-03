<?php if($cats->courses_count >= 4): ?>
<div class="view-button txt-rgt">
    <a href="<?php echo e(route('category.page',['id' => $cats->id, 'category' => $cats->title])); ?>" class="btn btn-secondary" title="<?php echo e(__('View More')); ?>"><?php echo e(__('View More')); ?><i data-feather="chevrons-right"></i>
    </a>
</div>
<?php endif; ?><?php /**PATH C:\laragon\www\eclass_5.4\resources\views/btntab.blade.php ENDPATH**/ ?>