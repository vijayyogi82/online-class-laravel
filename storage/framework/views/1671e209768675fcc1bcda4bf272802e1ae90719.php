<?php $__env->startSection('title', 'Online Courses'); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('meta_tags'); ?>
<meta name="title" content="<?php echo e($gsetting['project_title']); ?>">
<meta name="description" content="<?php echo e($gsetting['meta_data_desc']); ?> ">
<meta property="og:title" content="<?php echo e($gsetting['project_title']); ?> ">
<meta property="og:url" content="<?php echo e(url()->full()); ?>">
<meta property="og:description" content="<?php echo e($gsetting['meta_data_desc']); ?>">
<meta property="og:image" content="<?php echo e(asset('images/logo/'.$gsetting['logo'])); ?>">
<meta itemprop="image" content="<?php echo e(asset('images/logo/'.$gsetting['logo'])); ?>">
<meta property="og:type" content="website">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="<?php echo e(asset('images/logo/'.$gsetting['logo'])); ?>">
<meta property="twitter:title" content="<?php echo e($gsetting['project_title']); ?> ">
<meta property="twitter:description" content="<?php echo e($gsetting['meta_data_desc']); ?>">
<meta name="twitter:site" content="<?php echo e(url()->full()); ?>" />
<link rel="canonical" href="<?php echo e(url()->full()); ?>" />
<meta name="robots" content="all">
<meta name="keywords" content="<?php echo e($gsetting->meta_data_keyword); ?>">
<?php $__env->stopSection(); ?>
<!-- categories-tab start-->
<?php if($gsetting->category_enable == 1): ?>
<section id="categories-tab" class="categories-tab-main-block">
    <div class="container-xl">
        <div id="categories-tab-slider" class="categories-tab-block owl-carousel">
            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($cat->status == 1): ?>
            <div class="item categories-tab-dtl">
                <a href="<?php echo e(route('category.page',['id' => $cat->id, 'category' => str_slug(str_replace('-','&',$cat->slug))])); ?>"
                    title="<?php echo e($cat->title); ?>"><i class="fa <?php echo e($cat->icon); ?>"></i><?php echo e($cat->title); ?></a>
            </div>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- categories-tab end-->
<?php if(isset($sliders)): ?>
<?php if($jobsearch->job_enable == 1): ?>
<?php
    $sliders = App\slider::where('status', '1')->where('search_enable','1')->first();
?>
<section class="background-slider-block">
    <div class="lazy item home-slider-img">
        <?php if($sliders->status == 1): ?>
        <div id="home" class="home-main-block"
            style="background-image: url('<?php echo e(asset('images/slider/'.$sliders['image'])); ?>')">
            <div class="container-xl">
                <div class="row">
                    <div class="col-lg-12 <?php echo e($sliders['left'] == 1 ? 'col-md-offset-6 col-sm-offset-6 col-sm-6 col-md-6 text-right' : ''); ?>">
                        <div class="home-dtl">
                            <div class="home-heading"><?php echo e($sliders['heading']); ?></div>
                            <p class="btm-10"><?php echo e($sliders['sub_heading']); ?></p>
                            <p class="btm-20"><?php echo e($sliders['detail']); ?>

                        </div>
                        <?php if($sliders->search_enable == 1): ?>
                        <div class="home-search">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#search-courses" role="tab" aria-controls="pills-home" aria-selected="true">Search Courses</a>
                                </li>
                                <?php if(Module::has('Resume') && Module::find('Resume')->isEnabled()): ?>
                                <li class="nav-item">
                                    <a class="nav-link" id="search-job-tab" data-toggle="pill" href="#search-jobs" role="tab" aria-controls="pills-profile" aria-selected="false">Search Job</a>
                                </li>
                                <?php endif; ?>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="search-courses" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <form method="GET" id="searchform" action="<?php echo e(route('search')); ?>">
                                        <div class="search">
                                            <input type="text" name="searchTerm" class="searchTerm"
                                                placeholder="<?php echo e(__('Search Courses')); ?>">
                                            <button type="submit" class="searchButton"><?php echo e(__('Search')); ?>

                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="search-jobs" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <form action="<?php echo e(route("job.search")); ?>">
                                        <div class="input-group search-icon mt-3 ">
                                            <div class="search">
                                                <!-- search button -->
                                                <input type="search" id="form2" value="<?php echo e(Request::get('search') ?? ''); ?>"  name="search" class="form-control typeahead searchTerm" placeholder="Search Job"  />
                                                <button type="submit" class="search-color searchButton">
                                                    <?php echo e(__('Search')); ?>

                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
</section>
<?php else: ?>
<section id="home-background-slider" class="background-slider-block owl-carousel">
    <div class="lazy item home-slider-img">
        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($slider->status == 1): ?>
        <div id="home" class="home-main-block"
            style="background-image: url('<?php echo e(asset('images/slider/'.$slider['image'])); ?>')">
            <div class="container-xl">
                <div class="row">
                    <div
                        class="col-lg-12 <?php echo e($slider['left'] == 1 ? 'col-md-offset-6 col-sm-offset-6 col-sm-6 col-md-6 text-right' : ''); ?>">
                        <div class="home-dtl">
                            <div class="home-heading"><?php echo e($slider['heading']); ?></div>
                            <p class="btm-10"><?php echo e($slider['sub_heading']); ?></p>
                            <p class="btm-20"><?php echo e($slider['detail']); ?>

                        </div>

                        <?php if($slider->search_enable == 1): ?>
                        <div class="home-search">
                            <form method="GET" id="searchform" action="<?php echo e(route('search')); ?>">
                                <div class="search">
                                    <input type="text" name="searchTerm" class="searchTerm"
                                        placeholder="<?php echo e(__('Search Courses')); ?>">
                                    <button type="submit" class="searchButton"><?php echo e(__('Search')); ?>

                                    </button>
                                </div>
                            </form>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php endif; ?>
