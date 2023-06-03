
<?php $__env->startSection('title'); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- breadcumb start -->
<?php
$gets = App\Breadcum::first();
?>
<?php if(isset($gets)): ?>
<section id="business-home" class="business-home-main-block">
    <div class="business-img">
        <?php if($gets['img'] !== NULL && $gets['img'] !== ''): ?>
        <img src="<?php echo e(url('/images/breadcum/'.$gets->img)); ?>" class="img-fluid" alt="" />
        <?php else: ?>
        <img src="<?php echo e(Avatar::create($gets->text)->toBase64()); ?>" alt="course" class="img-fluid">
        <?php endif; ?>
    </div>
    <div class="overlay-bg"></div>
    <div class="container-xl">
        <div class="business-dtl">
            <div class="row">
                <div class="col-lg-6">
                    <div class="bredcrumb-dtl">
                        <h1 class="wishlist-home-heading"><?php echo e(__('My Courses')); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- breadcumb end -->
<!-- instructor profile start -->
<section id="instructor-profile" class="instructor-profile-main-block">
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="instructor-profile-block text-center">
                    <div class="instructor-profile-img">
                        <?php if(isset($instructors['user_img'])): ?>
                        <?php if($instructors['user_img'] !== NULL && $instructors['user_img'] !== ''): ?>
                        <img src="<?php echo e(url('/images/user_img/'.$instructors->user_img)); ?>"  class="img-fluid" />
                        <?php else: ?>
                        <img src="<?php echo e(Avatar::create($instructors->fname)->toBase64()); ?>" alt="<?php echo e(__('course')); ?>"
                            class="img-fluid">
                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="tooltip">
                            <div class="tooltip-icon">
                                <i data-feather="share-2"></i>
                            </div>
                            <span class="tooltiptext">
                                <div class="instructor-home-social-icon">
                                    <ul>
                                        <li><a href="<?php echo e($instructors->fb_url ?? '-'); ?>"><i data-feather="facebook"></i></a></li>
                                        <li><a href="<?php echo e($instructors->twitter_url ?? '-'); ?>"><i data-feather="twitter"></i></a></li>
                                        <li><a href="<?php echo e($instructors->youtube_url ?? '-'); ?>"></a><i data-feather="youtube"></i></a></li>
                                        <li><a href="<?php echo e($instructors->linkedin_url ?? '-'); ?>"><i data-feather="linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </span>
                        </div> 
                    </div>
                    <div class="instructor-profile-dtl">
                        <div class="instructor-content-block">
                            <h5 class="about-content-heading"><?php echo e($instructors->fname ?? '-'); ?> <?php echo e($instructors->lname ?? '-'); ?></h5>
                            <p><?php echo e($instructors->role ?? '-'); ?></p>
                            <div class="instructor-profile-number">
                                <?php echo e($instructors->mobile ?? '-'); ?>

                            </div>
                            <div class="instructor-profile-mail">
                                <?php echo e($instructors->email ?? '-'); ?>

                            </div>
                            <?php if(isset($instructors->id)): ?>
                            <?php

                            $followers = App\Followers::where('user_id', '!=', $instructors->id)->where('follower_id', $instructors->id)->count();
        
                            $followings = App\Followers::where('user_id', $instructors->id)->where('follower_id','!=', $instructors->id)->count();
                            $course = App\Course::where('user_id', $instructors->id)->count();
        
                            ?>
                            <?php endif; ?>
                            <div class="instructor-home-info">
                                <ul>
                                    <li><?php echo e($course ?? ''); ?> <?php echo e(__('Courses')); ?></li>
                                    <li><?php echo e($followers ?? ''); ?> <?php echo e(__('Follower')); ?></li>
                                    <li><?php echo e($followings ?? ''); ?> <?php echo e(__('Following')); ?></li>
                                </ul>
                            </div>
                            <div class="instructor-btn">

                                <?php if(auth()->guard()->check()): ?>

                                <?php

                                $follow = App\Followers::where('follower_id', $user->id)->first();

                                ?>

                                <?php if($follow == NULL): ?>


                                <form id="demo-form2" method="post" action="<?php echo e(route('follow')); ?>"
                                    data-parsley-validate class="form-horizontal form-label-left">
                                        <?php echo e(csrf_field()); ?>


                                    <input type="hidden" name="follower_id"  value="<?php echo e($user->id); ?>" />

                                   
                                     <button type="submit" class="btn btn-primary">&nbsp;Follow</button>
                                </form>
                                

                                <?php else: ?>
                                
                                <form id="demo-form2" method="post" action="<?php echo e(route('unfollow')); ?>"
                                    data-parsley-validate class="form-horizontal form-label-left">
                                        <?php echo e(csrf_field()); ?>


                                    <input type="hidden" name="user_id"value="<?php echo e($user->id); ?>" />
                                    <input type="hidden" name="instructor_id"  value="<?php echo e($user->id); ?>" />

                                    
                                     <button type="submit" class="btn btn-secondary">&nbsp;Unfollow</button>
                                </form>

                                <?php endif; ?>

                                <?php endif; ?>

                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="instructor-profile-tabs">
                    <ul class="nav nav-tabs" id="tabs-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="classes-tab" data-toggle="tab" href="#classes" role="tab" aria-controls="classes" aria-selected="true"><?php echo e(__('Explore Courses')); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="false"><?php echo e(__('About me')); ?></a>
                        </li>
                    </ul>
                    <div class="tab-content" id="nav-tabContent">
                        <?php if(isset($courses)): ?>
                        
                        <div class="tab-pane active show" id="classes" role="tabpanel" aria-labelledby="classes-tab">
                           <div class="about-instructor">
                               <div class="row">
                                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($c->status == 1): ?>
                                    <div class="col-lg-6">
                                        <div class="student-view-block">
                                            <div class="view-block">
                                                <div class="view-img">
                                                    <?php if($c['preview_image'] !== NULL && $c['preview_image'] !== ''): ?>
                                                        <a href="<?php echo e(route('user.course.show',['id' => $c->id, 'slug' => $c->slug ])); ?>"><img src="<?php echo e(asset('images/course/'.$c['preview_image'])); ?>" alt="<?php echo e(__('course')); ?>" class="img-fluid"></a>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(route('user.course.show',['id' => $c->id, 'slug' => $c->slug ])); ?>"><img src="<?php echo e(Avatar::create($c->title)->toBase64()); ?>" alt="<?php echo e(__('course')); ?>" class="img-fluid"></a>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="view-user-img">

                                                    <?php if(optional($c->user)['user_img'] !== NULL && optional($c->user)['user_img'] !== ''): ?>
                                                    <a href="" title=""><img src="<?php echo e(asset('images/user_img/'.$c->user['user_img'])); ?>"
                                                            class="img-fluid user-img-one" alt=""></a>
                                                    <?php else: ?>
                                                    <a href="" title=""><img src="<?php echo e(asset('images/default/user.png')); ?>"
                                                            class="img-fluid user-img-one" alt=""></a>
                                                    <?php endif; ?>
                        
                        
                                                </div>
                                                <div class="view-dtl">
                                                    <div class="view-heading"><a href="<?php echo e(route('user.course.show',['id' => $c->id, 'slug' => $c->slug ])); ?>"><?php echo e(str_limit($c->title, $limit = 30, $end = '...')); ?></a></div>
                                                    <div class="user-name">
                                                        <h6>By <span><?php echo e(optional($c->user)['fname']); ?></span></h6>
                                                    </div>                                           
                                                    <div class="rating">
                                                        <ul>
                                                            <li>
                                                                <?php 
                                                                $learn = 0;
                                                                $price = 0;
                                                                $value = 0;
                                                                $sub_total = 0;
                                                                $sub_total = 0;
                                                                $reviews = App\ReviewRating::where('course_id',$c->id)->get();
                                                                ?> 
                                                                <?php if(!empty($reviews[0])): ?>
                                                                <?php
                                                                $count =  App\ReviewRating::where('course_id',$c->id)->count();

                                                                foreach($reviews as $review){
                                                                    $learn = $review->price*5;
                                                                    $price = $review->price*5;
                                                                    $value = $review->value*5;
                                                                    $sub_total = $sub_total + $learn + $price + $value;
                                                                }

                                                                $count = ($count*3) * 5;
                                                                $rat = $sub_total/$count;
                                                                $ratings_var = ($rat*100)/5;
                                                                ?>
                                                
                                                                <div class="pull-left">
                                                                    <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var; ?>%" class="star-ratings-sprite-rating"></span>
                                                                    </div>
                                                                </div>
                                                            
                                                                
                                                                <?php else: ?>
                                                                    <div class="pull-left"><?php echo e(__('No Rating')); ?></div>
                                                                <?php endif; ?>
                                                            </li>
                                                            <!-- overall rating-->
                                                            <?php 
                                                            $learn = 0;
                                                            $price = 0;
                                                            $value = 0;
                                                            $sub_total = 0;
                                                            $count =  count($reviews);
                                                            $onlyrev = array();

                                                            $reviewcount = App\ReviewRating::where('course_id', $c->id)->WhereNotNull('review')->get();

                                                            foreach($reviews as $review){

                                                                $learn = $review->learn*5;
                                                                $price = $review->price*5;
                                                                $value = $review->value*5;
                                                                $sub_total = $sub_total + $learn + $price + $value;
                                                            }

                                                            $count = ($count*3) * 5;
                                                            
                                                            if($count != "" && $count != '0')
                                                            {
                                                                $rat = $sub_total/$count;
                                                        
                                                                $ratings_var = ($rat*100)/5;
                                                        
                                                                $overallrating = ($ratings_var/2)/10;
                                                            }
                                                            
                                                            ?>

                                                            <?php
                                                                $reviewsrating = App\ReviewRating::where('course_id', $c->id)->first();
                                                            ?>
                                                            <li class="reviews">
                                                                (<?php
                                                                $data = App\ReviewRating::where('course_id', $c->id)->count();
                                                                if($data>0){
                        
                                                                echo $data;
                                                                }
                                                                else{
                        
                                                                echo "0";
                                                                }
                                                                ?> Reviews)
                                                            </li>
                                                        </ul>
                                                    </div>
                                                        <div class="view-footer">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                    <div class="count-user">
                                                                        <i data-feather="user"></i><span>1</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                    <?php if( $c->type == 1): ?>
                                                                    <div class="rate text-right">
                                                                        <ul>
                                                                            <?php
                                                                                $currency = App\Currency::first();
                                                                                $string =  currency($c->price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = true) ;

                                                                            ?>
                                                                              <?php if($c->discount_price == !NULL): ?>
                                                       
                                                                              <li><a><b><?php echo e(activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :''); ?><?php echo e(price_format( currency($c['discount_price'], $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false))); ?><?php echo e(activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :''); ?></b></a></li>
                      
                                                                              <li><a><b><strike><?php echo e(activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :''); ?><?php echo e(price_format(  currency($c['price'], $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false))); ?><?php echo e(activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :''); ?></strike></b></a></li>
                                                                             
                                                                              
                                                                          <?php else: ?>
                      
                                                                              <?php if($c->price == !NULL): ?> 
                                                                              <li><a><b><?php echo e(activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :''); ?><?php echo e(price_format(  currency($c['price'], $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false))); ?><?php echo e(activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :''); ?></b></a></li>
                                                                              <?php endif; ?>
                                                                            
                                                                          <?php endif; ?>
                                                                            
                                                                        </ul>
                                                                    </div>
                                                                    <?php else: ?>
                                                                    <div class="rate text-right">
                                                                        <ul>
                                                                            <li><a><b><?php echo e(__('Free')); ?></b></a></li>
                                                                        </ul>
                                                                    </div>
                                                                <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               </div>
                            </div>
                            <div><?php echo e($courses->links()); ?></div>
                        </div>
                        <?php endif; ?>
                        <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
                           <?php echo e($instructors['detail'] ?? ''); ?>

                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- instructor profile end -->
<section id="instructor-info" class="instructor-info-main-block">
    <div class="container-xl">
        
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('theme.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\eclass_5.4\resources\views/front/instructor/profile.blade.php ENDPATH**/ ?>