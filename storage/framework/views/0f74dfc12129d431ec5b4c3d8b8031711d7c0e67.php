
<?php
if(Schema::hasTable('color_options')){
  $color = App\ColorOption::first();
}
?>
<?php if(isset($color)): ?>

<style type="text/css">
  
  :root {
  --linear-gradient-bg-color:linear-gradient(-45deg, <?php echo e($color['linear_bg_one']); ?> 0, <?php echo e($color['linear_bg_two']); ?> 100%);
  --linear-gradient-reverse-bg-color:linear-gradient(-45deg, <?php echo e($color['linear_reverse_bg_one']); ?> 0, <?php echo e($color['linear_reverse_bg_two']); ?> 100%);
  --linear-gradient-about-bg-color:linear-gradient(197.61deg, <?php echo e($color['linear_about_bg_one']); ?> , <?php echo e($color['linear_about_bg_two']); ?>);
  --linear-gradient-about-blue-bg-color:linear-gradient(40deg, <?php echo e($color['linear_about_bluebg_one']); ?> 33%, <?php echo e($color['linear_about_bluebg_two']); ?> 84%);
  --linear-gradient-career-bg-color:linear-gradient(22.72914987deg, <?php echo e($color['linear_career_bg_one']); ?> 4%, <?php echo e($color['linear_career_bg_two']); ?>);
  --background-blue-bg-color: <?php echo e($color['blue_bg']); ?>;
  --background-red-bg-color: <?php echo e($color['red_bg']); ?>; 
  --background-grey-bg-color:<?php echo e($color['grey_bg']); ?>;
  --background-light-grey-bg-color:<?php echo e($color['light_grey_bg']); ?>;
  --background-black-bg-color:<?php echo e($color['black_bg']); ?>;
  --background-white-bg-color:<?php echo e($color['white_bg']); ?>;
  --background-mehroon-bg-color:<?php echo e($color['dark_red_bg']); ?>;
  --text-black-color:<?php echo e($color['black_text']); ?>;
  --text-light-grey-color:<?php echo e($color['light_grey_text']); ?>;
  --text-dark-grey-color:<?php echo e($color['dark_grey_text']); ?>;
  --text-red-color:<?php echo e($color['red_text']); ?>;
  --text-blue-color:<?php echo e($color['blue_text']); ?>;
  --text-dark-blue-color:<?php echo e($color['dark_blue_text']); ?>;
  --text-white-color:<?php echo e($color['white_text']); ?>;
}
</style>

<?php else: ?>

<style type="text/css">
 :root {

  --linear-gradient-bg-color:linear-gradient(-45deg, #F44A4A 0, #6E1A52 100%);
  --linear-gradient-reverse-bg-color:linear-gradient(-45deg, #6E1A52 0,#F44A4A 100%);
  --linear-gradient-about-bg-color:linear-gradient(197.61deg,#F44A4A,#6E1A52);
  --linear-gradient-about-blue-bg-color:linear-gradient(40deg,#1A263A 33%,#4A8394 84%);
  --linear-gradient-career-bg-color:linear-gradient(22.72914987deg,#F5C252 4%,#6AC1D0);
  --background-blue-bg-color: #0284A2;
  --background-red-bg-color:#F44A4A; 
  --background-grey-bg-color:#F7F8FA;
  --background-light-grey-bg-color:#F9F9F9;
  --background-black-bg-color:#29303B;
  --background-white-bg-color:#FFF;
  --background-mehroon-bg-color:#992337;
  --text-black-color:#29303B;
  --text-light-grey-color:#777;
  --text-red-color:#F44A4A;
  --text-dark-grey-color:#686F7A; 
  --text-blue-color:#0284A2;
  --text-dark-blue-color:#003845;
  --text-white-color:#FFF;
}

</style>

<?php endif; ?>

<style>
    #cookieWrapper {
        position: fixed;
        bottom: 0;
        width: 100%;
        z-index: 100;
        margin: 0;
        border-radius: 0;
        background-color: var(--background-blue-bg-color) !important;
    }

    .bg-primary {
	    background-color: var(--background-blue-bg-color) !important;
	}
	.btn-warning {
	    background-color: var(--background-red-bg-color)!important;
	    border: 1px solid var(--background-red-bg-color)!important;
	    color: var(--text-white-color);
	}
    .cookie-consent__message {
        color: var(--text-white-color);
    }
</style>



<div id="cookieWrapper" class="bg-primary text-white w-100 py-3 text-center cookierbar js-cookie-consent cookie-consent">
    <span class="cookie-consent__message">
        <?php echo trans('cookieConsent::texts.message'); ?>&nbsp;&nbsp;
    </span>
    <button class="btn btn-sm btn-warning js-cookie-consent-agree cookie-consent__agree">
        <?php echo e(trans('cookieConsent::texts.agree')); ?>

    </button>
</div>
<?php /**PATH C:\xampp\htdocs\eclass_5.4\resources\views/vendor/cookieConsent/dialogContents.blade.php ENDPATH**/ ?>