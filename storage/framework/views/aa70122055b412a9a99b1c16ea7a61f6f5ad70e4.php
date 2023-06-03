<?php $__env->startSection('title', 'Sign Up'); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Signup start-->
<section id="signup" class="signup-block-main-block register-page">
    <div class="container">
        <div class="login-signup">
            <div class="row no-gutters">
                <div class="col-lg-6 col-md-6">
                    <div class="signup-side-block">
                        <img src="<?php echo e(url('images/login/login.png')); ?>" class="img-fluid" alt="">
                        <div class="login-img">
                            <img src="<?php echo e(url('/images/login/'.$gsetting->img)); ?>" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="signup-heading">
                        
                        <?php echo e($gsetting->text); ?>


                        <div class="signup-block">
                            <form class="signup-form" method="POST" action="<?php echo e(route('register')); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <i data-feather="user"></i>
                                            <input type="text" class="form-control<?php echo e($errors->has('fname') ? ' is-invalid' : ''); ?>" name="fname" value="<?php echo e(old('fname')); ?>" id="fname" placeholder="First Name">
                                            <?php if($errors->has('fname')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('fname')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <i data-feather="user"></i>
                                            <input type="text" class="form-control<?php echo e($errors->has('lname') ? ' is-invalid' : ''); ?>" name="lname" value="<?php echo e(old('lname')); ?>" id="lname" placeholder="Last Name">
                                            <?php if($errors->has('lname')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('lname')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <i data-feather="mail"></i>
                                            <input type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" id="email" placeholder="Email">
                                            <?php if($errors->has('email')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <?php if($gsetting->mobile_enable == 1): ?>
                                        <div class="form-group">
                                            <i data-feather="phone"></i>
                                            <input type="text" class="form-control<?php echo e($errors->has('mobile') ? ' is-invalid' : ''); ?>" name="mobile" value="<?php echo e(old('mobile')); ?>" id="mobile" placeholder="Mobile">
                                            <?php if($errors->has('mobile')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('mobile')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <i data-feather="lock"></i>
                                            <input type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" id="password" placeholder="Password">
                                            <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            <?php if($errors->has('password')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('password')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <i data-feather="lock"></i>
                                            <span toggle="#password-confirm" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                                        </div>
                                    </div>
                                </div>
                                <?php if($gsetting->captcha_enable == 1): ?>
                                <div class="<?php echo e($errors->has('g-recaptcha-response') ? ' has-error' : ''); ?>">
                                    <div class="text-center">
                                        <?php echo app('captcha')->display(); ?>

                                        <?php if($errors->has('g-recaptcha-response')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('g-recaptcha-response')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <?php endif; ?>
                                
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="term" id="term" required>

                                        <label class="form-check-label" for="term">
                                            <div class="signin-link text-center btm-20">
                                                <b><?php echo e(__('I agree to ')); ?><a href="<?php echo e(url('terms_condition')); ?>" title="Policy"><?php echo e(__('Terms&Condition')); ?> </a>, <a href="<?php echo e(url('privacy_policy')); ?>" title="Policy"><?php echo e(__('PrivacyPolicy')); ?>.</a></b>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" title="Sign Up" class="btn btn-primary"><?php echo e(__('Signup')); ?></button> 
                                
                            </form>
                            <div class="social-link btm-10">
                                <h2><span>Or Sign Up Using</span></h2>
                                <div class="row">
                                    <?php if($gsetting->fb_login_enable == 1): ?>
                                    <div class="col-lg-2 col-4">
                                        <a href="<?php echo e(url('/auth/facebook')); ?>" target="_blank" title="facebook" class="social-icon facebook-icon" title="Facebook"><i class="fa fa-facebook"></i></a>
                                    </div>
                                    <?php endif; ?>       
                                    <?php if($gsetting->google_login_enable == 1): ?>
                                    <div class="col-lg-2 col-4">
                                        <div class="google">
                                            <a href="<?php echo e(url('/auth/google')); ?>" target="_blank" title="google" class="social-icon google-icon" title="google"><i class="fab fa-google-plus-g"></i></a>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if($gsetting->amazon_enable == 1): ?>
                                    <div class="col-lg-2 col-4">
                                        <div class="signin-link amazon-button">
                                            <a href="<?php echo e(url('/auth/amazon')); ?>" target="_blank" title="amazon" class="social-icon amazon-icon" title="Amazon"><i class="fab fa-amazon"></i></a>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if($gsetting->linkedin_enable == 1): ?>
                                    <div class="col-lg-2 col-4"> 
                                        <div class="signin-link linkedin-button">
                                            <a href="<?php echo e(url('/auth/linkedin')); ?>" target="_blank" title="linkedin" class="social-icon linkedin-icon" title="Linkedin"><i class="fab fa-linkedin"></i></a>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if($gsetting->twitter_enable == 1): ?>
                                    <div class="col-lg-2 col-4">
                                        <div class="signin-link twitter-button">
                                            <a href="<?php echo e(url('/auth/twitter')); ?>" target="_blank" title="twitter" class="social-icon twitter-icon" title="Twitter"><i class="fab fa-twitter"></i></a>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if($gsetting->gitlab_login_enable == 1): ?>
                                    <div class="col-lg-2 col-4">
                                        <div class="signin-link btm-10">
                                            <a href="<?php echo e(url('/auth/gitlab')); ?>" target="_blank" title="gitlab" class="social-icon gitlab-icon" title="gitlab"><i class="fab fa-gitlab"></i></a>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>  
                            </div>
                            <div class="sign-up text-center"><?php echo e(__('Alreadyhaveanaccount')); ?>?<a href="<?php echo e(route('login')); ?>" title="sign-up"> <?php echo e(__('Login')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Signup end-->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eclass_5.4\resources\views/auth/register.blade.php ENDPATH**/ ?>