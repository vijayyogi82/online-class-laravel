<?php $__env->startComponent('mail::message'); ?>
# Welcome, <?php echo e($user['fname']); ?> !!

You are receiving this email because we received a signup request for your this mail account.


<?php $__env->startComponent('mail::button', ['url' => config('app.url')]); ?>
Click Here
<?php echo $__env->renderComponent(); ?>

Thanks,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\xampp\htdocs\eclass_5.4\resources\views/email/welcomeuser.blade.php ENDPATH**/ ?>