<div class="row no-gutters">
    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($c->status == 1): ?>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="item immi-slider-block development">
                <div class="genre-slide-image <?php if($gsetting['course_hover'] == 1): ?> protip <?php endif; ?>" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block<?php echo e($c->id); ?>">
                    <div class="view-block">
                        <div class="view-img">
                            <?php if($c['preview_image'] !== NULL && $c['preview_image'] !== ''): ?>
                                <a href="<?php echo e(route('user.course.show',['id' => $c->id, 'slug' => $c->slug ])); ?>"><img src="<?php echo e(asset('images/course/'.$c['preview_image'])); ?>" alt="course" class="img-fluid" >
                                </a>
                            <?php else: ?>
                                <a href="<?php echo e(route('user.course.show',['id' => $c->id, 'slug' => $c->slug ])); ?>"><img src="<?php echo e(Avatar::create($c->title)->toBase64()); ?>" alt="course"class="img-fluid">
                                </a>
                            <?php endif; ?>
                        </div>
                        <?php if($c['level_tags'] == 'trending'): ?>
                        <div class="advance-badge">
                            <span class="badge bg-warning"><?php echo e(__('Trending')); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($c['level_tags'] == 'featured'): ?>

                        <div class="advance-badge">
                            <span class="badge bg-danger"><?php echo e(__('Featured')); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($c['level_tags'] == 'new'): ?>

                        <div class="advance-badge">
                            <span class="badge bg-success"><?php echo e(__('New')); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($c['level_tags'] == 'onsale'): ?>

                        <div class="advance-badge">
                            <span class="badge bg-info"><?php echo e(__('On-sale')); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($c['level_tags'] == 'bestseller'): ?>

                        <div class="advance-badge">
                            <span class="badge bg-success"><?php echo e(__('Bestseller')); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($c['level_tags'] == 'beginner'): ?>

                        <div class="advance-badge">
                            <span class="badge bg-primary"><?php echo e(__('Beginner')); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($c['level_tags'] == 'intermediate'): ?>

                        <div class="advance-badge">
                            <span class="badge bg-secondary"><?php echo e(__('Intermediate')); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="view-user-img">
                            <?php if($c->user['user_img'] !== NULL && $c->user['user_img'] !== ''): ?>
                            <a href="<?php echo e(route('all/profile',$c->user->id)); ?>" title=""><img src="<?php echo e(asset('images/user_img/'.$c->user['user_img'])); ?>" class="img-fluid user-img-one" alt=""></a>
                            <?php else: ?>
                            <a href="<?php echo e(route('all/profile',$c->user->id)); ?>" title=""><img src="<?php echo e(asset('images/default/user.png')); ?>" class="img-fluid user-img-one" alt=""></a>
                            <?php endif; ?>
                         
                        </div>
                        <div class="view-dtl">
                            <div class="view-heading"><a href="<?php echo e(route('user.course.show',['id' => $c->id, 'slug' => $c->slug ])); ?>"><?php echo e(str_limit($c['title'], $limit = 35, $end = '...')); ?></a></div>
                            <div class="user-name">
                                <h6>By <span><a href="<?php echo e(route('all/profile',$c->user->id)); ?>"> <?php echo e(optional($c->user)['fname']); ?></a></span></h6>
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
                                     
                                    if($count != "" && $count > 0)
                                    {
                                        $rat = $sub_total/$count;
                                 
                                        $ratings_var = ($rat*100)/5;
                               
                                        $overallrating = ($ratings_var/2)/10;
                                    }
                                     
                                    ?>

                                    <?php
                                        $reviewsrating = App\ReviewRating::where('course_id', $c->id)->first();
                                    ?>
                                    <?php if(!empty($reviewsrating)): ?>
                                    <!-- <li>
                                        <b><?php echo e(round($overallrating, 1)); ?></b>
                                    </li> -->
                                    <?php endif; ?>
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
                                            <i data-feather="user"></i><span>
                                                <?php
                                                    $data = App\Order::where('course_id', $c->id)->count();
                                                    if(($data)>0){

                                                        echo $data;
                                                    }
                                                    else{

                                                        echo "0";
                                                    }
                                                ?></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6"> 
                                         <?php if( $c->type == 1): ?>
                                            <div class="rate text-right">
                                                <ul>
                                                    

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

               
                <div id="prime-next-item-description-block<?php echo e($c->id); ?>" class="prime-description-block">
                    <div class="prime-description-under-block">
                        <div class="prime-description-under-block">

                            

                            <h5 class="description-heading"><?php echo e($c['title']); ?></h5>
                           
                            <div class="main-des">
                                <p>Last Updated: <?php echo e(date('jS F Y', strtotime($c->updated_at))); ?></p>
                            </div>
                           

                            <ul class="description-list">
                                <li>
                                    <i data-feather="play-circle"></i>
                                    <div class="class-des"> 
                                        <?php echo e(__('Classes')); ?>: 
                                        <?php
                                            $data = App\CourseClass::where('course_id', $c->id)->count();
                                            if($data>0){

                                                echo $data;
                                            }
                                            else{

                                                echo "0";
                                            }
                                        ?>
                                    </div>
                                </li>
                                &nbsp;
                                <li>
                                    <div>
                                        <div class="time-des">
                                            <span class="">
                                                <i data-feather="clock"></i>
                                                <?php

                                                $classtwo =  App\CourseClass::where('course_id', $c->id)->sum("duration");

                                                ?>
                                                <?php echo e($classtwo); ?> Minutes 
                                            </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="lang-des">
                                        <?php if($c['language_id'] == !NULL): ?>
                                            <?php if(isset($c->language)): ?>
                                                <i data-feather="globe"></i> <?php echo e($c->language['name']); ?>

                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </li>
                            </ul>

                            <div class="product-main-des">
                                <p><?php echo e($c->short_detail); ?></p>
                            </div>
                            <div>
                                <?php if($c->whatlearns->isNotEmpty()): ?>
                                    <?php $__currentLoopData = $c->whatlearns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($wl->status ==1): ?>
                                        <div class="product-learn-dtl">
                                            <ul>
                                                <li><i data-feather="check-circle"></i><?php echo e(str_limit($wl['detail'], $limit = 120, $end = '...')); ?></li>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                            <div class="des-btn-block">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <?php if($c->type == 1): ?>
                                            <?php if(Auth::check()): ?>
                                                <?php if(Auth::User()->role == "admin"): ?>
                                                    <div class="protip-btn">
                                                        <a href="<?php echo e(route('course.content',['id' => $c->id, 'slug' => $c->slug ])); ?>" class="btn btn-secondary" title="course">Go To Course</a>
                                                    </div>
                                                <?php else: ?>
                                                    <?php
                                                        $order = App\Order::where('user_id', Auth::User()->id)->where('course_id', $c->id)->first();
                                                    ?>
                                                    <?php if(!empty($order) && $order->status == 1): ?>
                                                        <div class="protip-btn">
                                                            <a href="<?php echo e(route('course.content',['id' => $c->id, 'slug' => $c->slug ])); ?>" class="btn btn-secondary" title="course"><?php echo e(__('Go To Course')); ?></a>
                                                        </div>
                                                    <?php else: ?>
                                                        <?php
                                                            $cart = App\Cart::where('user_id', Auth::User()->id)->where('course_id', $c->id)->first();
                                                        ?>
                                                        <?php if(!empty($cart)): ?>
                                                            <div class="protip-btn">
                                                                <form id="demo-form2" method="post" action="<?php echo e(route('remove.item.cart',$cart->id)); ?>">
                                                                        <?php echo e(csrf_field()); ?>

                                                                            
                                                                    <div class="box-footer">
                                                                     <button type="submit" class="btn btn-primary"><?php echo e(__('Remove From Cart')); ?></button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="protip-btn">
                                                                <form id="demo-form2" method="post" action="<?php echo e(route('addtocart',['course_id' => $c->id, 'price' => $c->price, 'discount_price' => $c->discount_price ])); ?>"
                                                                    data-parsley-validate class="form-horizontal form-label-left">
                                                                        <?php echo e(csrf_field()); ?>


                                                                    <input type="hidden" name="category_id"  value="<?php echo e($c->category->id); ?>" />
                                                                            
                                                                    <div class="box-footer">
                                                                     <button type="submit" class="btn btn-primary"><?php echo e(__('Add To Cart')); ?></button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <div class="protip-btn">
                                                    

                                                    <?php if($gsetting->guest_enable == 1): ?>
                                                    <form id="demo-form2" method="post" action="<?php echo e(route('guest.addtocart', $c->id)); ?>"
                                                        data-parsley-validate class="form-horizontal form-label-left">
                                                            <?php echo e(csrf_field()); ?>



                                                        <div class="box-footer">
                                                         <button type="submit" class="btn btn-primary shopping-cart"><i data-feather="shopping-cart"></i>&nbsp;<?php echo e(__('Add To Cart')); ?></button>
                                                        </div>
                                                    </form>

                                                    <?php else: ?>

                                                    <a href="<?php echo e(route('login')); ?>" class="btn btn-primary shopping-cart"><i data-feather="shopping-cart"></i>&nbsp;<?php echo e(__('Add To Cart')); ?></a>

                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php else: ?>
                                             <?php if(Auth::check()): ?>
                                                <?php if(Auth::User()->role == "admin"): ?>
                                                    <div class="protip-btn">
                                                        <a href="<?php echo e(route('course.content',['id' => $c->id, 'slug' => $c->slug ])); ?>" class="btn btn-secondary" title="course"><?php echo e(__('Go To Course')); ?></a>
                                                    </div>
                                                <?php else: ?>
                                                    <?php
                                                        $enroll = App\Order::where('user_id', Auth::User()->id)->where('course_id', $c->id)->first();
                                                    ?>
                                                    <?php if($enroll == NULL): ?>
                                                        <div class="protip-btn">
                                                            <a href="<?php echo e(url('enroll/show',$c->id)); ?>" class="btn btn-primary" title="Enroll Now"><?php echo e(__('Enroll Now')); ?></a>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="protip-btn">
                                                            <a href="<?php echo e(route('course.content',['id' => $c->id, 'slug' => $c->slug ])); ?>" class="btn btn-secondary" title="Cart"><?php echo e(__('Go To Course')); ?></a>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <div class="protip-btn">
                                                    <a href="<?php echo e(route('login')); ?>" class="btn btn-primary" title="Enroll Now"><?php echo e(__('Enroll Now')); ?></a>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="img-wishlist">
                                            <div class="protip-wishlist">
                                                <ul>
                                                    <?php if(Auth::check()): ?>
                                                        
                                                        <?php
                                                            $wish = App\Wishlist::where('user_id', Auth::User()->id)->where('course_id', $c->id)->first();
                                                        ?>
                                                        <?php if($wish == NULL): ?>
                                                            <li class="protip-wish-btn">
                                                                <form id="demo-form2" method="post" action="<?php echo e(url('show/wishlist', $c->id)); ?>" data-parsley-validate 
                                                                    class="form-horizontal form-label-left">
                                                                    <?php echo e(csrf_field()); ?>


                                                                    <input type="hidden" name="user_id"  value="<?php echo e(Auth::User()->id); ?>" />
                                                                    <input type="hidden" name="course_id"  value="<?php echo e($c->id); ?>" />

                                                                    <button class="wishlisht-btn" title="Add to wishlist" type="submit"><i data-feather="heart"></i></button>
                                                                </form>
                                                            </li>
                                                        <?php else: ?>
                                                            <li class="protip-wish-btn-two">
                                                                <form id="demo-form2" method="post" action="<?php echo e(url('remove/wishlist', $c->id)); ?>" data-parsley-validate 
                                                                    class="form-horizontal form-label-left">
                                                                    <?php echo e(csrf_field()); ?>


                                                                    <input type="hidden" name="user_id"  value="<?php echo e(Auth::User()->id); ?>" />
                                                                    <input type="hidden" name="course_id"  value="<?php echo e($c->id); ?>" />

                                                                    <button class="wishlisht-btn heart-fill" title="Remove from Wishlist" type="submit"><i data-feather="heart"></i></button>
                                                                </form>
                                                            </li>
                                                        <?php endif; ?> 
                                                    <?php else: ?>
                                                        <li class="protip-wish-btn"><a href="<?php echo e(route('login')); ?>" title="heart"><i data-feather="heart"></i></a></li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="img-wishlist">
                <div class="protip-wishlist">
                    <ul>

                        <li class="protip-wish-btn"><a href="https://calendar.google.com/calendar/r/eventedit?text=<?php echo e($c['title']); ?>" target="__blank" title="reminder"><i data-feather="bell"></i></a></li>

                        <?php if(Auth::check()): ?>

                            <li class="protip-wish-btn"><a class="compare" data-id="<?php echo e(filter_var($c->id)); ?>" title="compare"><i data-feather="bar-chart"></i></a></li>
                            

                            <?php
                                $wish = App\Wishlist::where('user_id', Auth::User()->id)->where('course_id', $c->id)->first();
                            ?>
                            <?php if($wish == NULL): ?>

                                

                                <li class="protip-wish-btn">
                                    <form id="demo-form2" method="post" action="<?php echo e(url('show/wishlist', $c->id)); ?>" data-parsley-validate
                                        class="form-horizontal form-label-left">
                                        <?php echo e(csrf_field()); ?>

                                        <input type="hidden" name="user_id"  value="<?php echo e(Auth::User()->id); ?>" />
                                        <input type="hidden" name="course_id"  value="<?php echo e($c->id); ?>" />
                                        <button class="wishlisht-btn" title="Add to wishlist" type="submit"><i data-feather="heart"></i></button>
                                    </form>
                                </li>
                            <?php else: ?>
                                <li class="protip-wish-btn-two">
                                    <form id="demo-form2" method="post" action="<?php echo e(url('remove/wishlist', $c->id)); ?>" data-parsley-validate
                                        class="form-horizontal form-label-left">
                                        <?php echo e(csrf_field()); ?>

                                        <input type="hidden" name="user_id"  value="<?php echo e(Auth::User()->id); ?>" />
                                        <input type="hidden" name="course_id"  value="<?php echo e($c->id); ?>" />
                                        <button class="wishlisht-btn heart-fill" title="Remove from Wishlist" type="submit"><i data-feather="heart"></i></button>
                                    </form>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li class="protip-wish-btn"><a href="<?php echo e(route('login')); ?>" title="heart"><i data-feather="heart"></i></a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            </div>
        </div>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
  feather.replace()
</script><?php /**PATH C:\laragon\www\eclass_5.4\resources\views/tabs.blade.php ENDPATH**/ ?>