<?php endif; ?>
<!-- home end -->
<!-- learning-work start -->
<?php if(isset($facts)): ?>
<section id="learning-work" class="learning-work-main-block">
    <div class="container-xl">
        <div class="row">
            <?php $__currentLoopData = $facts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-4">
                <div class="learning-work-block">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="learning-work-icon">
                                <i class="fa <?php echo e($fact['icon']); ?>"></i>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="learning-work-dtl">
                                <div class="work-heading"><?php echo e($fact['heading']); ?></div>
                                <p><?php echo e($fact['sub_heading']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- learning-work end -->
<!-- fact start -->
<?php if($hsetting->fact_enable == 1 && isset($factsetting)): ?>
<section id="facts" class="fact-main-block">
    <div class="container-xl">
        <div class="row">
            <?php $__currentLoopData = $factsetting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $factset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-md-6 col-12"> 
                <div class="facts-block text-center">
                    <div class="facts-block-one">
                        <div class="facts-block-img">
                            <?php if($factset['image'] !== NULL && $factset['image'] !== ''): ?>
                            <img src="<?php echo e(url('/images/facts/'.$factset->image)); ?>" class="img-fluid" alt="" />
                            <?php else: ?>
                            <img src="<?php echo e(Avatar::create($factset->title)->toBase64()); ?>" alt="course"
                                class="img-fluid">
                            <?php endif; ?>
                            <div class="facts-count"><?php echo e($factset->number); ?></div>
                        </div>                        
                        <h5 class="facts-title"><a href="#" title=""><?php echo e($factset->title); ?></a></h5>
                        <p><?php echo e($factset->description); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- fact end -->
<!-- Advertisement -->
<?php if(isset($advs)): ?>
<?php $__currentLoopData = $advs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($adv->position == 'belowslider'): ?>
<br>
<section id="student" class="student-main-block top-40">
    <div class="container-xl">
        <a href="<?php echo e($adv->url1); ?>" title="<?php echo e(__('Click to visit')); ?>">

        </a>
    </div>
</section>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php if($hsetting->discount_enable   == 1 && isset($discountcourse) && count($discountcourse) >0): ?>
<section id="student" class="student-main-block top-40">
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-7">
                <h4 class="student-heading"><?php echo e(__('Top Discounted Courses')); ?></h4>
            </div>
            <div class="col-lg-6 col-md-6 col-5">
                <div class="view-button txt-rgt">
                    <a href="<?php echo e(url('topdiscounted/view')); ?>" class="btn btn-secondary" title="View More"><?php echo e(__('View More')); ?><i data-feather="chevrons-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div id="discounted-view-slider" class="student-view-slider-main-block owl-carousel">
            <?php $__currentLoopData = $discountcourse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $discount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php if($discount->status == 1 && $discount->featured == 1): ?>
            <div class="item student-view-block student-view-block-1">
                <div class="genre-slide-image <?php if($gsetting['course_hover'] == 1): ?> protip <?php endif; ?>"
                    data-pt-placement="outside" data-pt-interactive="false"
                    data-pt-title="#prime-next-item-description-block<?php echo e($discount->id); ?>">
                    <div class="view-block">
                        <div class="view-img">
                            <?php if($discount['preview_image'] !== NULL && $discount['preview_image'] !== ''): ?>
                            <a href="<?php echo e(route('user.course.show',['id' => $discount->id, 'slug' => $discount->slug ])); ?>"><img
                                    data-src="<?php echo e(asset('images/course/'.$discount['preview_image'])); ?>" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            <?php else: ?>
                            <a href="<?php echo e(route('user.course.show',['id' => $discount->id, 'slug' => $discount->slug ])); ?>"><img
                                    data-src="<?php echo e(Avatar::create($discount->title)->toBase64()); ?>" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            <?php endif; ?>
                        </div>
                        <div class="badges bg-priamry offer-badge"><span>OFF<span><?php echo round((($discount->price - $discount->discount_price) * 100) / $discount->price) . '%'; ?></span></span></div>

                            
                            <?php if($discount['level_tags'] == 'trending'): ?>
                            <div class="advance-badge">
                                <span class="badge bg-warning"><?php echo e(__('Trending')); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if($discount['level_tags'] == 'featured'): ?>
    
                            <div class="advance-badge">
                                <span class="badge bg-danger"><?php echo e(__('Featured')); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if($discount['level_tags'] == 'new'): ?>
    
                            <div class="advance-badge">
                                <span class="badge bg-success"><?php echo e(__('New')); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if($discount['level_tags'] == 'onsale'): ?>
    
                            <div class="advance-badge">
                                <span class="badge bg-info"><?php echo e(__('On-sale')); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if($discount['level_tags'] == 'bestseller'): ?>
    
                            <div class="advance-badge">
                                <span class="badge bg-success"><?php echo e(__('Bestseller')); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if($discount['level_tags'] == 'beginner'): ?>
    
                            <div class="advance-badge">
                                <span class="badge bg-primary"><?php echo e(__('Beginner')); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if($discount['level_tags'] == 'intermediate'): ?>
    
                            <div class="advance-badge">
                                <span class="badge bg-secondary"><?php echo e(__('Intermediate')); ?></span>
                            </div>
                            <?php endif; ?>
                        <div class="view-user-img">

                            <?php if(optional($discount->user)['user_img'] !== NULL && optional($discount->user)['user_img'] !== ''): ?>
                            <a href="<?php echo e(route('all/profile',$discount->user->id)); ?>" title=""><img src="<?php echo e(asset('images/user_img/'.$discount->user['user_img'])); ?>"
                                    class="img-fluid user-img-one" alt=""></a>
                            <?php else: ?>
                            <a href="<?php echo e(route('all/profile',$discount->id)); ?>" title=""><img src="<?php echo e(asset('images/default/user.png')); ?>"
                                    class="img-fluid user-img-one" alt=""></a>
                            <?php endif; ?>
                        </div>
                        <?php if(isset($discount->user->id)): ?>
                        <div class="view-dtl">
                            <div class="view-heading"><a
                                    href="<?php echo e(route('user.course.show',['id' => $discount->id, 'slug' => $discount->slug ])); ?>"><?php echo e(str_limit($discount->title, $limit = 30, $end = '...')); ?></a>
                            </div>
                            <div class="user-name">
                                <h6>By <span><a href="<?php echo e(route('all/profile',$discount->user->id)); ?>"> <?php echo e(optional($discount->user)['fname']); ?></a></span></h6>
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
                                            $reviews = App\ReviewRating::where('course_id',$discount->id)->get();
                                            ?>
                                        <?php if(!empty($reviews[0])): ?>
                                        <?php
                                            $count =  App\ReviewRating::where('course_id',$discount->id)->count();

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
                                            <div class="star-ratings-sprite"><span
                                                    style="width:<?php echo $ratings_var; ?>%"
                                                    class="star-ratings-sprite-rating"></span>
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

                                        $reviewcount = App\ReviewRating::where('course_id', $discount->id)->WhereNotNull('review')->get();
                                        // @dd($count);
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
                                    $reviewsrating = App\ReviewRating::where('course_id', $discount->id)->first();
                                    ?>
                                    <?php if(!empty($reviewsrating)): ?>
                                    <!-- <li>
                                            <b><?php echo e(round($overallrating, 1)); ?></b>
                                        </li> -->
                                    <?php endif; ?>
                                    <li class="reviews">
                                        (<?php
                                        $data = App\ReviewRating::where('course_id', $discount->id)->count();
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
                                                $data = App\Order::where('course_id', $discount->id)->count();
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
                                        <?php if( $discount->type == 1): ?>
                                        <div class="rate text-right">
                                            <ul>

                                                <?php if($discount->discount_price == !NULL): ?>

                                                <li><a><b><?php echo e(activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :''); ?><?php echo e(price_format( currency($discount['discount_price'], $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false))); ?> <?php echo e(activeCurrency()->getData()->position == 'r' ? activeCurrency()->getData()->symbol :''); ?></b></a>
                                                </li>

                                                <li><a><b><strike><?php echo e(activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :''); ?><?php echo e(price_format( currency($discount['price'], $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false) )); ?><?php echo e(activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :''); ?></strike></b></a>
                                                </li>


                                                <?php else: ?>

                                                <?php if($c->price == !NULL): ?>
                                                <li><a><b><?php echo e(activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :''); ?><?php echo e(price_format( currency($discount['price'], $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false) )); ?><?php echo e(activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :''); ?></b></a>
                                                </li>
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



                            <div class="img-wishlist">
                                <div class="protip-wishlist">
                                    <ul>

                                        <li class="protip-wish-btn"><a
                                                href="https://calendar.google.com/calendar/r/eventedit?text=<?php echo e($discount['title']); ?>"
                                                target="__blank" title="reminder"><i data-feather="bell"></i></a></li>

                                        <?php if(Auth::check()): ?>

                                        <li class="protip-wish-btn"><a class="compare" data-id="<?php echo e(filter_var($discount->id)); ?>"
                                                title="compare"><i data-feather="bar-chart"></i></a></li>

                                        <?php
                                        $wish = App\Wishlist::where('user_id', Auth::User()->id)->where('course_id',
                                        $discount->id)->first();
                                        ?>
                                        <?php if($wish == NULL): ?>
                                        <li class="protip-wish-btn">
                                            <form id="demo-form2" method="post"
                                                action="<?php echo e(url('show/wishlist', $discount->id)); ?>" data-parsley-validate
                                                class="form-horizontal form-label-left">
                                                <?php echo e(csrf_field()); ?>


                                                <input type="hidden" name="user_id" value="<?php echo e(Auth::User()->id); ?>" />
                                                <input type="hidden" name="course_id" value="<?php echo e($discount->id); ?>" />

                                                <button class="wishlisht-btn" title="Add to wishlist" type="submit"><i
                                                        data-feather="heart"></i></button>
                                            </form>
                                        </li>
                                        <?php else: ?>
                                        <li class="protip-wish-btn-two">
                                            <form id="demo-form2" method="post"
                                                action="<?php echo e(url('remove/wishlist', $discount->id)); ?>" data-parsley-validate
                                                class="form-horizontal form-label-left">
                                                <?php echo e(csrf_field()); ?>


                                                <input type="hidden" name="user_id" value="<?php echo e(Auth::User()->id); ?>" />
                                                <input type="hidden" name="course_id" value="<?php echo e($discount->id); ?>" />

                                                <button class="wishlisht-btn heart-fill" title="Remove from Wishlist"
                                                    type="submit"><i data-feather="heart"></i></button>
                                            </form>
                                        </li>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <li class="protip-wish-btn"><a href="<?php echo e(route('login')); ?>" title="heart"><i
                                                    data-feather="heart"></i></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>


                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div id="prime-next-item-description-block<?php echo e($discount->id); ?>" class="prime-description-block">
                    <div class="prime-description-under-block">
                        <div class="prime-description-under-block">
                            <h5 class="description-heading"><?php echo e($discount['title']); ?></h5>
                            <div class="main-des">
                                <p>Last Updated: <?php echo e(date('jS F Y', strtotime($discount->updated_at))); ?></p>
                            </div>

                            <ul class="description-list">
                                <li>
                                    <i data-feather="play-circle"></i>
                                    <div class="class-des">
                                        <?php echo e(__('Classes')); ?>:
                                        <?php
                                        $data = App\CourseClass::where('course_id', $discount->id)->count();
                                        if($data > 0){

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

                                                $classtwo = App\CourseClass::where('course_id',
                                                $discount->id)->sum("duration");

                                                ?>
                                                <?php echo e($classtwo); ?> <?php echo e(__('Minutes')); ?>

                                            </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="lang-des">
                                        <?php if($discount['language_id'] == !NULL): ?>
                                        <?php if(isset($c->language)): ?>
                                        <i data-feather="globe"></i> <?php echo e($discount->language['name']); ?>

                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </li>

                            </ul>

                            <div class="product-main-des">
                                <p><?php echo e($discount->short_detail); ?></p>
                            </div>
                            <div>
                                <?php if($discount->whatlearns->isNotEmpty()): ?>
                                <?php $__currentLoopData = $discount->whatlearns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($wl->status ==1): ?>
                                <div class="product-learn-dtl">
                                    <ul>
                                        <li><i
                                                data-feather="check-circle"></i><?php echo e(str_limit($wl['detail'], $limit = 120, $end = '...')); ?>

                                        </li>
                                    </ul>
                                </div>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                            <div class="des-btn-block">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <?php if($discount->type == 1): ?>
                                        <?php if(Auth::check()): ?>
                                        <?php if(Auth::User()->role == "admin"): ?>
                                        <div class="protip-btn">
                                            <a href="<?php echo e(route('course.content',['id' => $discount->id, 'slug' => $discount->slug ])); ?>"
                                                class="btn btn-secondary"
                                                title="course"><?php echo e(__('Go To Course')); ?></a>
                                        </div>
                                        <?php else: ?>
                                        <?php
                                        $order = App\Order::where('user_id', Auth::User()->id)->where('course_id',
                                        $discount->id)->first();
                                        ?>
                                        <?php if(!empty($order) && $order->status == 1): ?>
                                        <div class="protip-btn">
                                            <a href="<?php echo e(route('course.content',['id' => $discount->id, 'slug' => $discount->slug ])); ?>"
                                                class="btn btn-secondary"
                                                title="course"><?php echo e(__('Go To Course')); ?></a>
                                        </div>
                                        <?php else: ?>
                                        <?php
                                        $cart = App\Cart::where('user_id', Auth::User()->id)->where('course_id',
                                        $discount->id)->first();
                                        ?>
                                        <?php if(!empty($cart)): ?>
                                        <div class="protip-btn">
                                            <form id="demo-form2" method="post"
                                                action="<?php echo e(route('remove.item.cart',$cart->id)); ?>">
                                                <?php echo e(csrf_field()); ?>


                                                <div class="box-footer">
                                                    <button type="submit"
                                                        class="btn btn-primary"><?php echo e(__('Remove From Cart')); ?></button>
                                                </div>
                                            </form>
                                        </div>
                                        <?php else: ?>
                                        <div class="protip-btn">
                                            <form id="demo-form2" method="post"
                                                action="<?php echo e(route('addtocart',['course_id' => $discount->id, 'price' => $discount->price, 'discount_price' => $discount->discount_price ])); ?>"
                                                data-parsley-validate class="form-horizontal form-label-left">
                                                <?php echo e(csrf_field()); ?>


                                                <input type="hidden" name="category_id"
                                                    value="<?php echo e($discount->category['id'] ?? '-'); ?>" />

                                                <div class="box-footer">
                                                    <button type="submit"
                                                        class="btn btn-primary"><?php echo e(__('Add To Cart')); ?></button>
                                                </div>
                                            </form>
                                        </div>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <?php if($gsetting->guest_enable == 1): ?>
                                        <form id="demo-form2" method="post"
                                            action="<?php echo e(route('guest.addtocart', $discount->id)); ?>" data-parsley-validate
                                            class="form-horizontal form-label-left">
                                            <?php echo e(csrf_field()); ?>



                                            <div class="box-footer">
                                                <button type="submit" class="btn btn-primary"><i data-feather="shopping-cart"></i>&nbsp;<?php echo e(__('Add To Cart')); ?></button>
                                            </div>
                                        </form>

                                        <?php else: ?>

                                        <div class="protip-btn">
                                            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary"><i data-feather="shopping-cart"></i>&nbsp;<?php echo e(__('Add To Cart')); ?></a>
                                        </div>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <?php if(Auth::check()): ?>
                                        <?php if(Auth::User()->role == "admin"): ?>
                                        <div class="protip-btn">
                                            <a href="<?php echo e(route('course.content',['id' => $discount->id, 'slug' => $discount->slug ])); ?>"
                                                class="btn btn-secondary"
                                                title="course"><?php echo e(__('Go To Course')); ?></a>
                                        </div>
                                        <?php else: ?>
                                        <?php
                                        $enroll = App\Order::where('user_id', Auth::User()->id)->where('course_id',
                                        $discount->id)->first();
                                        ?>
                                        <?php if($enroll == NULL): ?>
                                        <div class="protip-btn">
                                            <a href="<?php echo e(url('enroll/show',$c->id)); ?>" class="btn btn-primary"
                                                title="Enroll Now"><i data-feather="shopping-cart"></i><?php echo e(__('Enroll Now')); ?></a>
                                        </div>
                                        <?php else: ?>
                                        <div class="protip-btn">
                                            <a href="<?php echo e(route('course.content',['id' => $discount->id, 'slug' => $discount->slug ])); ?>"
                                                class="btn btn-secondary"
                                                title="Cart"><?php echo e(__('Go To Course')); ?></a>
                                        </div>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <div class="protip-btn">
                                            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary"
                                                title="Enroll Now"><i data-feather="shopping-cart"></i><?php echo e(__('Enroll Now')); ?></a>
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
                                                    $wish = App\Wishlist::where('user_id',
                                                    Auth::User()->id)->where('course_id', $discount->id)->first();
                                                    ?>
                                                    <?php if($wish == NULL): ?>
                                                    <li class="protip-wish-btn">
                                                        <form id="demo-form2" method="post"
                                                            action="<?php echo e(url('show/wishlist', $discount->id)); ?>"
                                                            data-parsley-validate
                                                            class="form-horizontal form-label-left">
                                                            <?php echo e(csrf_field()); ?>


                                                            <input type="hidden" name="user_id"
                                                                value="<?php echo e(Auth::User()->id); ?>" />
                                                            <input type="hidden" name="course_id" value="<?php echo e($discount->id); ?>" />

                                                            <button class="wishlisht-btn" title="<?php echo e(__('Add to wishlist')); ?>"
                                                                type="submit"><i data-feather="heart"></i></button>
                                                        </form>
                                                    </li>
                                                    <?php else: ?>
                                                    <li class="protip-wish-btn-two">
                                                        <form id="demo-form2" method="post"
                                                            action="<?php echo e(url('remove/wishlist', $discount->id)); ?>"
                                                            data-parsley-validate
                                                            class="form-horizontal form-label-left">
                                                            <?php echo e(csrf_field()); ?>


                                                            <input type="hidden" name="user_id"
                                                                value="<?php echo e(Auth::User()->id); ?>" />
                                                            <input type="hidden" name="course_id" value="<?php echo e($discount->id); ?>" />

                                                            <button class="wishlisht-btn heart-fill" title="<?php echo e(__('Remove from Wishlist')); ?>"
                                                                type="submit"><i data-feather="heart"></i></button>
                                                        </form>
                                                    </li>
                                                    <?php endif; ?>
                                                    <?php else: ?>
                                                    <li class="protip-wish-btn"><a href="<?php echo e(route('login')); ?>"
                                                            title="heart"><i data-feather="heart"></i></a></li>
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
            </div>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </div>
</section>
<?php endif; ?>
<!-- Student start -->
<?php if(Auth::check()): ?>
<?php if($hsetting->recentcourse_enable   == 1 && isset($recent_course_id) && isset($recent_course) && optional($recent_course)->status == 1): ?>
<section id="student" class="student-main-block top-40">
    <div class="container-xl">

        <?php if($total_count >= '0'): ?>
        <h4 class="student-heading"><?php echo e(__('Recently Viewed Courses')); ?></h4>
        <div id="recent-courses-slider" class="student-view-slider-main-block owl-carousel">
            <?php $__currentLoopData = $recent_course_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php

            $recent_course = App\Course::where('id', $view)->with('user')->first();

            ?>
            <?php if(isset($recent_course)): ?>

            <?php if($recent_course->status == 1): ?>
            <div class="item student-view-block student-view-block-1">
                <div class="genre-slide-image">
                    <div class="view-block">
                        <div class="view-img">
                            <?php if($recent_course['preview_image'] !== NULL && $recent_course['preview_image'] !== ''): ?>
                            <a
                                href="<?php echo e(route('user.course.show',['id' => $recent_course->id, 'slug' => $recent_course->slug ])); ?>"><img
                                    data-src="<?php echo e(asset('images/course/'.$recent_course['preview_image'])); ?>"
                                    alt="course" class="img-fluid owl-lazy"></a>
                            <?php else: ?>
                            <a
                                href="<?php echo e(route('user.course.show',['id' => $recent_course->id, 'slug' => $recent_course->slug ])); ?>"><img
                                    data-src="<?php echo e(Avatar::create($recent_course->title)->toBase64()); ?>" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            <?php endif; ?>
                        </div>
                        <?php if($recent_course['level_tags'] == 'trending'): ?>
                        <div class="advance-badge">
                            <span class="badge bg-warning"><?php echo e(__('Trending')); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($recent_course['level_tags'] == 'featured'): ?>

                        <div class="advance-badge">
                            <span class="badge bg-danger"><?php echo e(__('Featured')); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($recent_course['level_tags'] == 'new'): ?>

                        <div class="advance-badge">
                            <span class="badge bg-success"><?php echo e(__('New')); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($recent_course['level_tags'] == 'onsale'): ?>

                        <div class="advance-badge">
                            <span class="badge bg-info"><?php echo e(__('On-sale')); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($recent_course['level_tags'] == 'bestseller'): ?>

                        <div class="advance-badge">
                            <span class="badge bg-success"><?php echo e(__('Bestseller')); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($recent_course['level_tags'] == 'beginner'): ?>

                        <div class="advance-badge">
                            <span class="badge bg-primary"><?php echo e(__('Beginner')); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($recent_course['level_tags'] == 'intermediate'): ?>

                        <div class="advance-badge">
                            <span class="badge bg-secondary"><?php echo e(__('Intermediate')); ?></span>
                        </div>
                        <?php endif; ?>
                       
                        <div class="view-user-img">

                            <?php if($recent_course->user['user_img'] !== NULL && $recent_course->user['user_img'] !== ''): ?>
                            <a href="<?php echo e(route('all/profile',$recent_course->user->id)); ?>" title=""><img
                                    src="<?php echo e(asset('images/user_img/'.$recent_course->user['user_img'])); ?>"
                                    class="img-fluid user-img-one" alt=""></a>
                            <?php else: ?>
                            <a href="<?php echo e(route('all/profile',$recent_course->user->id)); ?>" title=""><img src="<?php echo e(asset('images/default/user.png')); ?>"
                                    class="img-fluid user-img-one" alt=""></a>
                            <?php endif; ?>
                        </div>
                        <div class="view-dtl">
                            <div class="view-heading"><a
                                    href="<?php echo e(route('user.course.show',['id' => $recent_course->id, 'slug' => $recent_course->slug ])); ?>"><?php echo e(str_limit($recent_course->title, $limit = 30, $end = '...')); ?></a>
                            </div>
                            <div class="user-name">
                                <h6>By <span><a href="<?php echo e(route('all/profile',$recent_course->user->id)); ?>"> <?php echo e(optional($recent_course->user)['fname']); ?></a></span></h6>
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
                                            $reviews = App\ReviewRating::where('course_id',$recent_course->id)->get();
                                            ?>
                                        <?php if(!empty($reviews[0])): ?>
                                        <?php
                                            $count =  App\ReviewRating::where('course_id',$recent_course->id)->count();

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
                                            <div class="star-ratings-sprite"><span
                                                    style="width:<?php echo $ratings_var; ?>%"
                                                    class="star-ratings-sprite-rating"></span>
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

                                        $reviewcount = App\ReviewRating::where('course_id', $recent_course->id)->WhereNotNull('review')->get();

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
                                    $reviewsrating = App\ReviewRating::where('course_id', $recent_course->id)->first();
                                    ?>
                                    <!-- <?php if(!empty($reviewsrating)): ?>
                                        <li>
                                            <b><?php echo e(round($overallrating, 1)); ?></b>
                                        </li>
                                        <?php endif; ?> -->

                                    <li class="reviews">
                                        (<?php
                                        $data = App\ReviewRating::where('course_id', $recent_course->id)->count();
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
                                                $data = App\Order::where('course_id', $recent_course->id)->count();
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
                                        <?php if( $recent_course->type == 1): ?>
                                        <div class="rate text-right">
                                            <ul>

                                                <?php if($recent_course->discount_price == !NULL): ?>

                                                <li><a><b>
                                                    <?php echo e(currency($recent_course->discount_price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = true)); ?>

                                                </b></a>
                                                </li>

                                                <li><a><b><strike><?php echo e(currency($recent_course->price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = true)); ?></strike></b></a>
                                                </li>


                                                <?php else: ?>
                                                <li><a><b>
                                                            <?php echo e(currency($recent_course->price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = true)); ?></b></a>
                                                </li>


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
                            <div class="img-wishlist">
                                <div class="protip-wishlist">
                                    <ul>
                                        <?php if(Auth::check()): ?>
                                        <?php
                                        $wish = App\Wishlist::where('user_id', auth()->user()->id)->where('course_id',
                                        $recent_course->id)->first();
                                        ?>
                                        <?php if($wish == NULL): ?>
                                        <li class="protip-wish-btn">
                                            <form id="demo-form2" method="post"
                                                action="<?php echo e(url('show/wishlist', $recent_course->id)); ?>"
                                                data-parsley-validate class="form-horizontal form-label-left">
                                                <?php echo e(csrf_field()); ?>


                                                <input type="hidden" name="user_id" value="<?php echo e(auth()->user()->id); ?>" />
                                                <input type="hidden" name="course_id" value="<?php echo e($recent_course->id); ?>" />

                                                <button class="wishlisht-btn" title="Add to wishlist" type="submit"><i
                                                        data-feather="heart" class="rgt-10"></i></button>
                                            </form>
                                        </li>
                                        <?php else: ?>
                                        <li class="protip-wish-btn-two">
                                            <form id="demo-form2" method="post"
                                                action="<?php echo e(url('remove/wishlist', $recent_course->id)); ?>"
                                                data-parsley-validate class="form-horizontal form-label-left">
                                                <?php echo e(csrf_field()); ?>


                                                <input type="hidden" name="user_id" value="<?php echo e(auth()->user()->id); ?>" />
                                                <input type="hidden" name="course_id" value="<?php echo e($recent_course->id); ?>" />

                                                <button class="wishlisht-btn heart-fill" title="Remove from Wishlist"
                                                    type="submit"><i data-feather="heart" class="rgt-10"></i></button>
                                            </form>
                                        </li>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <li class="protip-wish-btn"><a href="<?php echo e(route('login')); ?>" title="heart"><i
                                                    data-feather="heart" class="rgt-10"></i></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <?php endif; ?>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>

    </div>
</section>
<?php endif; ?>
<?php endif; ?>
<!-- Students end -->
<!-- Student start -->
<?php if(Auth::check()): ?>
<?php
if(Schema::hasColumn('orders', 'refunded')){
$enroll = App\Order::where('refunded', '0')->where('user_id', auth()->user()->id)->where('status',
'1')->with('courses')->with(['user','courses.user'] )->get();
}
else{
$enroll = NULL;
}
?>
<?php if($hsetting->purchase_enable == 1 && isset($enroll)): ?>
<section id="student" class="student-main-block top-40">
    <div class="container-xl">
         <?php if(count($enroll) > 0): ?>
        <h4 class="student-heading"><?php echo e(__('My Purchased Courses')); ?></h4>
        <div id="my-courses-slider" class="student-view-slider-main-block owl-carousel">
            <?php $__currentLoopData = $enroll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(isset($enrol->courses) && $enrol->courses['status'] == 1 ): ?>
            <div class="item student-view-block student-view-block-1">
                <div class="genre-slide-image">
                    <div class="view-block">
                        <div class="view-img">
                            <?php if($enrol->courses['preview_image'] !== NULL && $enrol->courses['preview_image'] !== ''): ?>
                            <a
                                href="<?php echo e(route('course.content',['id' => $enrol->courses->id, 'slug' => $enrol->courses->slug ])); ?>"><img
                                    data-src="<?php echo e(asset('images/course/'.$enrol->courses['preview_image'])); ?>"
                                    alt="course" class="img-fluid owl-lazy"></a>
                            <?php else: ?>
                            <a
                                href="<?php echo e(route('course.content',['id' => $enrol->courses->id, 'slug' => $enrol->courses->slug ])); ?>"><img
                                    data-src="<?php echo e(Avatar::create($enrol->courses->title)->toBase64()); ?>" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            <?php endif; ?>
                        </div>
                        <div class="view-user-img">

                            <?php if($enrol->user['user_img'] !== NULL && $enrol->user['user_img'] !== ''): ?>
                            <a href="<?php echo e(route('all/profile',$enrol->user->id)); ?>" title=""><img src="<?php echo e(asset('images/user_img/'.$enrol->user['user_img'])); ?>"
                                    class="img-fluid user-img-one" alt=""></a>
                            <?php else: ?>
                            <a href="<?php echo e(route('all/profile',$enrol->user->id)); ?>" title=""><img src="<?php echo e(asset('images/default/user.png')); ?>"
                                    class="img-fluid user-img-one" alt=""></a>
                            <?php endif; ?>
                        </div>
                        <div class="view-dtl">
                            <div class="view-heading"><a
                                    href="<?php echo e(route('course.content',['id' => $enrol->courses->id, 'slug' => $enrol->courses->slug ])); ?>"><?php echo e(str_limit($enrol->courses->title, $limit = 30, $end = '...')); ?></a>
                            </div>
                            <div class="user-name">
                                <h6>By <span><a href="<?php echo e(route('all/profile',$enrol->user->id)); ?>"> <?php echo e(optional($enrol->user)['fname']); ?></a></span></h6>
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
                                            $reviews = App\ReviewRating::where('course_id',$enrol->courses->id)->get();
                                            ?>
                                        <?php if(!empty($reviews[0])): ?>
                                        <?php
                                            $count =  App\ReviewRating::where('course_id',$enrol->courses->id)->count();

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
                                            <div class="star-ratings-sprite"><span
                                                    style="width:<?php echo $ratings_var; ?>%"
                                                    class="star-ratings-sprite-rating"></span>
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

                                        $reviewcount = App\ReviewRating::where('course_id', $enrol->courses->id)->WhereNotNull('review')->get();

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
                                    $reviewsrating = App\ReviewRating::where('course_id', $enrol->courses->id)->first();
                                    ?>

                                    <li class="reviews">
                                        (<?php
                                        $data = App\ReviewRating::where('course_id', $enrol->courses->id)->count();
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
                                                $data = App\Order::where('course_id', $enrol->courses->id)->count();
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
                                        <?php if( $enrol->courses->type == 1): ?>
                                        <div class="rate text-right">
                                            <ul>


                                                <?php if($enrol->courses->discount_price == !NULL): ?>

                                                <li><a><b><?php echo e(activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :''); ?> <?php echo e(price_format( currency($enrol->courses->discount_price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false))); ?> <?php echo e(activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :''); ?></b></a>
                                                </li>

                                                <li><a><b><strike><?php echo e(activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :''); ?> <?php echo e(price_format( currency($enrol->courses->price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false))); ?> <?php echo e(activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :''); ?></strike></b></a>
                                                </li>




                                                <?php else: ?>

                                                <li><a><b>
                                                    <?php echo e(activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :''); ?> <?php echo e(price_format( currency($enrol->courses->price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false))); ?> <?php echo e(activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :''); ?></b></a>
                                                </li>

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
        <?php endif; ?>

    </div>
</section>
<?php endif; ?>
<?php endif; ?>
<!-- Students end -->

<!-- learning-courses start -->
<?php if($hsetting->recentcourse_enable  == 1 && isset($categories)): ?>
<section id="learning-courses" class="learning-courses-main-block">
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                <h4 class="student-heading"><?php echo e(__('Recent Courses')); ?></h4>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                <div class="btn_more float-right">

                </div>
            </div>
        </div>

        <div class="row">



            <div class="col-lg-12">
                <div class="learning-courses">
                    <?php if(isset($categories)): ?>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cats): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <li class="btn nav-item"><a class="nav-item nav-link" id="home-tab" data-toggle="tab"
                                href="#content-tabs" role="tab" aria-controls="home"
                                onclick="showtab('<?php echo e($cats->id); ?>')" aria-selected="true"><?php echo e($cats['title']); ?></a></li>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <?php endif; ?>
                </div>
                <div class="tab-content" id="myTabContent">
                    <?php if(!empty($categories)): ?>


                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="tab-pane fade show active" id="content-tabs" role="tabpanel" aria-labelledby="home-tab">

                        <div id="tabShow">

                        </div>

                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- learning-courses end -->
<!-- Advertisement -->
<?php if(isset($advs)): ?>
<?php $__currentLoopData = $advs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($adv->position == 'belowrecent'): ?>
<br>
<section id="student" class="student-main-block btm-40">
    <div class="container-xl">
        <a href="<?php echo e($adv->url1); ?>" title="<?php echo e(__('Click to visit')); ?>">
            <img class="lazy img-fluid advertisement-img-one" data-src="<?php echo e(url('images/advertisement/'.$adv->image1)); ?>"
                alt="<?php echo e($adv->image1); ?>">
        </a>
    </div>
</section>
<?php endif; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endif; ?>
<!-- Advertisement -->
<!-- Student start -->

<?php if( !$cors->isEmpty() && $hsetting->featured_enable): ?>
<section id="student" class="student-main-block">
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-7">
                <h4 class="student-heading"><?php echo e(__('Featured Courses')); ?></h4>
            </div>
            <div class="col-lg-6 col-md-6 col-5">
                <div class="view-button txt-rgt">
                    <a href="<?php echo e(url('featuredcourse/view')); ?>" class="btn btn-secondary" title="View More"><?php echo e(__('View More')); ?><i data-feather="chevrons-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div id="student-view-slider" class="student-view-slider-main-block owl-carousel">
            <?php $__currentLoopData = $cors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php if($c->status == 1 && $c->featured == 1): ?>   
            <div class="item student-view-block student-view-block-1">
                <div class="genre-slide-image <?php if($gsetting['course_hover'] == 1): ?> protip <?php endif; ?>"
                    data-pt-placement="outside" data-pt-interactive="false"
                    data-pt-title="#prime-next-item-description-block<?php echo e($c->id); ?>">
                    <div class="view-block">
                        <div class="view-img">
                            <?php if($c['preview_image'] !== NULL && $c['preview_image'] !== ''): ?>
                            <a href="<?php echo e(route('user.course.show',['id' => $c->id, 'slug' => $c->slug ])); ?>"><img
                                    data-src="<?php echo e(asset('images/course/'.$c['preview_image'])); ?>" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            <?php else: ?>
                            <a href="<?php echo e(route('user.course.show',['id' => $c->id, 'slug' => $c->slug ])); ?>"><img
                                    data-src="<?php echo e(Avatar::create($c->title)->toBase64()); ?>" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            <?php endif; ?>
                        </div>
                        <?php if(isset($c->discount_price)): ?>
                        <div class="badges bg-priamry offer-badge"><span>OFF<span><?php echo round((($c->price - $c->discount_price) * 100) / $c->price) . '%'; ?></span></span></div>
                        <?php endif; ?>
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
                            <span class="badge bg-info"><?php echo e(__('Onsale')); ?></span>
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

                            <?php if(optional($c->user)['user_img'] !== NULL && optional($c->user)['user_img'] !== ''): ?>
                            <a href="<?php echo e(route('all/profile',$c->user->id)); ?>" title=""><img src="<?php echo e(asset('images/user_img/'.$c->user['user_img'])); ?>"
                                    class="img-fluid user-img-one" alt=""></a>
                            <?php else: ?>
                            <a href="<?php echo e(route('all/profile',$c->user->id)); ?>" title=""><img src="<?php echo e(asset('images/default/user.png')); ?>"
                                    class="img-fluid user-img-one" alt=""></a>
                            <?php endif; ?>


                        </div>

                        <div class="view-dtl">
                            <div class="view-heading"><a
                                    href="<?php echo e(route('user.course.show',['id' => $c->id, 'slug' => $c->slug ])); ?>"><?php echo e(str_limit($c->title, $limit = 30, $end = '...')); ?></a>
                            </div>
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
                                            <div class="star-ratings-sprite"><span
                                                    style="width:<?php echo $ratings_var; ?>%"
                                                    class="star-ratings-sprite-rating"></span>
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

                                                <li><a><b><?php echo e(activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :''); ?><?php echo e(price_format( currency($c['discount_price'], $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false))); ?><?php echo e(activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :''); ?></b></a>
                                                </li>

                                                <li><a><b><strike><?php echo e(activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :''); ?><?php echo e(price_format( currency($c['price'], $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false) )); ?><?php echo e(activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :''); ?></strike></b></a>
                                                </li>


                                                <?php else: ?>

                                                <?php if($c->price == !NULL): ?>
                                                <li><a><b><?php echo e(activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :''); ?><?php echo e(price_format( currency($c['price'], $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false) )); ?><?php echo e(activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :''); ?></b></a>
                                                </li>
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



                            <div class="img-wishlist">
                                <div class="protip-wishlist">
                                    <ul>

                                        <li class="protip-wish-btn"><a
                                                href="https://calendar.google.com/calendar/r/eventedit?text=<?php echo e($c['title']); ?>"
                                                target="__blank" title="reminder"><i data-feather="bell"></i></a></li>

                                        <?php if(Auth::check()): ?>

                                        <li class="protip-wish-btn"><a class="compare" data-id="<?php echo e(filter_var($c->id)); ?>"
                                                title="compare"><i data-feather="bar-chart"></i></a></li>

                                        <?php
                                        $wish = App\Wishlist::where('user_id', Auth::User()->id)->where('course_id',
                                        $c->id)->first();
                                        ?>
                                        <?php if($wish == NULL): ?>
                                        <li class="protip-wish-btn">
                                            <form id="demo-form2" method="post"
                                                action="<?php echo e(url('show/wishlist', $c->id)); ?>" data-parsley-validate
                                                class="form-horizontal form-label-left">
                                                <?php echo e(csrf_field()); ?>


                                                <input type="hidden" name="user_id" value="<?php echo e(Auth::User()->id); ?>" />
                                                <input type="hidden" name="course_id" value="<?php echo e($c->id); ?>" />

                                                <button class="wishlisht-btn" title="Add to wishlist" type="submit"><i
                                                        data-feather="heart"></i></button>
                                            </form>
                                        </li>
                                        <?php else: ?>
                                        <li class="protip-wish-btn-two">
                                            <form id="demo-form2" method="post"
                                                action="<?php echo e(url('remove/wishlist', $c->id)); ?>" data-parsley-validate
                                                class="form-horizontal form-label-left">
                                                <?php echo e(csrf_field()); ?>


                                                <input type="hidden" name="user_id" value="<?php echo e(Auth::User()->id); ?>" />
                                                <input type="hidden" name="course_id" value="<?php echo e($c->id); ?>" />

                                                <button class="wishlisht-btn heart-fill" title="Remove from Wishlist"
                                                    type="submit"><i data-feather="heart"></i></button>
                                            </form>
                                        </li>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <li class="protip-wish-btn"><a href="<?php echo e(route('login')); ?>" title="heart"><i
                                                    data-feather="heart"></i></a></li>
                                        <?php endif; ?>
                                    </ul>
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
                                        if($data > 0){

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

                                                $classtwo = App\CourseClass::where('course_id',
                                                $c->id)->sum("duration");

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
                                        <li><i
                                                data-feather="check-circle"></i><?php echo e(str_limit($wl['detail'], $limit = 120, $end = '...')); ?>

                                        </li>
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
                                            <a href="<?php echo e(route('course.content',['id' => $c->id, 'slug' => $c->slug ])); ?>"
                                                class="btn btn-secondary"
                                                title="course"><?php echo e(__('Go To Course')); ?></a>
                                        </div>
                                        <?php else: ?>
                                        <?php
                                        $order = App\Order::where('user_id', Auth::User()->id)->where('course_id',
                                        $c->id)->first();
                                        ?>
                                        <?php if(!empty($order) && $order->status == 1): ?>
                                        <div class="protip-btn">
                                            <a href="<?php echo e(route('course.content',['id' => $c->id, 'slug' => $c->slug ])); ?>"
                                                class="btn btn-secondary"
                                                title="course"><?php echo e(__('Go To Course')); ?></a>
                                        </div>
                                        <?php else: ?>
                                        <?php
                                        $cart = App\Cart::where('user_id', Auth::User()->id)->where('course_id',
                                        $c->id)->first();
                                        ?>
                                        <?php if(!empty($cart)): ?>
                                        <div class="protip-btn">
                                            <form id="demo-form2" method="post"
                                                action="<?php echo e(route('remove.item.cart',$cart->id)); ?>">
                                                <?php echo e(csrf_field()); ?>


                                                <div class="box-footer">
                                                    <button type="submit"
                                                        class="btn btn-primary"><?php echo e(__('Remove From Cart')); ?></button>
                                                </div>
                                            </form>
                                        </div>
                                        <?php else: ?>
                                        <div class="protip-btn">
                                            <form id="demo-form2" method="post"
                                                action="<?php echo e(route('addtocart',['course_id' => $c->id, 'price' => $c->price, 'discount_price' => $c->discount_price ])); ?>"
                                                data-parsley-validate class="form-horizontal form-label-left">
                                                <?php echo e(csrf_field()); ?>


                                                <input type="hidden" name="category_id"
                                                    value="<?php echo e($c->category['id'] ?? '-'); ?>" />

                                                <div class="box-footer">
                                                    <button type="submit"
                                                        class="btn btn-primary"><i data-feather="shopping-cart"></i><?php echo e(__('Add To Cart')); ?></button>
                                                </div>
                                            </form>
                                        </div>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <?php if($gsetting->guest_enable == 1): ?>
                                        <form id="demo-form2" method="post"
                                            action="<?php echo e(route('guest.addtocart', $c->id)); ?>" data-parsley-validate
                                            class="form-horizontal form-label-left">
                                            <?php echo e(csrf_field()); ?>



                                            <div class="box-footer">
                                                <button type="submit" class="btn btn-primary"><i data-feather="shopping-cart"></i>&nbsp;<?php echo e(__('Add To Cart')); ?></button>
                                            </div>
                                        </form>

                                        <?php else: ?>

                                        <div class="protip-btn">
                                            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary"><i data-feather="shopping-cart"></i>&nbsp;<?php echo e(__('Add To Cart')); ?></a>
                                        </div>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <?php if(Auth::check()): ?>
                                        <?php if(Auth::User()->role == "admin"): ?>
                                        <div class="protip-btn">
                                            <a href="<?php echo e(route('course.content',['id' => $c->id, 'slug' => $c->slug ])); ?>"
                                                class="btn btn-secondary"
                                                title="course"><?php echo e(__('Go To Course')); ?></a>
                                        </div>
                                        <?php else: ?>
                                        <?php
                                        $enroll = App\Order::where('user_id', Auth::User()->id)->where('course_id',
                                        $c->id)->first();
                                        ?>
                                        <?php if($enroll == NULL): ?>
                                        <div class="protip-btn">
                                            <a href="<?php echo e(url('enroll/show',$c->id)); ?>" class="btn btn-primary"
                                                title="Enroll Now"><i data-feather="shopping-cart"></i><?php echo e(__('Enroll Now')); ?></a>
                                        </div>
                                        <?php else: ?>
                                        <div class="protip-btn">
                                            <a href="<?php echo e(route('course.content',['id' => $c->id, 'slug' => $c->slug ])); ?>"
                                                class="btn btn-secondary"
                                                title="Cart"><?php echo e(__('Go To Course')); ?></a>
                                        </div>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <div class="protip-btn">
                                            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary"
                                                title="Enroll Now"><i data-feather="shopping-cart"></i><?php echo e(__('Enroll Now')); ?></a>
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
                                                    $wish = App\Wishlist::where('user_id',
                                                    Auth::User()->id)->where('course_id', $c->id)->first();
                                                    ?>
                                                    <?php if($wish == NULL): ?>
                                                    <li class="protip-wish-btn">
                                                        <form id="demo-form2" method="post"
                                                            action="<?php echo e(url('show/wishlist', $c->id)); ?>"
                                                            data-parsley-validate
                                                            class="form-horizontal form-label-left">
                                                            <?php echo e(csrf_field()); ?>


                                                            <input type="hidden" name="user_id"
                                                                value="<?php echo e(Auth::User()->id); ?>" />
                                                            <input type="hidden" name="course_id" value="<?php echo e($c->id); ?>" />

                                                            <button class="wishlisht-btn" title="Add to wishlist"
                                                                type="submit"><i data-feather="heart"></i></button>
                                                        </form>
                                                    </li>
                                                    <?php else: ?>
                                                    <li class="protip-wish-btn-two">
                                                        <form id="demo-form2" method="post"
                                                            action="<?php echo e(url('remove/wishlist', $c->id)); ?>"
                                                            data-parsley-validate
                                                            class="form-horizontal form-label-left">
                                                            <?php echo e(csrf_field()); ?>


                                                            <input type="hidden" name="user_id"
                                                                value="<?php echo e(Auth::User()->id); ?>" />
                                                            <input type="hidden" name="course_id" value="<?php echo e($c->id); ?>" />

                                                            <button class="wishlisht-btn heart-fill" title="Remove from Wishlist"
                                                                type="submit"><i data-feather="heart"></i></button>
                                                        </form>
                                                    </li>
                                                    <?php endif; ?>
                                                    <?php else: ?>
                                                    <li class="protip-wish-btn"><a href="<?php echo e(route('login')); ?>"
                                                            title="heart"><i data-feather="heart"></i></a></li>
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
            </div>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </div>
</section>
<?php endif; ?>
<!-- Students end -->


<!-- Subscription Bundle start -->
<section id="subscription" class="student-main-block">
    <div class="container-xl">
        <?php if(isset($subscriptionBundles) && !$subscriptionBundles->isEmpty()): ?>
        <h4 class="student-heading"><?php echo e(__('Subscription Bundles')); ?></h4>
        <div id="subscription-bundle-view-slider" class="student-view-slider-main-block owl-carousel">
            <?php $__currentLoopData = $subscriptionBundles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bundle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($bundle->status == 1 && $bundle->is_subscription_enabled == 1): ?>

            <div class="item student-view-block student-view-block-1">
                <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-interactive="false"
                    data-pt-title="#prime-next-item-description-block-3<?php echo e($bundle->id); ?>">
                    <div class="view-block">
                        <div class="view-img">
                            <?php if($bundle['preview_image'] !== null && $bundle['preview_image'] !== ''): ?>
                            <a href="<?php echo e(route('bundle.detail', $bundle->id)); ?>"><img
                                    data-src="<?php echo e(asset('images/bundle/' . $bundle['preview_image'])); ?>" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            <?php else: ?>
                            <a href="<?php echo e(route('bundle.detail', $bundle->id)); ?>"><img
                                    data-src="<?php echo e(Avatar::create($bundle->title)->toBase64()); ?>" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            <?php endif; ?>
                        </div>
                        <div class="badges bg-priamry offer-badge"><span>OFF<span><?php echo round((($bundle->price - $bundle->discount_price) * 100) / $bundle->price) . '%'; ?></span></span></div>

                        <div class="view-user-img">

                            <?php if($bundle->user['user_img'] !== NULL && $bundle->user['user_img'] !== ''): ?>
                            <a href="<?php echo e(route('all/profile',$bundle->user->id)); ?>" title=""><img src="<?php echo e(asset('images/user_img/'.$bundle->user['user_img'])); ?>"
                                    class="img-fluid user-img-one" alt=""></a>
                            <?php else: ?>
                            <a href="<?php echo e(route('all/profile',$bundle->user->id)); ?>" title=""><img src="<?php echo e(asset('images/default/user.png')); ?>"
                                    class="img-fluid user-img-one" alt=""></a>
                            <?php endif; ?>
                        </div>
                        <div class="view-dtl">
                            <div class="view-heading"><a
                                    href="<?php echo e(route('bundle.detail', $bundle->id)); ?>"><?php echo e(str_limit($bundle->title, $limit = 30, $end = '...')); ?></a>
                            </div>
                            <div class="user-name">
                                <h6>By <span><a href="<?php echo e(route('all/profile',$bundle->user->id)); ?>"> <?php echo e(optional($bundle->user)['fname']); ?></a></span></h6>
                            </div>
                            <div class="view-footer">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-date">
                                            <a href="#"><i data-feather="calendar"></i> <?php echo e(date('d-m-Y', strtotime($bundle['created_at']))); ?></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <?php if($bundle->type == 1 && $bundle->price != null): ?>
                                        <div class="rate text-right">
                                            <ul>
                                                <?php if($bundle->discount_price == !null): ?>

                                                <li><a><b><?php echo e(activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :''); ?><?php echo e(price_format( currency($bundle->discount_price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false))); ?><?php echo e(activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :''); ?></b></a>
                                                </li>

                                                <li><a><b><strike><?php echo e(activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :''); ?><?php echo e(price_format( currency($bundle->price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false))); ?><?php echo e(activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :''); ?></strike></b></a>
                                                </li>


                                                <?php else: ?>



                                                <li><a><b>
                                                    <?php echo e(activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :''); ?><?php echo e(price_format( currency($bundle->price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false))); ?><?php echo e(activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :''); ?></b></a>
                                                </li>
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
                <div id="prime-next-item-description-block-3<?php echo e($bundle->id); ?>" class="prime-description-block">
                    <div class="prime-description-under-block">
                        <div class="prime-description-under-block">
                            <h5 class="description-heading"><?php echo e($bundle['title']); ?></h5>
                            <div class="main-des">
                                <?php if($bundle['short_detail'] != NUll): ?>

                                <p><?php echo e(str_limit($bundle['short_detail'], $limit = 200, $end = '...')); ?></p>
                                <?php else: ?>
                                <p><?php echo e(str_limit($bundle['detail'], $limit = 200, $end = '...')); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="des-btn-block">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php if($bundle->type == 1): ?>
                                        <?php if(Auth::check()): ?>
                                        <?php if(Auth::User()->role == 'admin'): ?>
                                        <div class="protip-btn">
                                            <a href="" class="btn btn-secondary"
                                                title="course"><?php echo e(__('Purchased')); ?></a>
                                        </div>
                                        <?php else: ?>
                                        <?php
                                        $order = App\Order::where('user_id',
                                        Auth::User()->id)->where('bundle_id',
                                        $bundle->id)->first();
                                        ?>
                                        <?php if(!empty($order) && $order->status == 1): ?>
                                        <div class="protip-btn">
                                            <a href="" class="btn btn-secondary"
                                                title="course"><?php echo e(__('Purchased')); ?></a>
                                        </div>
                                        <?php else: ?>
                                        <?php
                                        $cart = App\Cart::where('user_id',
                                        Auth::User()->id)->where('bundle_id',
                                        $bundle->id)->first();
                                        ?>
                                        <?php if(!empty($cart)): ?>
                                        <div class="protip-btn">
                                            <form id="demo-form2" method="post"
                                                action="<?php echo e(route('remove.item.cart', $cart->id)); ?>">
                                                <?php echo e(csrf_field()); ?>


                                                <div class="box-footer">
                                                    <button type="submit"
                                                        class="btn btn-primary"><?php echo e(__('Remove From Cart')); ?></button>
                                                </div>
                                            </form>
                                        </div>
                                        <?php else: ?>
                                        <div class="protip-btn">
                                            <form id="demo-form2" method="post"
                                                action="<?php echo e(route('bundlecart', $bundle->id)); ?>" data-parsley-validate
                                                class="form-horizontal form-label-left">
                                                <?php echo e(csrf_field()); ?>


                                                <input type="hidden" name="user_id" value="<?php echo e(Auth::User()->id); ?>" />
                                                <input type="hidden" name="bundle_id" value="<?php echo e($bundle->id); ?>" />

                                                <div class="box-footer">
                                                    <button type="submit"
                                                        class="btn btn-primary"><?php echo e(__('Subscribe Now')); ?></button>
                                                </div>


                                            </form>
                                        </div>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <div class="protip-btn">

                                            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary"><i
                                                    class="fa fa-cart-plus"
                                                    aria-hidden="true"></i>&nbsp;<?php echo e(__('Subscribe Now')); ?></a>

                                        </div>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <?php if(Auth::check()): ?>
                                        <?php if(Auth::User()->role == 'admin'): ?>
                                        <div class="protip-btn">
                                            <a href="" class="btn btn-secondary"
                                                title="course"><?php echo e(__('Purchased')); ?></a>
                                        </div>
                                        <?php else: ?>
                                        <?php
                                        $enroll = App\Order::where('user_id',
                                        Auth::User()->id)->where('course_id', $c->id)->first();
                                        ?>
                                        <?php if($enroll == null): ?>
                                        <div class="protip-btn">
                                            <a href="<?php echo e(url('enroll/show', $bundle->id)); ?>" class="btn btn-primary"
                                                title="Enroll Now"><?php echo e(__('Subscribe Now')); ?></a>
                                        </div>
                                        <?php else: ?>
                                        <div class="protip-btn">
                                            <a href="" class="btn btn-secondary"
                                                title="Cart"><?php echo e(__('Purchased')); ?></a>
                                        </div>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <div class="protip-btn">
                                            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary"
                                                title="Enroll Now"><?php echo e(__('Subscribe Now')); ?></a>
                                        </div>
                                        <?php endif; ?>
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
        <?php endif; ?>
    </div>
</section>
<!-- Subscription Bundle end -->

<!-- Bundle start -->
<?php if(!$bundles->isEmpty() && $hsetting->bundle_enable && isset($bundles)): ?>
<section id="bundle-block" class="student-main-block">
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-7">
                <h4 class="student-heading"><?php echo e(__('Bundle Courses')); ?></h4>
            </div>
            <div class="col-lg-6 col-md-6 col-5">
                <div class="view-button txt-rgt">
                    <a href="<?php echo e(url('bundle/view')); ?>" class="btn btn-secondary" title="View More">View More<i data-feather="chevrons-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php if(count($bundles) > 0): ?>

        <div id="bundle-view-slider" class="student-view-slider-main-block owl-carousel">
            <?php $__currentLoopData = $bundles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bundle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($bundle->status == 1): ?>

            <div class="item student-view-block student-view-block-1">
                <div class="genre-slide-image <?php if($gsetting['course_hover'] == 1): ?> protip <?php endif; ?>"
                    data-pt-placement="outside" data-pt-interactive="false"
                    data-pt-title="#prime-next-item-description-block-4<?php echo e($bundle->id); ?>">
                    <div class="view-block">
                        <div class="view-img">
                            <?php if($bundle['preview_image'] !== NULL && $bundle['preview_image'] !== ''): ?>
                            <a href="<?php echo e(route('bundle.detail', $bundle->id)); ?>"><img
                                    data-src="<?php echo e(asset('images/bundle/'.$bundle['preview_image'])); ?>" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            <?php else: ?>
                            <a href="<?php echo e(route('bundle.detail', $bundle->id)); ?>"><img
                                    data-src="<?php echo e(Avatar::create($bundle->title)->toBase64()); ?>" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            <?php endif; ?>
                        </div>
                        <div class="view-user-img">

                            <?php if($bundle->user['user_img'] !== NULL && $bundle->user['user_img'] !== ''): ?>
                            <a href="<?php echo e(route('all/profile',$bundle->user->id)); ?>" title=""><img src="<?php echo e(asset('images/user_img/'.$bundle->user['user_img'])); ?>"
                                    class="img-fluid user-img-one" alt=""></a>
                            <?php else: ?>
                            <a href="<?php echo e(route('all/profile',$bundle->user->id)); ?>" title=""><img src="<?php echo e(asset('images/default/user.png')); ?>"
                                    class="img-fluid user-img-one" alt=""></a>
                            <?php endif; ?>
                        </div>
                        <div class="view-dtl">
                            <div class="view-heading"><a
                                    href="<?php echo e(route('bundle.detail', $bundle->id)); ?>"><?php echo e(str_limit($bundle->title, $limit = 30, $end = '...')); ?></a>
                            </div>
                            <div class="user-name">
                                <h6>By <span><a href="<?php echo e(route('all/profile',$bundle->user->id)); ?>"> <?php echo e(optional($bundle->user)['fname']); ?></a></span></h6>
                            </div>
                            <!-- <p class="btm-10"><a herf="#"><?php echo e(__('by')); ?> <?php if(isset($bundle->user)): ?> <?php echo e($bundle->user['fname']); ?> <?php echo e($bundle->user['lname']); ?> <?php endif; ?></a></p> -->

                            <div class="view-footer">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="count-user">
                                            <i data-feather="user"></i><span>
                                                <?php echo e($bundle->order->count()); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <?php if($bundle->type == 1 && $bundle->price != null): ?>
                                        <div class="rate text-right">
                                            <ul>

                                                <?php if($bundle->discount_price == !NULL): ?>

                                                <li><a><b><?php echo e(activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :''); ?><?php echo e(price_format(  currency($bundle->discount_price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false))); ?><?php echo e(activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :''); ?></b></a>
                                                </li>

                                                <li><a><b><strike><?php echo e(activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :''); ?><?php echo e(price_format( currency($bundle->price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false))); ?><?php echo e(activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :''); ?></strike></b></a>
                                                </li>


                                                <?php else: ?>
                                                <li><a><b>
                                                    <?php echo e(activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :''); ?><?php echo e(price_format(  currency($bundle->price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false))); ?><?php echo e(activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :''); ?></b></a>
                                                </li>
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
                            <div class="img-wishlist">
                                <div class="protip-wishlist">
                                    <ul>

                                        <li class="protip-wish-btn"><a
                                                href="https://calendar.google.com/calendar/r/eventedit?text=<?php echo e($bundle['title']); ?>"
                                                target="__blank" title="reminder"><i data-feather="bell"></i></a></li>

                                        <?php if(Auth::check()): ?>

                                        <li class="protip-wish-btn"><a class="compare" data-id="<?php echo e(filter_var($bundle->id)); ?>"
                                                title="compare"><i data-feather="bar-chart"></i></a></li>

                                        <?php
                                        $wish = App\Wishlist::where('user_id', Auth::User()->id)->where('course_id',
                                        $bundle->id)->first();
                                        ?>
                                        <?php if($wish == NULL): ?>
                                        <li class="protip-wish-btn">
                                            <form id="demo-form2" method="post"
                                                action="<?php echo e(url('show/wishlist', $bundle->id)); ?>" data-parsley-validate
                                                class="form-horizontal form-label-left">
                                                <?php echo e(csrf_field()); ?>


                                                <input type="hidden" name="user_id" value="<?php echo e(Auth::User()->id); ?>" />
                                                <input type="hidden" name="course_id" value="<?php echo e($bundle->id); ?>" />

                                                <button class="wishlisht-btn" title="Add to wishlist" type="submit"><i
                                                        data-feather="heart"></i></button>
                                            </form>
                                        </li>
                                        <?php else: ?>
                                        <li class="protip-wish-btn-two">
                                            <form id="demo-form2" method="post"
                                                action="<?php echo e(url('remove/wishlist', $bundle->id)); ?>" data-parsley-validate
                                                class="form-horizontal form-label-left">
                                                <?php echo e(csrf_field()); ?>


                                                <input type="hidden" name="user_id" value="<?php echo e(Auth::User()->id); ?>" />
                                                <input type="hidden" name="course_id" value="<?php echo e($bundle->id); ?>" />

                                                <button class="wishlisht-btn heart-fill" title="Remove from Wishlist"
                                                    type="submit"><i data-feather="heart"></i></button>
                                            </form>
                                        </li>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <li class="protip-wish-btn"><a href="<?php echo e(route('login')); ?>" title="heart"><i
                                                    data-feather="heart"></i></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div id="prime-next-item-description-block-4<?php echo e($bundle->id); ?>" class="prime-description-block">
                    <div class="prime-description-under-block">
                        <div class="prime-description-under-block">
                            <h5 class="description-heading"><?php echo e($bundle['title']); ?></h5>

                            <div class="product-main-des">
                                <p><?php echo e(strip_tags(str_limit($bundle['detail'], $limit = 200, $end = '...'))); ?></p>
                            </div>
                            <div>
                                <div class="product-learn-dtl">
                                    <ul>

                                        <?php $__currentLoopData = $bundle->course_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bundles): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php
                                        $course = App\Course::where('id', $bundles)->first();
                                        ?>
                                        <?php if(isset($course)): ?>
                                        <li><i data-feather="check-circle"></i>
                                            <a href="#"><?php echo e($course['title']); ?></a>
                                        </li>
                                        <?php endif; ?>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="des-btn-block">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php if($bundle->type == 1): ?>
                                        <?php if(Auth::check()): ?>
                                        <?php if(Auth::User()->role == "admin"): ?>
                                        <div class="protip-btn">
                                            <a href="" class="btn btn-secondary"
                                                title="course"><?php echo e(__('Purchased')); ?></a>
                                        </div>
                                        <?php else: ?>
                                        <?php
                                        $order = App\Order::where('user_id', Auth::User()->id)->where('bundle_id',
                                        $bundle->id)->first();
                                        ?>
                                        <?php if(!empty($order) && $order->status == 1): ?>
                                        <div class="protip-btn">
                                            <a href="" class="btn btn-secondary"
                                                title="course"><?php echo e(__('Purchased')); ?></a>
                                        </div>
                                        <?php else: ?>
                                        <?php
                                        $cart = App\Cart::where('user_id', Auth::User()->id)->where('bundle_id',
                                        $bundle->id)->first();
                                        ?>
                                        <?php if(!empty($cart)): ?>
                                        <div class="protip-btn">
                                            <form id="demo-form2" method="post"
                                                action="<?php echo e(route('remove.item.cart',$cart->id)); ?>">
                                                <?php echo e(csrf_field()); ?>


                                                <div class="box-footer">
                                                    <button type="submit"
                                                        class="btn btn-primary"><?php echo e(__('Remove From Cart')); ?></button>
                                                </div>
                                            </form>
                                        </div>
                                        <?php else: ?>
                                        <div class="protip-btn">
                                            <form id="demo-form2" method="post"
                                                action="<?php echo e(route('bundlecart', $bundle->id)); ?>" data-parsley-validate
                                                class="form-horizontal form-label-left">
                                                <?php echo e(csrf_field()); ?>


                                                <input type="hidden" name="user_id" value="<?php echo e(Auth::User()->id); ?>" />
                                                <input type="hidden" name="bundle_id" value="<?php echo e($bundle->id); ?>" />

                                                <div class="box-footer">
                                                    <button type="submit"
                                                        class="btn btn-primary"><i data-feather="shopping-cart"></i><?php echo e(__('Add To Cart')); ?></button>
                                                </div>
                                            </form>
                                        </div>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <div class="protip-btn">
                                            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary"><i data-feather="shopping-cart"></i>&nbsp;<?php echo e(__('Add To Cart')); ?></a>
                                        </div>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <?php if(Auth::check()): ?>
                                        <?php if(Auth::User()->role == "admin"): ?>
                                        <div class="protip-btn">
                                            <a href="" class="btn btn-secondary"
                                                title="course"><?php echo e(__('Purchased')); ?></a>
                                        </div>
                                        <?php else: ?>
                                        <?php
                                        $enroll = App\Order::where('user_id', Auth::User()->id)->where('bundle_id',
                                        $bundle->id)->first();
                                        ?>
                                        <?php if($enroll == NULL): ?>
                                        <div class="protip-btn">
                                            <a href="<?php echo e(url('enroll/show',$bundle->id)); ?>" class="btn btn-primary"
                                                title="Enroll Now"><i data-feather="shopping-cart"></i><?php echo e(__('Enroll Now')); ?></a>
                                        </div>
                                        <?php else: ?>
                                        <div class="protip-btn">
                                            <a href="" class="btn btn-secondary"
                                                title="Cart"><?php echo e(__('Purchased')); ?></a>
                                        </div>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <div class="protip-btn">
                                            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary"
                                                title="Enroll Now"><i data-feather="shopping-cart"></i><?php echo e(__('Enroll Now')); ?></a>
                                        </div>
                                        <?php endif; ?>
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
        <?php endif; ?>

    </div>
</section>
<?php endif; ?>
<!-- Bundle end -->
<?php if(!$bestselling->isEmpty() && $hsetting->bestselling_enable && isset($bestselling) && count($bestselling) > 0 ): ?>
<section id="student" class="student-main-block">
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-7">
                <h4 class="student-heading"><?php echo e(__('Best selling Courses')); ?></h4>
            </div>
            <div class="col-lg-6 col-md-6 col-5">
                <div class="view-button txt-rgt">
                    <a href="<?php echo e(url('bestselling/view')); ?>" class="btn btn-secondary" title="View More">View More<i data-feather="chevrons-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div id="bestseller-view-slider" class="student-view-slider-main-block owl-carousel">
            <?php $__currentLoopData = $bestselling; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $best): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           
             <?php if($best->courses->status == 1 ): ?>
            
            <div class="item student-view-block student-view-block-1">
                <div class="genre-slide-image <?php if($gsetting['course_hover'] == 1): ?> protip <?php endif; ?>"
                    data-pt-placement="outside" data-pt-interactive="false"
                    data-pt-title="#prime-next-item-description-block<?php echo e($best->id); ?>">
                    <div class="view-block">
                        <div class="view-img">
                            <?php if($best->courses['preview_image'] !== NULL && $best->courses['preview_image'] !== ''): ?>
                            <a href="<?php echo e(route('user.course.show',['id' => $best->courses->id, 'slug' => $best->courses->slug ])); ?>"><img data-src="<?php echo e(asset('images/course/'.$best->courses['preview_image'])); ?>" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            <?php else: ?>
                            <a href="<?php echo e(route('user.course.show',['id' => $best->courses->id, 'slug' => $best->courses->slug ])); ?>"><img
                                    data-src="<?php echo e(Avatar::create($best->title)->toBase64()); ?>" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            <?php endif; ?>
                        </div>
                        <?php if($best->courses['level_tags'] == 'trending'): ?>
                        <div class="advance-badge">
                            <span class="badge bg-warning"><?php echo e(__('Trending')); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($best->courses['level_tags'] == 'featured'): ?>

                        <div class="advance-badge">
                            <span class="badge bg-danger"><?php echo e(__('Featured')); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($best->courses['level_tags'] == 'new'): ?>

                        <div class="advance-badge">
                            <span class="badge bg-success"><?php echo e(__('New')); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($best->courses['level_tags'] == 'onsale'): ?>

                        <div class="advance-badge">
                            <span class="badge bg-info"><?php echo e(__('Onsale')); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($best->courses['level_tags'] == 'bestseller'): ?>

                        <div class="advance-badge">
                            <span class="badge bg-success"><?php echo e(__('Bestseller')); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($best->courses['level_tags'] == 'beginner'): ?>

                        <div class="advance-badge">
                            <span class="badge bg-primary"><?php echo e(__('Beginner')); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($best->courses['level_tags'] == 'intermediate'): ?>

                        <div class="advance-badge">
                            <span class="badge bg-secondary"><?php echo e(__('Intermediate')); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="view-user-img">
                            <?php if($best->courses->user['user_img'] !== NULL && $best->courses->user['user_img'] !== ''): ?>
                            <a href="<?php echo e(route('all/profile',$best->courses->user->id)); ?>" title=""><img src="<?php echo e(asset('images/user_img/'.$best->courses->user['user_img'])); ?>" class="img-fluid user-img-one" alt=""></a>
                            <?php else: ?>
                            <a href="<?php echo e(route('all/profile',$best->courses->user->id)); ?>" title=""><img src="<?php echo e(asset('images/default/user.png')); ?>" class="img-fluid user-img-one" alt=""></a>
                            <?php endif; ?>
                         
                        </div>

                        <div class="view-dtl">
                            <div class="view-heading"><a
                                    href="<?php echo e(route('user.course.show',['id' => $best->courses->id, 'slug' => $best->courses->slug ])); ?>"><?php echo e(str_limit($best->courses->title, $limit = 30, $end = '...')); ?></a>
                            </div>
                            <div class="user-name">
                                <h6>By <span><a href="<?php echo e(route('all/profile',$best->courses->user->id)); ?>"> <?php echo e(optional($best->courses->user)['fname']); ?></a></span></h6>
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
                                            $reviews = App\ReviewRating::where('course_id',$best->courses->id)->get();
                                            ?>
                                        <?php if(!empty($reviews[0])): ?>
                                        <?php
                                            $count =  App\ReviewRating::where('course_id',$best->courses->id)->count();

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
                                            <div class="star-ratings-sprite"><span
                                                    style="width:<?php echo $ratings_var; ?>%"
                                                    class="star-ratings-sprite-rating"></span>
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

                                        $reviewcount = App\ReviewRating::where('course_id', $best->courses->id)->WhereNotNull('review')->get();

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
                                    $reviewsrating = App\ReviewRating::where('course_id', $best->courses->id)->first();
                                    ?>
                                    <?php if(!empty($reviewsrating)): ?>
                                    <!-- <li>
                                            <b><?php echo e(round($overallrating, 1)); ?></b>
                                        </li> -->
                                    <?php endif; ?>
                                    <li class="reviews">
                                        (<?php
                                        $data = App\ReviewRating::where('course_id', $best->courses->id)->count();
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
                                                $data = App\Order::where('course_id', $best->courses->id)->count();
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
                                        <?php if( $best->courses->type == 1): ?>
                                        <div class="rate text-right">
                                            <ul>

                                                <?php if($best->courses->discount_price == !NULL): ?>

                                                <li><a><b><?php echo e(activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :''); ?><?php echo e(price_format( currency($best->courses['discount_price'], $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false))); ?><?php echo e(activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :''); ?></b></a>
                                                </li>

                                                <li><a><b><strike><?php echo e(activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :''); ?><?php echo e(price_format( currency($best->courses['price'], $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false) )); ?><?php echo e(activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :''); ?></strike></b></a>
                                                </li>


                                                <?php else: ?>

                                                <?php if($c->price == !NULL): ?>
                                                <li><a><b><?php echo e(activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :''); ?><?php echo e(price_format( currency($best->courses['price'], $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false) )); ?><?php echo e(activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :''); ?></b></a>
                                                </li>
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



                            <div class="img-wishlist">
                                <div class="protip-wishlist">
                                    <ul>

                                        <li class="protip-wish-btn"><a
                                                href="https://calendar.google.com/calendar/r/eventedit?text=<?php echo e($best['title']); ?>"
                                                target="__blank" title="reminder"><i data-feather="bell"></i></a></li>

                                        <?php if(Auth::check()): ?>

                                        <li class="protip-wish-btn"><a class="compare" data-id="<?php echo e(filter_var($best->id)); ?>"
                                                title="compare"><i data-feather="bar-chart"></i></a></li>

                                        <?php
                                        $wish = App\Wishlist::where('user_id', Auth::User()->id)->where('course_id',$best->courses->id)->first();
                                        ?>
                                        <?php if($wish == NULL): ?>
                                        <li class="protip-wish-btn">
                                            <form id="demo-form2" method="post"
                                                action="<?php echo e(url('show/wishlist', $best->courses->id)); ?>" data-parsley-validate
                                                class="form-horizontal form-label-left">
                                                <?php echo e(csrf_field()); ?>


                                                <input type="hidden" name="user_id" value="<?php echo e(Auth::User()->id); ?>" />
                                                <input type="hidden" name="course_id" value="<?php echo e($best->courses->id); ?>" />

                                                <button class="wishlisht-btn" title="Add to wishlist" type="submit"><i
                                                        data-feather="heart"></i></button>
                                            </form>
                                        </li>
                                        <?php else: ?>
                                        <li class="protip-wish-btn-two">
                                            <form id="demo-form2" method="post"
                                                action="<?php echo e(url('remove/wishlist', $best->courses->id)); ?>" data-parsley-validate
                                                class="form-horizontal form-label-left">
                                                <?php echo e(csrf_field()); ?>


                                                <input type="hidden" name="user_id" value="<?php echo e(Auth::User()->id); ?>" />
                                                <input type="hidden" name="course_id" value="<?php echo e($best->courses->id); ?>" />

                                                <button class="wishlisht-btn heart-fill" title="Remove from Wishlist"
                                                    type="submit"><i data-feather="heart"></i></button>
                                            </form>
                                        </li>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <li class="protip-wish-btn"><a href="<?php echo e(route('login')); ?>" title="heart"><i
                                                    data-feather="heart"></i></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div id="prime-next-item-description-block<?php echo e($best->courses->id); ?>" class="prime-description-block">
                    <div class="prime-description-under-block">
                        <div class="prime-description-under-block">
                            <h5 class="description-heading"><?php echo e($best->courses['title']); ?></h5>
                            <div class="main-des">
                                <p>Last Updated: <?php echo e(date('jS F Y', strtotime($best->courses->updated_at))); ?></p>
                            </div>

                            <ul class="description-list">
                                <li>
                                    <i data-feather="play-circle"></i>
                                    <div class="class-des">
                                        <?php echo e(__('Classes')); ?>:
                                        <?php
                                        $data = App\CourseClass::where('course_id', $best->courses->id)->count();
                                        if($data > 0){

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

                                                $classtwo = App\CourseClass::where('course_id',
                                                $best->courses->id)->sum("duration");

                                                ?>
                                                <?php echo e($classtwo); ?> <?php echo e(__('Minutes')); ?>

                                            </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="lang-des">
                                        <?php if($best->courses['language_id'] == !NULL): ?>
                                        <?php if(isset($best->courses->language)): ?>
                                        <i data-feather="globe"></i> <?php echo e($best->courses->language['name']); ?>

                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </li>
                            </ul>

                            <div class="product-main-des">
                                <p><?php echo e($best->courses->short_detail); ?></p>
                            </div>
                            <div>
                                <?php if($best->courses->whatlearns->isNotEmpty()): ?>
                                <?php $__currentLoopData = $best->courses->whatlearns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($wl->status ==1): ?>
                                <div class="product-learn-dtl">
                                    <ul>
                                        <li><i
                                                data-feather="check-circle"></i><?php echo e(str_limit($wl['detail'], $limit = 120, $end = '...')); ?>

                                        </li>
                                    </ul>
                                </div>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                            <div class="des-btn-block">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <?php if($best->courses->type == 1): ?>
                                        <?php if(Auth::check()): ?>
                                        <?php if(Auth::User()->role == "admin"): ?>
                                        <div class="protip-btn">
                                            <a href="<?php echo e(route('course.content',['id' => $best->courses->id, 'slug' => $best->courses->slug ])); ?>"
                                                class="btn btn-secondary"
                                                title="course"><?php echo e(__('Go To Course')); ?></a>
                                        </div>
                                        <?php else: ?>
                                        <?php
                                        $order = App\Order::where('user_id', Auth::User()->id)->where('course_id',
                                        $best->courses->id)->first();
                                        ?>
                                        <?php if(!empty($order) && $order->status == 1): ?>
                                        <div class="protip-btn">
                                            <a href="<?php echo e(route('course.content',['id' => $best->courses->id, 'slug' => $best->courses->slug ])); ?>"
                                                class="btn btn-secondary"
                                                title="course"><?php echo e(__('Go To Course')); ?></a>
                                        </div>
                                        <?php else: ?>
                                        <?php
                                        $cart = App\Cart::where('user_id', Auth::User()->id)->where('course_id',
                                        $best->courses->id)->first();
                                        ?>
                                        <?php if(!empty($cart)): ?>
                                        <div class="protip-btn">
                                            <form id="demo-form2" method="post"
                                                action="<?php echo e(route('remove.item.cart',$cart->id)); ?>">
                                                <?php echo e(csrf_field()); ?>


                                                <div class="box-footer">
                                                    <button type="submit"
                                                        class="btn btn-primary"><?php echo e(__('Remove From Cart')); ?></button>
                                                </div>
                                            </form>
                                        </div>
                                        <?php else: ?>
                                        <div class="protip-btn">
                                            <form id="demo-form2" method="post"
                                                action="<?php echo e(route('addtocart',['course_id' => $best->courses->id, 'price' => $best->courses->price, 'discount_price' => $best->courses->discount_price ])); ?>"
                                                data-parsley-validate class="form-horizontal form-label-left">
                                                <?php echo e(csrf_field()); ?>


                                                <input type="hidden" name="category_id"
                                                    value="<?php echo e($best->category['id'] ?? '-'); ?>" />

                                                <div class="box-footer">
                                                    <button type="submit"
                                                        class="btn btn-primary"><?php echo e(__('Add To Cart')); ?></button>
                                                </div>
                                            </form>
                                        </div>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <?php if($gsetting->guest_enable == 1): ?>
                                        <form id="demo-form2" method="post" action="<?php echo e(route('guest.addtocart', $best->courses->id)); ?>" data-parsley-validate
                                            class="form-horizontal form-label-left">
                                            <?php echo e(csrf_field()); ?>

                                            <div class="box-footer">
                                                <button type="submit" class="btn btn-primary"><i data-feather="shopping-cart"></i>&nbsp;<?php echo e(__('Add To Cart')); ?></button>
                                            </div>
                                        </form>
                                        <?php else: ?>
                                        <div class="protip-btn">
                                            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary"><i data-feather="shopping-cart"></i>&nbsp;<?php echo e(__('Add To Cart')); ?></a>
                                        </div>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <?php if(Auth::check()): ?>
                                        <?php if(Auth::User()->role == "admin"): ?>
                                        <div class="protip-btn">
                                            <a href="<?php echo e(route('course.content',['id' => $best->courses->id, 'slug' => $best->courses->slug ])); ?>"
                                                class="btn btn-secondary"
                                                title="course"><?php echo e(__('Go To Course')); ?></a>
                                        </div>
                                        <?php else: ?>
                                        <?php
                                        $enroll = App\Order::where('user_id', Auth::User()->id)->where('course_id',
                                        $best->courses->id)->first();
                                        ?>
                                        <?php if($enroll == NULL): ?>
                                        <div class="protip-btn">
                                            <a href="<?php echo e(url('enroll/show',$best->courses->id)); ?>" class="btn btn-primary"
                                                title="Enroll Now"><i data-feather="shopping-cart"></i><?php echo e(__('Enroll Now')); ?></a>
                                        </div>
                                        <?php else: ?>
                                        <div class="protip-btn">
                                            <a href="<?php echo e(route('course.content',['id' => $best->courses->id, 'slug' => $best->courses->slug ])); ?>"
                                                class="btn btn-secondary"
                                                title="Cart"><?php echo e(__('Go To Course')); ?></a>
                                        </div>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <div class="protip-btn">
                                            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary"
                                                title="Enroll Now"><i data-feather="shopping-cart"></i><?php echo e(__('Enroll Now')); ?></a>
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
                                                    $wish = App\Wishlist::where('user_id',
                                                    Auth::User()->id)->where('course_id', $best->courses->id)->first();
                                                    ?>
                                                    <?php if($wish == NULL): ?>
                                                    <li class="protip-wish-btn">
                                                        <form id="demo-form2" method="post"
                                                            action="<?php echo e(url('show/wishlist', $best->courses->id)); ?>"
                                                            data-parsley-validate
                                                            class="form-horizontal form-label-left">
                                                            <?php echo e(csrf_field()); ?>


                                                            <input type="hidden" name="user_id"
                                                                value="<?php echo e(Auth::User()->id); ?>" />
                                                            <input type="hidden" name="course_id" value="<?php echo e($best->courses->id); ?>" />

                                                            <button class="wishlisht-btn" title="Add to wishlist"
                                                                type="submit"><i data-feather="heart"></i></button>
                                                        </form>
                                                    </li>
                                                    <?php else: ?>
                                                    <li class="protip-wish-btn-two">
                                                        <form id="demo-form2" method="post"
                                                            action="<?php echo e(url('remove/wishlist', $best->id)); ?>"
                                                            data-parsley-validate
                                                            class="form-horizontal form-label-left">
                                                            <?php echo e(csrf_field()); ?>


                                                            <input type="hidden" name="user_id"
                                                                value="<?php echo e(Auth::User()->id); ?>" />
                                                            <input type="hidden" name="course_id" value="<?php echo e($best->courses->id); ?>" />

                                                            <button class="wishlisht-btn heart-fill" title="Remove from Wishlist"
                                                                type="submit"><i data-feather="heart"></i></button>
                                                        </form>
                                                    </li>
                                                    <?php endif; ?>
                                                    <?php else: ?>
                                                    <li class="protip-wish-btn"><a href="<?php echo e(route('login')); ?>"
                                                            title="heart"><i data-feather="heart"></i></a></li>
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
            </div>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
        </div>
    </div>
</section>
<?php endif; ?>
<!-- Advertisement -->
<?php if(isset($advs)): ?>
<?php $__currentLoopData = $advs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($adv->position == 'belowbundle'): ?>
<br>
<section id="student" class="student-main-block btm-40">
    <div class="container-xl">
        <a href="<?php echo e($adv->url1); ?>" title="<?php echo e(__('Click to visit')); ?>">
            <img class="lazy img-fluid advertisement-img-one" data-src="<?php echo e(url('images/advertisement/'.$adv->image1)); ?>"
                alt="<?php echo e($adv->image1); ?>">
        </a>
    </div>
</section>
<?php endif; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endif; ?>
<!-- Zoom start -->
<?php if($hsetting->livemeetings_enable == 1): ?>
<?php if($gsetting->zoom_enable == '1' || $gsetting->bbl_enable == '1' || $gsetting->googlemeet_enable == '1' ||
$gsetting->jitsimeet_enable == '1'): ?>
<section id="student" class="student-main-block">
    <div class="container-xl">
        <?php
        $mytime = Carbon\Carbon::now();
        ?>
        <?php if( count($meetings) > 0 || count($bigblue) > 0 || count($allgooglemeet) > 0 || count($jitsimeeting) > 0 ): ?>
        <h4 class="student-heading"><?php echo e(__('Live Meetings')); ?></h4>
        <div id="zoom-view-slider" class="student-view-slider-main-block owl-carousel">

            <?php if( ! $meetings->isEmpty() ): ?>
            <?php $__currentLoopData = $meetings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item student-view-block student-view-block-1">
                <div class="genre-slide-image <?php if($gsetting['course_hover'] == 1): ?> protip <?php endif; ?>" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block-6<?php echo e($meeting->id); ?>">
                    <div class="view-block">
                        <div class="view-img">

                            <?php if($meeting['image'] !== NULL && $meeting['image'] !== ''): ?>
                            <a href="<?php echo e(route('zoom.detail', $meeting->id)); ?>"><img data-src="<?php echo e(asset('images/zoom/'.$meeting['image'])); ?>" alt="course" class="img-fluid owl-lazy"></a>
                            <?php else: ?>
                            <a href="<?php echo e(route('zoom.detail', $meeting->id)); ?>"><img data-src="<?php echo e(Avatar::create($meeting['meeting_title'])->toBase64()); ?>" alt="course" class="img-fluid owl-lazy"></a>
                            <?php endif; ?>


                        </div>
                        <div class="view-user-img">

                            <?php if(optional($meeting->user)['user_img'] !== NULL && optional($meeting->user)['user_img'] !== ''): ?>
                            <a href="<?php echo e(route('all/profile',$meeting->user->id)); ?>" title=""><img src="<?php echo e(asset('images/user_img/'.$meeting->user['user_img'])); ?>" class="img-fluid user-img-one" alt=""></a>
                            <?php else: ?>
                            <a href="<?php echo e(route('all/profile',$meeting->user->id)); ?>" title=""><img src="<?php echo e(asset('images/default/user.png')); ?>" class="img-fluid user-img-one" alt=""></a>
                            <?php endif; ?>


                        </div>
                        <?php if(asset('images/meeting_icons/zoom.png') == !NULL): ?>
                        <div class="meeting-icon"><img src="<?php echo e(asset('images/meeting_icons/zoom.png')); ?>" class="img-circle" alt=""></div>
                        <?php endif; ?>


                        <div class="view-dtl">
                            <div class="view-heading"><a href="#">
                                    <?php echo e(str_limit($meeting->meeting_title, $limit = 30, $end = '...')); ?></a></div>
                            <div class="user-name">
                                <h6>By <span><a href="<?php echo e(route('all/profile',$meeting->user->id)); ?>"> <?php echo e(optional($meeting->user)['fname']); ?></a></span></h6>
                            </div>
                            <div class="view-footer">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-date">
                                            <a href="#"><i data-feather="calendar"></i>
                                                <?php echo e(date('d-m-Y',strtotime($meeting['start_time']))); ?></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-time">
                                            <a href="#"><i data-feather="clock"></i>
                                                <?php echo e(date('h:i:s A',strtotime($meeting['start_time']))); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="img-wishlist">
                                <div class="protip-wishlist">
                                    <ul>

                                        <li class="protip-wish-btn"><a href="https://calendar.google.com/calendar/r/eventedit?text=<?php echo e($discount['title']); ?>" target="__blank" title="reminder"><i data-feather="bell"></i></a></li>

                                        <?php if(Auth::check()): ?>

                                        <li class="protip-wish-btn"><a class="compare" data-id="<?php echo e(filter_var($discount->id)); ?>" title="compare"><i data-feather="bar-chart"></i></a></li>

                                        <?php
                                        $wish = App\Wishlist::where('user_id', Auth::User()->id)->where('course_id',
                                        $discount->id)->first();
                                        ?>
                                        <?php if($wish == NULL): ?>
                                        <li class="protip-wish-btn">
                                            <form id="demo-form2" method="post" action="<?php echo e(url('show/wishlist', $discount->id)); ?>" data-parsley-validate class="form-horizontal form-label-left">
                                                <?php echo e(csrf_field()); ?>


                                                <input type="hidden" name="user_id" value="<?php echo e(Auth::User()->id); ?>" />
                                                <input type="hidden" name="course_id" value="<?php echo e($discount->id); ?>" />

                                                <button class="wishlisht-btn" title="Add to wishlist" type="submit"><i data-feather="heart"></i></button>
                                            </form>
                                        </li>
                                        <?php else: ?>
                                        <li class="protip-wish-btn-two">
                                            <form id="demo-form2" method="post" action="<?php echo e(url('remove/wishlist', $discount->id)); ?>" data-parsley-validate class="form-horizontal form-label-left">
                                                <?php echo e(csrf_field()); ?>


                                                <input type="hidden" name="user_id" value="<?php echo e(Auth::User()->id); ?>" />
                                                <input type="hidden" name="course_id" value="<?php echo e($discount->id); ?>" />

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
                <div id="prime-next-item-description-block-6<?php echo e($meeting->id); ?>" class="prime-description-block">
                    <div class="prime-description-under-block">
                        <div class="prime-description-under-block">
                            <h5 class="description-heading"><a href="<?php echo e(route('zoom.detail', $meeting->id)); ?>"><?php echo e($meeting['meeting_title']); ?></a>
                            </h5>
                            <div class="protip-img">
                                <h6 class="user-name"><?php echo e(__('by')); ?>

                                    <?php if(isset($meeting->user)): ?> <?php echo e($meeting->user['fname']); ?> <?php endif; ?></h6>
                                <p class="meeting-owner btm-10"><a herf="#">Meeting Owner:
                                        <?php echo e($meeting->owner_id); ?></a></p>
                            </div>
                            <div class="main-des meeting-main-des">
                                <div class="main-des-head">Start At: </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-date">
                                            <a href="#"><i data-feather="calendar"></i> <?php echo e(date('d-m-Y',strtotime($meeting['start_time']))); ?></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-time">
                                            <a href="#"><i data-feather="clock"></i> <?php echo e(date('h:i:s A',strtotime($meeting['start_time']))); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="des-btn-block">
                                <a href="<?php echo e($meeting->zoom_url); ?>" class="iframe btn btn-light"><?php echo e(__('Join Meeting')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <?php if( ! $bigblue->isEmpty() ): ?>
            <?php $__currentLoopData = $bigblue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


            <div class="item student-view-block student-view-block-1">
                <div class="genre-slide-image <?php if($gsetting['course_hover'] == 1): ?> protip <?php endif; ?>" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block-7<?php echo e($bbl->id); ?>">
                    <div class="view-block">
                        <div class="view-img">
                            <a href="<?php echo e(route('bbl.detail', $bbl->id)); ?>"><img data-src="<?php echo e(Avatar::create($bbl['meetingname'])->toBase64()); ?>" alt="course" class="img-fluid owl-lazy"></a>
                        </div>
                        <div class="view-user-img">

                            <?php if(optional($bbl->user)['user_img'] !== NULL && optional($bbl->user)['user_img'] !== ''): ?>
                            <a href="<?php echo e(route('all/profile',$bbl->user->id)); ?>" title=""><img src="<?php echo e(asset('images/user_img/'.$bbl->user['user_img'])); ?>" class="img-fluid user-img-one" alt=""></a>
                            <?php else: ?>
                            <a href="<?php echo e(route('all/profile',$bbl->user->id)); ?>" title=""><img src="<?php echo e(asset('images/default/user.png')); ?>" class="img-fluid user-img-one" alt=""></a>
                            <?php endif; ?>


                        </div>
                        <?php if(asset('images/meeting_icons/bigblue.png') == !NULL): ?>
                        <div class="meeting-icon"><img src="<?php echo e(asset('images/meeting_icons/bigblue.png')); ?>" class="img-circle" alt=""></div>
                        <?php endif; ?>

                        <div class="view-dtl">
                            <div class="view-heading"><a href="<?php echo e(route('bbl.detail', $bbl->id)); ?>"><?php echo e(str_limit($bbl['meetingname'], $limit = 30, $end = '...')); ?></a>
                            </div>
                            <div class="user-name">
                                <h6>By <span><a href="<?php echo e(route('all/profile',$bbl->user->id)); ?>"> <?php echo e(optional($bbl->user)['fname']); ?></a></span></h6>
                            </div>
                            <div class="view-footer">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-date">
                                            <a href="#"><i data-feather="calendar"></i>
                                                <?php echo e(date('d-m-Y',strtotime($bbl['start_time']))); ?></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-time">
                                            <a href="#"><i data-feather="clock"></i>
                                                <?php echo e(date('h:i:s A',strtotime($bbl['start_time']))); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="img-wishlist">
                                <div class="protip-wishlist">
                                    <ul>

                                        <li class="protip-wish-btn"><a href="https://calendar.google.com/calendar/r/eventedit?text=<?php echo e($discount['title']); ?>" target="__blank" title="reminder"><i data-feather="bell"></i></a></li>

                                        <?php if(Auth::check()): ?>

                                        <li class="protip-wish-btn"><a class="compare" data-id="<?php echo e(filter_var($discount->id)); ?>" title="compare"><i data-feather="bar-chart"></i></a></li>

                                        <?php
                                        $wish = App\Wishlist::where('user_id', Auth::User()->id)->where('course_id',
                                        $discount->id)->first();
                                        ?>
                                        <?php if($wish == NULL): ?>
                                        <li class="protip-wish-btn">
                                            <form id="demo-form2" method="post" action="<?php echo e(url('show/wishlist', $discount->id)); ?>" data-parsley-validate class="form-horizontal form-label-left">
                                                <?php echo e(csrf_field()); ?>


                                                <input type="hidden" name="user_id" value="<?php echo e(Auth::User()->id); ?>" />
                                                <input type="hidden" name="course_id" value="<?php echo e($discount->id); ?>" />

                                                <button class="wishlisht-btn" title="Add to wishlist" type="submit"><i data-feather="heart"></i></button>
                                            </form>
                                        </li>
                                        <?php else: ?>
                                        <li class="protip-wish-btn-two">
                                            <form id="demo-form2" method="post" action="<?php echo e(url('remove/wishlist', $discount->id)); ?>" data-parsley-validate class="form-horizontal form-label-left">
                                                <?php echo e(csrf_field()); ?>


                                                <input type="hidden" name="user_id" value="<?php echo e(Auth::User()->id); ?>" />
                                                <input type="hidden" name="course_id" value="<?php echo e($discount->id); ?>" />

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
                <div id="prime-next-item-description-block-7<?php echo e($bbl->id); ?>" class="prime-description-block">
                    <div class="prime-description-under-block">
                        <div class="prime-description-under-block">
                            <h5 class="description-heading"><?php echo e($bbl['meetingname']); ?></h5>
                            <div class="protip-img">
                                <a href="<?php echo e(route('bbl.detail', $bbl->id)); ?>"><img src="<?php echo e(Avatar::create($bbl['meetingname'])->toBase64()); ?>" alt="course" class="img-fluid"></a>
                            </div>

                            <div class="main-des">
                                <p><?php echo $bbl['detail']; ?></p>
                            </div>
                            <div class="des-btn-block">
                                <div class="row">
                                    <div class="col-lg-12">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <?php if( isset($allgooglemeet) ): ?>
            <?php $__currentLoopData = $allgooglemeet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item student-view-block student-view-block-1">
                <div class="genre-slide-image <?php if($gsetting['course_hover'] == 1): ?> protip <?php endif; ?>" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block-6<?php echo e($meeting['meeting_id']); ?>">
                    <div class="view-block">
                        <div class="view-img">

                            <?php if($meeting['image'] !== NULL && $meeting['image'] !== ''): ?>
                            <a href="<?php echo e(route('googlemeetdetailpage.detail', $meeting['id'])); ?>"><img data-src="<?php echo e(asset('images/googlemeet/profile_image/'.$meeting['image'])); ?>" alt="course" class="img-fluid owl-lazy"></a>
                            <?php else: ?>
                            <a href="<?php echo e(route('googlemeetdetailpage.detail', $meeting['id'])); ?>"><img data-src="<?php echo e(Avatar::create($meeting['meeting_title'])->toBase64()); ?>" alt="course" class="img-fluid owl-lazy"></a>
                            <?php endif; ?>


                        </div>
                        <div class="view-user-img">

                            <?php if(optional($meeting->user)['user_img'] !== NULL && optional($meeting->user)['user_img'] !== ''): ?>
                            <a href="<?php echo e(route('all/profile',$meeting->user->id)); ?>" title=""><img src="<?php echo e(asset('images/user_img/'.$meeting->user['user_img'])); ?>" class="img-fluid user-img-one" alt=""></a>
                            <?php else: ?>
                            <a href="<?php echo e(route('all/profile',$meeting->user->id)); ?>" title=""><img src="<?php echo e(asset('images/default/user.png')); ?>" class="img-fluid user-img-one" alt=""></a>
                            <?php endif; ?>


                        </div>
                        <?php if(asset('images/meeting_icons/google.png') == !NULL): ?>
                        <div class="meeting-icon"><img src="<?php echo e(asset('images/meeting_icons/google.png')); ?>" class="img-circle" alt=""></div>
                        <?php endif; ?>

                        <div class="view-dtl">
                            <div class="view-heading"><a href="#">
                                    <?php echo e(str_limit($meeting->meeting_title, $limit = 30, $end = '...')); ?></a></div>
                            <div class="user-name">
                                <h6>By <span><a href="<?php echo e(route('all/profile',$meeting->user->id)); ?>"> <?php echo e(optional($meeting->user)['fname']); ?></a></span></h6>
                            </div>
                            <div class="view-footer">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-date">
                                            <a href="#"><i data-feather="calendar"></i>
                                                <?php echo e(date('d-m-Y',strtotime($meeting['start_time']))); ?></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-time">
                                            <a href="#"><i data-feather="clock"></i>
                                                <?php echo e(date('h:i:s A',strtotime($meeting['start_time']))); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="img-wishlist">
                                <div class="protip-wishlist">
                                    <ul>

                                        <li class="protip-wish-btn"><a href="https://calendar.google.com/calendar/r/eventedit?text=<?php echo e($discount['title']); ?>" target="__blank" title="reminder"><i data-feather="bell"></i></a></li>

                                        <?php if(Auth::check()): ?>

                                        <li class="protip-wish-btn"><a class="compare" data-id="<?php echo e(filter_var($discount->id)); ?>" title="compare"><i data-feather="bar-chart"></i></a></li>

                                        <?php
                                        $wish = App\Wishlist::where('user_id', Auth::User()->id)->where('course_id',
                                        $discount->id)->first();
                                        ?>
                                        <?php if($wish == NULL): ?>
                                        <li class="protip-wish-btn">
                                            <form id="demo-form2" method="post" action="<?php echo e(url('show/wishlist', $discount->id)); ?>" data-parsley-validate class="form-horizontal form-label-left">
                                                <?php echo e(csrf_field()); ?>


                                                <input type="hidden" name="user_id" value="<?php echo e(Auth::User()->id); ?>" />
                                                <input type="hidden" name="course_id" value="<?php echo e($discount->id); ?>" />

                                                <button class="wishlisht-btn" title="Add to wishlist" type="submit"><i data-feather="heart"></i></button>
                                            </form>
                                        </li>
                                        <?php else: ?>
                                        <li class="protip-wish-btn-two">
                                            <form id="demo-form2" method="post" action="<?php echo e(url('remove/wishlist', $discount->id)); ?>" data-parsley-validate class="form-horizontal form-label-left">
                                                <?php echo e(csrf_field()); ?>


                                                <input type="hidden" name="user_id" value="<?php echo e(Auth::User()->id); ?>" />
                                                <input type="hidden" name="course_id" value="<?php echo e($discount->id); ?>" />

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
                <div id="prime-next-item-description-block-6<?php echo e($meeting['meeting_id']); ?>" class="prime-description-block">
                    <div class="prime-description-under-block">
                        <div class="prime-description-under-block">
                            <h5 class="description-heading"><a href="<?php echo e(route('zoom.detail', $meeting->id)); ?>"><?php echo e($meeting['meeting_title']); ?></a>
                            </h5>
                            <div class="protip-img">
                                <h6 class="user-name"><?php echo e(__('by')); ?>

                                    <?php if(isset($meeting->user)): ?> <?php echo e($meeting->user['fname']); ?> <?php endif; ?></h6>
                                <p class="meeting-owner btm-10"><a herf="#"><?php echo e(__('Meeting Owner:')); ?>

                                        <?php echo e($meeting->owner_id); ?></a></p>
                            </div>
                            <div class="main-des meeting-main-des">
                                <div class="main-des-head"><?php echo e(__('Start At:')); ?> </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-date">
                                            <a href="#"><i data-feather="calendar"></i> <?php echo e(date('d-m-Y',strtotime($meeting['start_time']))); ?></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-time">
                                            <a href="#"><i data-feather="clock"></i> <?php echo e(date('h:i:s A',strtotime($meeting['start_time']))); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="main-des meeting-main-des">
                                <div class="main-des-head"><?php echo e(__('End At: ')); ?></div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-date">
                                            <a href="#"><i data-feather="calendar"></i> <?php echo e(date('d-m-Y',strtotime($meeting['end_time']))); ?></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-time">
                                            <a href="#"><i data-feather="clock"></i> <?php echo e(date('h:i:s A',strtotime($meeting['end_time']))); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="des-btn-block">
                                <a href="<?php echo e($meeting->meet_url); ?>" target="_blank" class="btn btn-light">Join
                                    <?php echo e(__('Meeting')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <?php if( ! $jitsimeeting->isEmpty() ): ?>
            <?php $__currentLoopData = $jitsimeeting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item student-view-block student-view-block-1">
                <div class="genre-slide-image <?php if($gsetting['course_hover'] == 1): ?> protip <?php endif; ?>" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block-6<?php echo e($meeting['meeting_id']); ?>">
                    <div class="view-block">
                        <div class="view-img">

                            <?php if($meeting['image'] !== NULL && $meeting['image'] !== ''): ?>
                            <a href="<?php echo e(route('jitsipage.detail', $meeting['id'])); ?>"><img data-src="<?php echo e(asset('images/jitsimeet/'.$meeting['image'])); ?>" alt="course" class="img-fluid owl-lazy"></a>
                            <?php else: ?>
                            <a href="<?php echo e(route('jitsipage.detail', $meeting['id'])); ?>"><img data-src="<?php echo e(Avatar::create($meeting['meeting_title'])->toBase64()); ?>" alt="course" class="img-fluid owl-lazy"></a>
                            <?php endif; ?>


                        </div>
                        <div class="view-user-img">

                            <?php if(optional($meeting->user)['user_img'] !== NULL && optional($meeting->user)['user_img'] !== ''): ?>
                            <a href="<?php echo e(route('all/profile',$meeting->user->id)); ?>" title=""><img src="<?php echo e(asset('images/user_img/'.$meeting->user['user_img'])); ?>" class="img-fluid user-img-one" alt=""></a>
                            <?php else: ?>
                            <a href="<?php echo e(route('all/profile',$meeting->user->id)); ?>" title=""><img src="<?php echo e(asset('images/default/user.png')); ?>" class="img-fluid user-img-one" alt=""></a>
                            <?php endif; ?>


                        </div>
                        <?php if(asset('images/meeting_icons/jitsi.png') == !NULL): ?>
                        <div class="meeting-icon"><img src="<?php echo e(asset('images/meeting_icons/jitsi.png')); ?>" class="img-circle" alt=""></div>
                        <?php endif; ?>

                        <div class="view-dtl">
                            <div class="view-heading"><a href="#">
                                    <?php echo e(str_limit($meeting->meeting_title, $limit = 30, $end = '...')); ?></a></div>
                            <div class="user-name">
                                <h6>By <span><a href="<?php echo e(route('all/profile',$meeting->user->id)); ?>"> <?php echo e(optional($meeting->user)['fname']); ?></a></span></h6>
                            </div>
                            <div class="view-footer">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-date">
                                            <a href="#"><i data-feather="calendar"></i>
                                                <?php echo e(date('d-m-Y',strtotime($meeting['start_time']))); ?></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-time">
                                            <a href="#"><i data-feather="clock"></i>
                                                <?php echo e(date('h:i:s A',strtotime($meeting['start_time']))); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="img-wishlist">
                                <div class="protip-wishlist">
                                    <ul>
                                        <li class="protip-wish-btn"><a href="https://calendar.google.com/calendar/r/eventedit?text=<?php echo e($discount['title']); ?>" target="__blank" title="reminder"><i data-feather="bell"></i></a></li>
                                        <?php if(Auth::check()): ?>
                                        <li class="protip-wish-btn"><a class="compare" data-id="<?php echo e(filter_var($discount->id)); ?>" title="compare"><i data-feather="bar-chart"></i></a></li>
                                        <?php
                                        $wish = App\Wishlist::where('user_id', Auth::User()->id)->where('course_id',
                                        $discount->id)->first();
                                        ?>
                                        <?php if($wish == NULL): ?>
                                        <li class="protip-wish-btn">
                                            <form id="demo-form2" method="post" action="<?php echo e(url('show/wishlist', $discount->id)); ?>" data-parsley-validate class="form-horizontal form-label-left">
                                                <?php echo e(csrf_field()); ?>


                                                <input type="hidden" name="user_id" value="<?php echo e(Auth::User()->id); ?>" />
                                                <input type="hidden" name="course_id" value="<?php echo e($discount->id); ?>" />

                                                <button class="wishlisht-btn" title="Add to wishlist" type="submit"><i data-feather="heart"></i></button>
                                            </form>
                                        </li>
                                        <?php else: ?>
                                        <li class="protip-wish-btn-two">
                                            <form id="demo-form2" method="post" action="<?php echo e(url('remove/wishlist', $discount->id)); ?>" data-parsley-validate class="form-horizontal form-label-left">
                                                <?php echo e(csrf_field()); ?>


                                                <input type="hidden" name="user_id" value="<?php echo e(Auth::User()->id); ?>" />
                                                <input type="hidden" name="course_id" value="<?php echo e($discount->id); ?>" />

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
                <div id="prime-next-item-description-block-6<?php echo e($meeting['meeting_id']); ?>" class="prime-description-block">
                    <div class="prime-description-under-block">
                        <div class="prime-description-under-block">
                            <h5 class="description-heading"><a href="<?php echo e(route('zoom.detail', $meeting->id)); ?>"><?php echo e($meeting['meeting_title']); ?></a>
                            </h5>
                            <div class="protip-img">
                                <h6 class="user-name"><?php echo e(__('by')); ?>

                                    <?php if(isset($meeting->user)): ?> <?php echo e($meeting->user['fname']); ?> <?php endif; ?></h6>
                                <p class="meeting-owner btm-10"><a herf="#"><?php echo e(__('Meeting Owner')); ?>:
                                        <?php echo e($meeting->owner_id); ?></a></p>
                            </div>
                            <div class="main-des meeting-main-des">
                                <div class="main-des-head">Start At: </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-date">
                                            <a href="#"><i data-feather="calendar"></i> <?php echo e(date('d-m-Y',strtotime($meeting['start_time']))); ?></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-time">
                                            <a href="#"><i data-feather="clock"></i> <?php echo e(date('h:i:s A',strtotime($meeting['start_time']))); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="main-des meeting-main-des">
                                <div class="main-des-head"><?php echo e(__('End At')); ?>: </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-date">
                                            <a href="#"><i data-feather="calendar"></i> <?php echo e(date('d-m-Y',strtotime($meeting['end_time']))); ?></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-time">
                                            <a href="#"><i data-feather="clock"></i> <?php echo e(date('h:i:s A',strtotime($meeting['end_time']))); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="des-btn-block">
                                <a href="<?php echo e(url('meetup-conferencing/'.$meeting->meeting_id)); ?>" target="_blank" class="btn btn-light"><?php echo e(__('Join Meeting')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>


        </div>

        <?php endif; ?>

    </div>
</section>
<?php endif; ?>
<?php endif; ?>
<!-- Zoom end -->

<!-- google class room start -->
<?php if(Schema::hasTable('googleclassrooms') && Module::has('Googleclassroom') &&
Module::find('Googleclassroom')->isEnabled()): ?>
<?php echo $__env->make('googleclassroom::frontend.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<!-- google class room end -->
<?php if($hsetting->batch_enable == 1 && ! $instruct->isEmpty() ): ?>
<section id="instructor-home-two" class="instructor-home-main-block">
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-6 col-7">
                <h4 class="student-heading"><?php echo e(__('Featured Instructor')); ?></h4>
            </div>
            
        </div>
        
        <div id="instructor-home-slider-two" class="instructor-home-main-slider owl-carousel">
            <?php $__currentLoopData = $instruct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <div class="item">
                <div class="instructor-home-block text-center">
                    <div class="instructor-home-block-one">
                        <?php if($inst->user->user_img !== NULL && $inst->user->user_img !== ''): ?>
                        <a href="<?php echo e(route('allinstructor/profile',$inst->id)); ?>" title=""><img src="<?php echo e(url('/images/user_img/'.$inst->user->user_img)); ?>"  class="img-fluid" /></a>
                        <?php else: ?>
                        <a href="<?php echo e(route('allinstructor/profile',$inst->id)); ?>" title=""><img src="<?php echo e(Avatar::create($inst->user->fname)->toBase64()); ?>" alt="course"
                            class="img-fluid"></a>
                        <?php endif; ?>
                        <div class="instructor-home-hover-icon">
                            <ul>
                                <li>
                                    <div class="tooltip">
                                        <div class="tooltip-icon">
                                            <i data-feather="share-2"></i>
                                        </div>
                                        <span class="tooltiptext">
                                            <div class="instructor-home-social-icon">
                                                <ul>
                                                    <?php
                                                     $url = URL::to('/').'/allinstructor/profile/'.$inst->id;
                                                    ?>
                                                    <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo e($url); ?>&title=Default+share+text&summary=" target="_blank"><b><i class="fa fa-linkedin" aria-hidden="true"></i></b></a></li>
                                                    <li><a href="https://www.facebook.com/sharer/sharer.php?&url=<?php echo e($url); ?>" target="_blank"><b><i class="fa fa-facebook-square" aria-hidden="true"></i></b></a></li>
                                                    <li><a href="https://twitter.com/intent/tweet?text=Default+share+text&url=<?php echo e($url); ?>" target="_blank"><b><i class="fa fa-twitter" aria-hidden="true"></i></b></a></li>
                                                    <li><a href="https://telegram.me/share/url?url=<?php echo e($url); ?>&text=Default+share+text" target="_blank"><b><i class="fa fa-telegram" aria-hidden="true"></i></b></a></li>
                                                    <li><a href="https://wa.me/?text=<?php echo e($url); ?>" target="_blank"><b><i class="fa fa-whatsapp" aria-hidden="true"></i></b></a></li>
                                                 </ul>
                                            </div>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <div class="instructor-home-btn">
                                        <a href="<?php echo e(route('allinstructor/profile',$inst->id)); ?>" class="btn btn-primary" title="View Profile"><i data-feather="eye"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </div> 
                        <div class="instructor-home-dtl">
                            <h4 class="instructor-home-heading"><a href="#" title=""><?php echo e($inst->fname); ?> <?php echo e($inst->lname); ?></a></h4>
                            <p><?php echo e($inst->role); ?></p>
                        
                            <?php

                            $followers = App\Followers::where('user_id', '!=', $inst->id)->where('follower_id', $inst->id)->count();

                            $followings = App\Followers::where('user_id', $inst->id)->where('follower_id','!=', $inst->id)->count();
                            $course = App\Course::where('user_id', $inst->id)->count();

                            ?>
                            <div class="instructor-home-info">
                                <ul>
                                    <?php if($course > 0): ?>
                                    <li><?php echo e($course); ?> <?php echo e(__('Courses')); ?></li>
                                    <?php else: ?>
                                    <li><?php echo e(__('No Courses')); ?></li>
                                    <?php endif; ?>
                                    <li><?php echo e($followers); ?> <?php echo e(__('Follower')); ?></li>
                                    <li><?php echo e($followings); ?> <?php echo e(__('Following')); ?></li>
                                </ul>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
</section>
<?php endif; ?>
<!-- Bundle start -->
<?php if($hsetting->blog_enable == 1 && ! $blogs->isEmpty() ): ?>
<section id="student" class="student-main-block">
    <div class="container-xl">

        <h4 class="student-heading"><?php echo e(__('Recent Blogs')); ?></h4>
        <div id="blog-post-slider" class="student-view-slider-main-block owl-carousel">
            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


            <div class="item student-view-block student-view-block-1">
                <div class="genre-slide-image <?php if($gsetting['course_hover'] == 1): ?> protip <?php endif; ?>"
                    data-pt-placement="outside" data-pt-interactive="false"
                    data-pt-title="#prime-next-item-description-block-8<?php echo e($blog->id); ?>">
                    <div class="view-block">
                        <div class="view-img">
                            <?php if($blog['image'] !== NULL && $blog['image'] !== ''): ?>
                            <?php if($blog->slug != NULL): ?>
                            <a href="<?php echo e(route('blog.detail', ['id' => $blog->id, 'slug' => $blog->slug ])); ?>">
                                <?php else: ?>
                                <a
                                    href="<?php echo e(route('blog.detail', ['id' => $blog->id, 'slug' => str_slug(str_replace('-','&',$blog->heading)) ])); ?>">
                                    <?php endif; ?>

                                    <img data-src="<?php echo e(asset('images/blog/'.$blog['image'])); ?>" alt="course"
                                        class="img-fluid owl-lazy">
                                </a>
                                <?php else: ?>
                                <?php if($blog->slug != NULL): ?>
                                <a href="<?php echo e(route('blog.detail', ['id' => $blog->id, 'slug' => $blog->slug ])); ?>">
                                    <?php else: ?>
                                    <a
                                        href="<?php echo e(route('blog.detail', ['id' => $blog->id, 'slug' => str_slug(str_replace('-','&',$blog->heading)) ])); ?>">
                                        <?php endif; ?>
                                        <img data-src="<?php echo e(Avatar::create($blog->heading)->toBase64()); ?>" alt="course"
                                            class="img-fluid owl-lazy">
                                    </a>
                                    <?php endif; ?>
                        </div>
                        <div class="view-user-img">

                            <?php if(optional($blog->user)['user_img'] !== NULL && optional($blog->user)['user_img'] !== ''): ?>
                            <a href="<?php echo e(route('all/profile',$blog->user->id)); ?>" title=""><img src="<?php echo e(asset('images/user_img/'.$blog->user['user_img'])); ?>"
                                    class="img-fluid user-img-one" alt=""></a>
                            <?php else: ?>
                            <a href="<?php echo e(route('all/profile',$blog->user->id)); ?>" title=""><img src="<?php echo e(asset('images/default/user.png')); ?>"
                                    class="img-fluid user-img-one" alt=""></a>
                            <?php endif; ?>


                        </div>
                        <div class="tooltip">
                            <div class="tooltip-icon">
                                <i data-feather="share-2"></i>
                            </div>
                            <span class="tooltiptext">
                                <div class="instructor-home-social-icon">
                                    <ul>
                                        <li><a href="<?php echo e($blog->user->fb_url); ?>"><i data-feather="facebook"></i></a></li>
                                        <li><a href="<?php echo e($blog->user->twitter_url); ?>"><i data-feather="twitter"></i></a></li>
                                        <li><a href="<?php echo e($blog->user->youtube_url); ?>"><i data-feather="youtube"></i></a></li>
                                        <li><a href="<?php echo e($blog->user->linkedin_url); ?>"><i data-feather="linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </span>
                        </div> 
                        <div class="view-dtl">
                            <div class="view-heading">
                                <?php if($blog->slug != NULL): ?>
                                <a href="<?php echo e(route('blog.detail', ['id' => $blog->id, 'slug' => $blog->slug ])); ?>">
                                    <?php echo e(str_limit($blog['heading'], $limit = 25, $end = '...')); ?>

                                    <?php else: ?>
                                    <a
                                        href="<?php echo e(route('blog.detail', ['id' => $blog->id, 'slug' => str_slug(str_replace('-','&',$blog->heading)) ])); ?>">

                                        <?php echo e(str_limit($blog['heading'], $limit = 25, $end = '...')); ?>

                                        <?php endif; ?>
                                    </a>
                            </div>
                            <div class="user-name">
                                <h6>By <span><a href="<?php echo e(route('all/profile',$blog->user->id)); ?>"> <?php echo e(optional($blog->user)['fname']); ?></a></span></h6>
                            </div>
                            <div class="view-footer">
                                
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-date">
                                            <a href="#"><i data-feather="calendar"></i>
                                                <?php echo e(date('d-m-Y',strtotime($blog['created_at']))); ?></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-time">
                                            <a href="#"><i data-feather="clock"></i>
                                                <?php echo e(date('h:i:s A',strtotime($blog['created_at']))); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="prime-next-item-description-block-8<?php echo e($blog->id); ?>" class="prime-description-block">
                    <div class="prime-description-under-block">
                        <div class="prime-description-under-block">
                            <h5 class="description-heading"><?php echo e($blog['heading']); ?></h5>
                            <div class="row btm-20">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                    <div class="view-date">
                                        <a href="#"><i data-feather="calendar"></i> <?php echo e(date('d-m-Y',strtotime($blog['start_time']))); ?></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                    <div class="view-time">
                                        <a href="#"><i data-feather="clock"></i> <?php echo e(date('h:i:s A',strtotime($blog['start_time']))); ?></a>
                                    </div>
                                </div>
                            </div>
                            <div class="main-des">
                                <p><?php echo e(substr(preg_replace("/\r\n|\r|\n/",'',strip_tags(html_entity_decode($blog->detail))), 0, 400)); ?>

                                </p>
                            </div>
                            <div class="des-btn-block">
                                <div class="row">
                                    <div class="col-lg-12">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </div>
</section>
<?php endif; ?>
<!-- Bundle end -->
<!-- recommendations start -->
<?php if($hsetting->became_enable == 1): ?>
<section id="border-recommendation" class="border-recommendation">
    <?php
        $gets = App\JoinInstructor::first();
    ?>
    <?php if(isset($gets)): ?> 
    <!-- <div class="top-border"></div> -->
    <div class="recommendation-main-block  text-center">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-lg-4 col-sm-5">
                    <div class="recommendations-block">
                        <h4 class="recommendations-heading"> <?php echo e($gets->text); ?></h4>
                        <p><?php echo e($gets->detail); ?></p>
                        <div class="recommendation-btn">
                            <a href=""  data-toggle="modal" data-target="#myModalinstructor" class="btn btn-primary" title="Become an Instructor"><?php echo e(__('Become an Instructor')); ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-7">
                    <div id="recommendations-slider" class="recommendations-main-slider owl-carousel">
                        <div class="item">
                            <div class="recommendations-img">
                                <?php if($gets['img'] !== NULL && $gets['img'] !== ''): ?>
                                    <img src="<?php echo e(url('/images/joininstructor/'.$gets->img)); ?>" height="100px;" width="100px;" />
                                    <?php else: ?>
                                    <img src="<?php echo e(Avatar::create($gets->text)->toBase64()); ?>" alt="course"
                                        class="img-fluid">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</section>
<?php endif; ?>
<!-- recommendations end -->
<!-- categories start -->
<?php if($hsetting->featuredcategories_enable == 1 && !$category->isEmpty()): ?>
<section id="categories" class="categories-main-block">
    <div class="container-xl">
        <?php if( count($category->where('featured', '1')) > 0): ?>

        <h3 class="categories-heading"><?php echo e(__('Featured Categories')); ?></h3>
        <div class="row">
            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($t->status == 1 && $t->featured == 1): ?>

            <div class="col-lg-2 col-md-4 col-sm-4 col-6">

                <div class="cat-container btm-20 text-center">
                    <a href="<?php echo e(route('category.page',['id' => $t->id, 'category' => str_slug(str_replace('-','&',$t->slug))])); ?>">
                        <div class="cat-img">
                            <?php if($t['cat_image'] == !NULL): ?>
                                <img src="<?php echo e(asset('images/category/'.$t['cat_image'])); ?>">
                            <?php else: ?>
                                <img src="<?php echo e(Avatar::create($t->title)->toBase64()); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="cat-dtl">
                            <div>
                                <span>
                                    <h5 class="cat-name"><i class="fa <?php echo e($t['icon']); ?> mr-2"></i><?php echo e($t['title']); ?></h5>
                                    <div class="cat-img-count"><?php echo e($t->courses->count()); ?> <?php echo e(__('Courses')); ?></div>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <?php endif; ?>
    </div>
</section>
<?php endif; ?>
<!-- categories end -->
<!-- testimonial start -->
<?php if($hsetting->testimonial_enable == 1 && ! $testi->isEmpty() ): ?>
<section id="testimonial" class="testimonial-main-block">
    <div class="container-xl">
        <h4><?php echo e(__('Testimonial')); ?></h4>
        <div id="testimonial-slider" class="testimonial-slider-main-block owl-carousel">
            <?php $__currentLoopData = $testi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item testi-block text-center">
                <div class="testi-block-images">
                    <img src="<?php echo e(url('images/testimonial/testimonial.png')); ?>" class="img-fluid" alt=""> 
                </div>
                <div class="testi-block-one">
                    <div class="testi-img text-center">
                        <img data-src="<?php echo e(asset('images/testimonial/'.$tes['image'])); ?>" alt="blog" class="img-fluid owl-lazy">
                    </div>
                    <div class="testi-dtl text-center">
                        <div class="testi-name">
                            <h5 class="testi-heading mb-1"><?php echo e($tes['client_name']); ?></h5>
                            <p class="testi-para p-0"><?php echo e($tes['designation']); ?></p>
                        </div>
                        <div class="testi-rating mb-2">
                            <?php for($i = 1; $i <= 5; $i++): ?> <?php if($i<=$tes->rating): ?>
                                <i class='fa fa-star' style='color:orange'></i>
                                <?php else: ?>
                                <i class='fa fa-star' style='color:#ccc'></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                        <p><?php echo e(str_limit(preg_replace("/\r\n|\r|\n/",'',strip_tags(html_entity_decode($tes->details))) , $limit = 300, $end = '...')); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php if($hsetting->service_enable == 1 && ! $services->isEmpty() && isset($servicesetting) ): ?>
<section id="services" class="services-main-block">
    <div class="container-xl">
        <h4><?php echo e(__('Our Service')); ?></h4>
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="service-side-img">
                    <?php if($servicesetting['image'] == !NULL): ?>
                    <img src="<?php echo e(asset('images/services/'.$servicesetting['image'])); ?>" class="img-fluid" alt="">
                    <?php else: ?>
                    <img src="<?php echo e(Avatar::create($servicesetting->title)->toBase64()); ?>" class="img-fluid" alt="">
                    <?php endif; ?>
                    <div class="overlay-bg"></div>
                </div>
                <div class="service-side-dtl text-center">
                    <h3 class="service-heading mb-4"><?php echo e($servicesetting->title); ?></h3>
                    <p class="mb-4"><?php echo e(str_limit(preg_replace("/\r\n|\r|\n/",'',strip_tags(html_entity_decode($servicesetting->detail))) , $limit = 300, $end = '...')); ?></p>
                    <a href="<?php echo e(route('front.service')); ?>" type="button" class="btn btn-primary mt-2" title="View More"><?php echo e(__('View More')); ?> <i data-feather="chevrons-right"></i></a>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="row">
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-block">
                            <div class="service-img text-center">
                                <?php if($ser['image'] == !NULL): ?>
                                    <img src="<?php echo e(asset('images/services/'.$ser['image'])); ?>" class="img-fluid" alt="">
                                <?php else: ?>
                                    <img src="<?php echo e(Avatar::create($ser->title)->toBase64()); ?>" class="img-fluid" alt="">
                                <?php endif; ?>
                            </div>
                            <div class="service-dtl text-center">
                                <h5 class="service-heading mb-2"><?php echo e($ser->title); ?></h5>
                                <p><?php echo e(str_limit(preg_replace("/\r\n|\r|\n/",'',strip_tags(html_entity_decode($ser->detail))) , $limit = 80, $end = '...')); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- testimonial end -->
<!-- video start -->
<?php if($hsetting->video_enable == 1 &&  isset($videosetting) ): ?>
<section id="video" class="video-main-block">
    <div class="container-fluid p-0">
        <?php if($videosetting['image'] !== NULL && $videosetting['image'] !== ''): ?>
        <div class="video-block parallax" style="background-image: url(<?php echo e('images/videosetting/'.$videosetting->image); ?>);">
        <?php else: ?>
        <div class="video-block parallax" style="background-image: url(<?php echo e(Avatar::create($videosetting->tittle)->toBase64()); ?>);">
        <?php endif; ?>
            <div class="overlay-bg"></div>
        </div>
        <div class="video-play-btn">
            <a class="play-btn" href="#video_modal" data-toggle="modal"></a>
            <div id="video_modal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe id="elearningVideo" class="embed-responsive-item" width="560" height="315" src="<?php echo e($videosetting->url); ?>" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="video-dtl text-center">
            <h3 class="video-heading text-white"><?php echo e($videosetting->tittle); ?></h3>
            <p class="text-white"><?php echo e($videosetting->description); ?></p>
        </div>
    </div>
</section>  
<?php endif; ?>
<!-- video end -->

<!-- instructor start -->
<?php if($hsetting->instructor_enable == 1 && !$instructors->isEmpty()): ?>
<section id="instructor-home" class="instructor-home-main-block">
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-7">
                <h4 class="student-heading"><?php echo e(__('Instructor')); ?></h4>
            </div>
            <div class="col-lg-6 col-md-6 col-5">
                <div class="instructor-button txt-rgt">
                    <a href="<?php echo e(route('allinstructor/view')); ?>" class="btn btn-secondary" title="All Instructor"><?php echo e(__('All Instructor')); ?><i data-feather="chevrons-right"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div id="instructor-home-slider" class="instructor-home-main-slider owl-carousel">
            <?php $__currentLoopData = $instructors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <div class="item">
                <div class="instructor-home-block text-center">
                    <div class="instructor-home-block-one">
                        <?php if($inst['user_img'] !== NULL && $inst['user_img'] !== ''): ?>
                        <a href="<?php echo e(route('allinstructor/profile',$inst->id)); ?>" title=""><img src="<?php echo e(url('/images/user_img/'.$inst->user_img)); ?>"  class="img-fluid" /></a>
                        <?php else: ?>
                        <a href="<?php echo e(route('allinstructor/profile',$inst->id)); ?>" title=""><img src="<?php echo e(Avatar::create($inst->fname)->toBase64()); ?>" alt="course"
                            class="img-fluid"></a>
                        <?php endif; ?>
                        <div class="instructor-home-hover-icon">
                            <ul>
                                <li>
                                    <div class="tooltip">
                                        <div class="tooltip-icon">
                                            <i data-feather="share-2"></i>
                                        </div>
                                        <span class="tooltiptext">
                                            <div class="instructor-home-social-icon">
                                                <ul>
                                                   <?php
                                                    $url = URL::to('/').'/allinstructor/profile/'.$inst->id;
                                                   ?>
                                                   <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo e($url); ?>&title=Default+share+text&summary=" target="_blank"><b><i class="fa fa-linkedin" aria-hidden="true"></i></b></a></li>
                                                   <li><a href="https://www.facebook.com/sharer/sharer.php?&url=<?php echo e($url); ?>" target="_blank"><b><i class="fa fa-facebook-square" aria-hidden="true"></i></b></a></li>
                                                   <li><a href="https://twitter.com/intent/tweet?text=Default+share+text&url=<?php echo e($url); ?>" target="_blank"><b><i class="fa fa-twitter" aria-hidden="true"></i></b></a></li>
                                                   <li><a href="https://telegram.me/share/url?url=<?php echo e($url); ?>&text=Default+share+text" target="_blank"><b><i class="fa fa-telegram" aria-hidden="true"></i></b></a></li>
                                                   <li><a href="https://wa.me/?text=<?php echo e($url); ?>" target="_blank"><b><i class="fa fa-whatsapp" aria-hidden="true"></i></b></a></li>
                                                </ul>
                                            </div>
                                        </span>
                                    </div>
                                </li> 
                                <li>
                                    <div class="instructor-home-btn">
                                        <a href="<?php echo e(route('allinstructor/profile',$inst->id)); ?>" class="btn btn-primary" title="View Profile"><i data-feather="eye"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </div>  
                        <div class="instructor-home-dtl">
                            <h4 class="instructor-home-heading"><a href="<?php echo e(route('allinstructor/profile',$inst->id)); ?>" title=""><?php echo e($inst->fname); ?> <?php echo e($inst->lname); ?></a></h4>
                            <p><?php echo e($inst->role); ?></p>
                        
                            <?php

                            $followers = App\Followers::where('user_id', '!=', $inst->id)->where('follower_id', $inst->id)->count();

                            $followings = App\Followers::where('user_id', $inst->id)->where('follower_id','!=', $inst->id)->count();
                            $course = App\Course::where('user_id', $inst->id)->count();

                            ?>
                            <div class="instructor-home-info">
                                <ul>
                                    <?php if($course > 0): ?>
                                    <li><?php echo e($course); ?> <?php echo e(__('Courses')); ?></li>
                                    <?php else: ?>
                                    <li><?php echo e(__('No Courses')); ?></li>
                                    <?php endif; ?>                                    <li><?php echo e($followers); ?> <?php echo e(__('Follower')); ?></li>
                                    <li><?php echo e($followings); ?> <?php echo e(__('Following')); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
</section>
<?php endif; ?>
<?php if($hsetting->get_enable == 1 && isset($get_enable)): ?>
<section id="get-started" class="get-started-main-block">
    <div class="container-fluid p-0">
        <div class="get-started-block">
            <?php if($get_enable['image'] !== NULL && $get_enable['image'] !== ''): ?>
            <div class="get-started-bg-image parallax" style="background-image: url(<?php echo e('images/getstarted/'.$get_enable->image); ?>);">
            <?php else: ?>
            <div class="get-started-bg-image parallax" style="background-image: url(<?php echo e(Avatar::create($get_enable->heading)->toBase64()); ?>);">
            <?php endif; ?> 
                <div class="overlay-bg"></div>
            </div>
            <div class="get-started-dtl text-center">
                <h1 class="get-started-title text-white mb-2 text-center"><?php echo e($get_enable->heading); ?></h1>
                <h4 class="get-started-sub-title text-white text-center"><?php echo e($get_enable->sub_heading); ?></h4>
                <a href="<?php echo e($get_enable->link); ?>" type="button" class="btn btn-primary"><?php echo e($get_enable->button_txt); ?></a>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php if($hsetting->institute_enable == 1 && !$institute->isEmpty()): ?>
<section id="instructor-home" class="instructor-home-main-block">
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-7">
                <h4 class="student-heading"><?php echo e(__('Institute')); ?></h4>
            </div>
            <div class="col-lg-6 col-md-6 col-5">
                <div class="instructor-button txt-rgt">
                    
                    
                </div>
            </div>
        </div>
        <div id="institute-home-slider" class="instructor-home-main-slider owl-carousel">
            <?php $__currentLoopData = $institute; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <div class="item">
                <div class="instructor-home-block text-center">
                    <div class="instructor-home-block-one">
                        <?php if($inst['image'] !== NULL && $inst['image'] !== ''): ?>
                        <a href="<?php echo e(route('ins.sluging',['id' => $inst->id, 'slug' => $inst->slug ])); ?>" title=""><img src="<?php echo e(url('/files/institute/'.$inst->image)); ?>"  class="img-fluid" /></a>
                        <?php else: ?>
                        <a href="<?php echo e(route('ins.sluging',['id' => $inst->id, 'slug' => $inst->slug ])); ?>" title=""><img src="<?php echo e(Avatar::create($inst->fname)->toBase64()); ?>" alt="course"
                            class="img-fluid"></a>
                        <?php endif; ?>
                        <div class="instructor-home-hover-icon">
                            <ul>
                                <li>
                                    <div class="instructor-home-btn">
                                        <a href="<?php echo e(route('ins.sluging',['id' => $inst->id, 'slug' => $inst->slug ])); ?>" class="btn btn-primary" title="View Page"><i data-feather="eye"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </div>  
                        <div class="instructor-home-dtl">
                            <h4 class="instructor-home-heading"><a href="<?php echo e(route('ins.sluging',['id' => $inst->id, 'slug' => $inst->slug ])); ?>" title=""><?php echo e($inst->title); ?> </a></h4>
                            <p><?php echo e($inst->email); ?></p>
                            <p><?php echo e($inst->phone); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- instructor end -->
<?php if($hsetting->feature_enable == 1 && ! $feature->isEmpty() && isset($featuresetting) ): ?>
<section id="feature" class="feature-main-block">
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-7 col-md-7">
                <div class="feature-block">
                    <h4 class="feature-title"><?php echo e($featuresetting->title); ?></h4>
                    <p><?php echo e($featuresetting->detail); ?></p>
                </div>
                <div class="feature-dtl-block">
                    <div class="row">
                        <?php $__currentLoopData = $feature; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-6 col-md-6 mb-4">
                            <div class="feature-dtl-icon">
                                <?php if($data['image'] == !NULL): ?>
                                    <img src="<?php echo e(asset('images/feature/'.$data['image'])); ?>" class="img-fluid" alt="">
                                <?php else: ?>
                                    <img src="<?php echo e(Avatar::create($data->title)->toBase64()); ?>" class="img-fluid" alt="">
                                <?php endif; ?>  
                            </div>    
                            <div class="feature-dtl">
                                <h5 class="feature-dtl-title mb-2"><?php echo e($data->title); ?></h5>
                                <p><?php echo e(str_limit(preg_replace("/\r\n|\r|\n/",'',strip_tags(html_entity_decode($data->detail))) , $limit = 300, $end = '...')); ?></p>                       
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <a href="<?php echo e(route('front.feature')); ?>" type="button" class="btn btn-primary" title="View More"><?php echo e(__('View More')); ?> <i data-feather="chevrons-right"></i></a>
                </div>
            </div>
            <div class="col-lg-5 col-md-5">
                <div class="feature-image">
                    <?php if($featuresetting['image'] == !NULL): ?>
                    <img src="<?php echo e(asset('images/feature/'.$featuresetting['image'])); ?>" class="img-fluid" alt="">
                <?php else: ?>
                    <img src="<?php echo e(Avatar::create($featuresetting->title)->toBase64()); ?>" class="img-fluid" alt="">
                <?php endif; ?>                  
            </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- Advertisement -->
<?php if(isset($advs)): ?>
<?php $__currentLoopData = $advs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($adv->position == 'belowtestimonial'): ?>
<br>
<section id="student" class="student-main-block btm-40">
    <div class="container-xl">
        <a href="<?php echo e($adv->url1); ?>" title="<?php echo e(__('Click to visit')); ?>">
            <img class="lazy img-fluid advertisement-img-one" data-src="<?php echo e(url('images/advertisement/'.$adv->image1)); ?>"
                alt="<?php echo e($adv->image1); ?>">
        </a>
    </div>
</section>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php if($hsetting->trusted_enable == 1 && ! $trusted->isEmpty() ): ?>
<section id="trusted" class="trusted-main-block">
    <div class="container-xl">
        <div class="patners-block">

            <h6 class="patners-heading btm-40"><?php echo e(__('Trusted By Companies')); ?></h6>
            <div id="patners-slider" class="patners-slider owl-carousel">
                <?php $__currentLoopData = $trusted; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trust): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item-patners-img">
                    <a href="<?php echo e($trust['url']); ?>" target="_blank"><img
                            data-src="<?php echo e(asset('images/trusted/'.$trust['image'])); ?>" class="img-fluid owl-lazy"
                            alt="patners-1"></a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

</section>
<?php endif; ?>

<section id="trusted" class="trusted-main-block">
    <!-- google adsense code -->
    <div class="container-fluid" id="adsense">
        <?php
        $ad = App\Adsense::first();
        ?>
        <?php
            if (isset($ad) ) {
             if ($ad->ishome==1 && $ad->status==1) {
                $code = $ad->code;
                echo html_entity_decode($code);
             }
            }
        ?>
    </div>
</section>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>

    

<script>
    (function ($) {
        "use strict";
        $(function () {
            $("#home-tab").trigger("click");
        });
    })(jQuery);

    function showtab(id) {
        $.ajax({
            type: 'GET',
            url:'<?php echo e(url('/tabcontent')); ?>/' + id,
            dataType: 'json',
            success: function (data) {

                $('.btn_more').html(data.btn_view);
                $('#tabShow').html(data.tabview);

            }
        });
    }
</script>

<script src="<?php echo e(url('js/colorbox-script.js')); ?>"></script>


<script>
    "use Strict";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function () {
        $('.compare').on('click', function (e) {
            var id = $(this).data('id');
            $.ajax({
                type: "POST",
                dataType: "json",
                url: 'compare/dataput',
                data: {
                    id: id
                },
                success: function (data) {}
            });
        });
    });
</script>

<script>
    $(document).ready(function(){
        /* Get iframe src attribute value i.e. YouTube video url
        and store it in a variable */
        var url = $("#elearningVideo").attr('src');
        
        /* Assign empty url value to the iframe src attribute when
        modal hide, which stop the video playing */
        $("#video_modal").on('hide.bs.modal', function(){
            $("#elearningVideo").attr('src', '');
        });
        
        /* Assign the initially stored url back to the iframe src
        attribute when modal is displayed again */
        $("#video_modal").on('show.bs.modal', function(){
            $("#elearningVideo").attr('src', url);
        });
    });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('theme.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\eclass_5.4\resources\views/home.blade.php ENDPATH**/ ?>