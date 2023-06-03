<!-- google class room start -->
<section id="student" class="student-main-block">
    <div class="container">
        <?php
            $mytime = Carbon\Carbon::now();
        ?>
        <?php if( ! $googleclassrooms->isEmpty()): ?>
        <h4 class="student-heading"><?php echo e(__('Google Class Room')); ?></h4>
        <div id="googleclassroom-view-slider" class="student-view-slider-main-block owl-carousel">

            <?php if( ! $meetings->isEmpty() ): ?>
                <?php $__currentLoopData = $googleclassrooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $googleclassroom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item student-view-block student-view-block-1">
                        <div class="genre-slide-image <?php if($gsetting['course_hover'] == 1): ?> protip <?php endif; ?>" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block-6<?php echo e($meeting->id); ?>">
                            <div class="view-block">
                                <div class="view-img">
                                    <?php if($googleclassroom['image'] !== NULL && $googleclassroom['image'] !== ''): ?>
                                        <a href="<?php echo e(route('googleclassroom.detail', $googleclassroom->id)); ?>"><img data-src="<?php echo e(asset('images/googleclassroom/profile_image/'.$googleclassroom['image'])); ?>" alt="course" class="img-fluid owl-lazy"></a>
                                    <?php else: ?>
                                       <a href="<?php echo e(route('googleclassroom.detail', $googleclassroom->id)); ?>"><img data-src="<?php echo e(Avatar::create($meeting['meeting_title'])->toBase64()); ?>" alt="course" class="img-fluid owl-lazy"></a>
                                    <?php endif; ?>
                                </div>

                                <?php if(asset('images/googleclassroom_icons/googleclassroom1.png') == !NULL): ?>
                                <div class="meeting-icon"><img src="<?php echo e(asset('images/googleclassroom_icons/googleclassroom1.png')); ?>" class="img-circle" alt=""></div>
                                <?php endif; ?>

                                <div class="view-dtl">
                                    <div class="view-heading"><a href="#"><?php echo e(str_limit($googleclassroom->cource_title, $limit = 30, $end = '...')); ?></a></div>
                                    <div class="user-name">
                                        <h6>By <span><?php echo e(optional($googleclassroom->user)['fname']); ?></span></h6>
                                    </div>
                                    <div class="view-footer">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="view-date">
                                                    <a href="#"><i data-feather="calendar"></i>
                                                        <?php echo e(date('d-m-Y',strtotime($googleclassroom['start_time']))); ?></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="view-time">
                                                    <a href="#"><i data-feather="clock"></i>
                                                        <?php echo e(date('h:i:s A',strtotime($googleclassroom['start_time']))); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <div id="prime-next-item-description-block-6<?php echo e($meeting->id); ?>" class="prime-description-block">
                            <div class="prime-description-under-block">
                                <div class="prime-description-under-block">
                                    <h5 class="description-heading"><a href="<?php echo e(route('zoom.detail', $meeting->id)); ?>"><?php echo e($googleclassroom['cource_title']); ?></a></h5>
                                    <div class="protip-img">
                                        <h3 class="description-heading"><?php echo e(__('frontstaticword.by')); ?> <?php if(isset($meeting->user)): ?> <?php echo e($meeting->user['fname']); ?> <?php endif; ?></h>
                                        <p class="meeting-owner btm-10"><a herf="#"><?php echo e(__('Class Room Owner: ')); ?><?php echo e($googleclassroom->owner_id); ?></a></p>
                                    </div>
                                    <div class="main-des meeting-main-des">
                                        <div class="main-des-head">Start At: </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="view-date">
                                                    <a href="#"><i data-feather="calendar"></i> <?php echo e(date('d-m-Y',strtotime($googleclassroom['start_time']))); ?></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="view-time">
                                                    <a href="#"><i data-feather="clock"></i> <?php echo e(date('h:i:s A',strtotime($googleclassroom['start_time']))); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="des-btn-block">
                                        <a href="<?php echo e($googleclassroom->join_url); ?>" target="__blank" class="iframe btn btn-light"><?php echo e(__('Join Class')); ?></a>
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
<!-- google class room end --><?php /**PATH C:\laragon\www\eclass_5.4\Modules/Googleclassroom\Resources/views/frontend/home.blade.php ENDPATH**/ ?>