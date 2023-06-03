
<?php $__env->startSection('title','Edit Course'); ?>
<?php $__env->startSection('maincontent'); ?>
<?php
$data['heading'] = 'Course';
$data['title'] = 'Edit Course';
?>
<?php echo $__env->make('admin.layouts.topbar',$data, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="contentbar bardashboard-card ">
  <!-- Start row -->
  <div class="row">
    <!-- Start col -->
    <div class="col-lg-5 col-xl-3">
      <div class="card m-b-30">
        <div class="card-header">
          <h5 class="card-box">Courses</h5>
        </div>
        <div class="card-body">

          <?php
          $involvement = App\Involvement::firstWhere(['user_id' => Auth::user()->id,'course_id' => $cor->id]);

          ?>

          <?php if(isset($involvement)): ?>
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link mb-2 active" id="v-pills-CourseChapter-tab" data-toggle="pill" href="#v-pills-CourseChapter" role="tab" aria-controls="v-pills-CourseChapter" aria-selected="true"><i class="feather icon-grid mr-2"></i><?php echo e(__('CourseChapter')); ?></a>
            <a class="nav-link mb-2" id="v-pills-CourseClass-tab" data-toggle="pill" href="#v-pills-CourseClass" role="tab" aria-controls="v-pills-CourseClass" aria-selected="false"><i class="feather icon-package mr-2"></i><?php echo e(__('CourseClass')); ?></a>
          </div>
          <?php else: ?>
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

            <a class="nav-link mb-2 show active" data-toggle="pill" href="#v-pills-courseedit" role="tab" aria-selected="true"><i class="feather icon-grid mr-2"></i><?php echo e(__('Course')); ?></a>

            <a class="nav-link mb-2" id="v-pills-order-tab" data-toggle="pill" href="#v-pills-order" role="tab" aria-controls="v-pills-order" aria-selected="false"><i class="feather icon-book mr-2"></i><?php echo e(__('CourseInclude')); ?></a>

            <a class="nav-link mb-2" id="v-pills-addresses-tab" data-toggle="pill" href="#v-pills-addresses" role="tab" aria-controls="v-pills-addresses" aria-selected="false"><i class="feather icon-map-pin mr-2"></i><?php echo e(__('WhatLearns')); ?></a>

            <a class="nav-link mb-2" id="v-pills-wishlist-tab" data-toggle="pill" href="#v-pills-wishlist" role="tab" aria-controls="v-pills-wishlist" aria-selected="false"><i class="feather icon-book-open mr-2"></i><?php echo e(__('CourseChapter')); ?></a>

            <a class="nav-link mb-2" id="v-pills-wallet-tab" data-toggle="pill" href="#v-pills-wallet" role="tab" aria-controls="v-pills-wallet" aria-selected="true"><i class="feather icon-credit-card mr-2"></i><?php echo e(__('CourseClass')); ?></a>

            <a class="nav-link mb-2" id="v-pills-chat-tab" data-toggle="pill" href="#v-pills-chat" role="tab" aria-controls="v-pills-chat" aria-selected="false"><i class="feather icon-message-circle mr-2"></i><?php echo e(__('RelatedCourse')); ?></a>

            <a class="nav-link mb-2" id="v-pills-notifications-tab" data-toggle="pill" href="#v-pills-notifications" role="tab" aria-controls="v-pills-notifications" aria-selected="false"><i class="feather icon-bell mr-2"></i><?php echo e(__('Question')); ?></a>

            <a class="nav-link mb-2" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="feather icon-user mr-2"></i><?php echo e(__('ReviewRating')); ?></a>

            <a class="nav-link  mb-2" id="v-pills-logout-tab" data-toggle="pill" href="#v-pills-logout" role="tab" aria-controls="v-pills-logout" aria-selected="false"><i class="feather icon-speaker mr-2"></i><?php echo e(__('Announcement')); ?></a>

            <a class="nav-link  mb-2" id="v-pills-ReviewReport-tab" data-toggle="pill" href="#v-pills-ReviewReport" role="tab" aria-controls="v-pills-ReviewReport" aria-selected="false"><i class="feather icon-file-text mr-2"></i><?php echo e(__('ReviewReport')); ?></a>

            <a class="nav-link  mb-2" id="v-pills-QuizTopic-tab" data-toggle="pill" href="#v-pills-QuizTopic" role="tab" aria-controls="v-pills-QuizTopic" aria-selected="false"><i class="feather icon-log-out mr-2"></i><?php echo e(__('QuizTopic')); ?></a>

            <?php if($gsetting->appointment_enable == 1): ?>
            <a class="nav-link" id="v-pills-Appointment-tab3" data-toggle="pill" href="#v-pills-Appointment" role="tab" aria-controls="v-pills-Appointment" aria-selected="false"><i class="feather icon-plus mr-2"></i><?php echo e(__('Appointment')); ?></a>
            <?php endif; ?>

            <a class="nav-link" id="v-pills-PreviousPaper-tab4" data-toggle="pill" href="#v-pills-PreviousPaper" role="tab" aria-controls="v-pills-PreviousPaper" aria-selected="false"><i class="feather icon-file mr-2"></i><?php echo e(__('PreviousPaper')); ?></a>
            <?php endif; ?>

          </div>
        </div>
      </div>
    </div>
    <!-- End col -->
    <!-- Start col -->
    <div class="col-lg-7 col-xl-9">
      <div class="tab-content" id="v-pills-tabContent">
        <?php if(isset($involvement)): ?>
        <div class="tab-pane fade show active" id="v-pills-CourseChapter">
          <?php echo $__env->make('admin.course.coursechapter.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="tab-pane fade" id="v-pills-CourseClass" role="tabpanel" aria-labelledby="v-pills-CourseClass-tab">
          <?php echo $__env->make('admin.course.courseclass.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <?php else: ?>
        <div class="tab-pane fade show active" id="v-pills-courseedit" role="tabpanel">
          <?php echo $__env->make('admin.course.editcor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div class="tab-pane fade" id="v-pills-order" role="tabpanel" aria-labelledby="v-pills-order-tab">
          <?php echo $__env->make('admin.course.courseinclude.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <!-- My Orders End -->
        <!-- My Addresses Start -->
        <div class="tab-pane fade" id="v-pills-addresses" role="tabpanel" aria-labelledby="v-pills-addresses-tab">
          <?php echo $__env->make('admin.course.whatlearns.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <!-- My Addresses End -->
        <!-- My Wishlist Start -->
        <div class="tab-pane fade" id="v-pills-wishlist" role="tabpanel" aria-labelledby="v-pills-wishlist-tab">
          <?php echo $__env->make('admin.course.coursechapter.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <!-- My Wishlist End -->
        <!-- My Wallet Start -->
        <div class="tab-pane fade" id="v-pills-wallet" role="tabpanel" aria-labelledby="v-pills-wallet-tab">
          <?php echo $__env->make('admin.course.courseclass.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <!-- My Wallet End -->
        <!-- My Chat Start -->
        <div class="tab-pane fade" id="v-pills-chat" role="tabpanel" aria-labelledby="v-pills-chat-tab">
          <?php echo $__env->make('admin.course.relatedcourse.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <!-- My Chat End -->
        <!-- My Notifications Start -->
        <div class="tab-pane fade" id="v-pills-notifications" role="tabpanel" aria-labelledby="v-pills-notifications-tab">
          <?php echo $__env->make('admin.course.questionanswer.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <!-- My Notifications End -->
        <!-- My Profile Start -->
        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
          <?php echo $__env->make('admin.course.reviewrating.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div class="tab-pane fade" id="v-pills-logout" role="tabpanel" aria-labelledby="v-pills-logout-tab">
          <?php echo $__env->make('admin.course.announsment.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="tab-pane fade" id="v-pills-ReviewReport" role="tabpanel" aria-labelledby="v-pills-ReviewReport-tab">
          <?php echo $__env->make('admin.course.reviewreport.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="tab-pane fade" id="v-pills-QuizTopic" role="tabpanel" aria-labelledby="v-pills-QuizTopic-tab">
          <?php echo $__env->make('admin.course.quiztopic.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div class="tab-pane fade" id="v-pills-Appointment" role="tabpanel" aria-labelledby="v-pills-Appointment-tab3">
          <?php echo $__env->make('admin.course.appointment.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div class="tab-pane fade" id="v-pills-PreviousPaper" role="tabpanel" aria-labelledby="v-pills-PreviousPaper-tab4">
          <?php echo $__env->make('admin.course.previous_paper.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
    <!-- End col -->
  </div>
  <!-- End row -->
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\eclass_5.4\resources\views/admin/course/show.blade.php ENDPATH**/ ?>