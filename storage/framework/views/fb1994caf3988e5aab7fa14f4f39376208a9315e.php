<div class="row">
  <div class="col-lg-12">
    <?php if($errors->any()): ?>
    <div class="alert alert-danger">
      <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>
    <?php endif; ?>
    <div class="card m-b-30">
      <div class="card-header">
        <h5 class="card-box"><?php echo e(__('Edit')); ?> <?php echo e(__('Course')); ?></h5>
      </div>
      <div class="card-body ml-2">
        <form action="<?php echo e(route('course.update',$cor->id)); ?>" method="post" enctype="multipart/form-data">
          <?php echo e(csrf_field()); ?>

          <?php echo e(method_field('PUT')); ?>


          <div class="row">
            <div class="col-md-3">
              <label><?php echo e(__('Category')); ?><span class="redstar">*</span></label>
              <select name="category_id" id="category_id" class="form-control js-example-basic-single" required>
                <option value="0"><?php echo e(__('SelectanOption')); ?></option>
                <?php
                $category = App\Categories::all();
                ?>

                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $caat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php echo e($cor->category_id == $caat->id ? 'selected' : ""); ?> value="<?php echo e($caat->id); ?>"><?php echo e($caat->title); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
            <div class="col-md-3">
              <label><?php echo e(__('SubCategory')); ?>:<span class="redstar">*</span></label>
              <select name="subcategory_id" id="upload_id" class="form-control js-example-basic-single">
                <?php
                $subcategory =App\SubCategory::where('category_id', $cor->category_id)->get();
                ?>
                <option value="none" selected disabled hidden>
                  <?php echo e(__('SelectanOption')); ?>

                </option>
                <?php if(!empty($subcategory)): ?>
                <?php $__currentLoopData = $subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $caat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php echo e($cor->subcategory_id == $caat->id ? 'selected' : ""); ?> value="<?php echo e($caat->id); ?>"><?php echo e($caat->title); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
              </select>
            </div>
            <div class="col-md-3">
              <label><?php echo e(__('ChildCategory')); ?>:</label>
              <select name="childcategory_id" id="grand" class="form-control js-example-basic-single">
                <?php
                $childcategory = App\ChildCategory::where('subcategory_id', $cor->subcategory_id)->get();
                ?>
                <option value="none" selected disabled hidden>
                  <?php echo e(__('SelectanOption')); ?>

                </option>
                <?php if(!empty($childcategory)): ?>
                <?php $__currentLoopData = $childcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $caat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php echo e($cor->childcategory_id == $caat->id ? 'selected' : ""); ?> value="<?php echo e($caat->id); ?>"><?php echo e($caat->title); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
              </select>
            </div>
            <div class="col-md-3">
              <label for="exampleInputSlug"><?php echo e(__('SelectUser')); ?></label>
              <select name="user_id" class="form-control js-example-basic-single col-md-7 col-xs-12">
                <?php if(Auth::user()->role == 'admin'): ?>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php echo e($cor->user_id == $user->id ? 'selected' : ""); ?> value="<?php echo e($user->id); ?>"><?php echo e($user->fname); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                <option value="<?php echo e(Auth::user()->id); ?>"><?php echo e(Auth::user()->fname); ?></option>
                <?php endif; ?>
              </select>
            </div>
          </div>
          <br>

          <?php
          $category = App\Categories::all();
          ?>


          <div class="col-md-12">
            <div class="form-group">
              <label><?php echo e(__("Also in :")); ?></label>
              <select multiple="multiple" name="other_cats[]" id="other_cats" class="form-control select2">
                <?php
                $category = App\Categories::all();
                ?>

                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $caat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($caat->id); ?>"><?php echo e($caat->title); ?></option>
                <!-- <option <?php echo e($cor->category_id == $caat->id ? 'selected' : ""); ?> value="<?php echo e($caat->id); ?>"><?php echo e($caat->title); ?></option> -->
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>

              <small class="text-primary">
                <i class="feather icon-help-circle"></i> <?php echo e(__("If in list primary category is also present then it will auto remove from this after create product.")); ?>

              </small>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <?php
              $languages = App\CourseLanguage::all();
              ?>
              <label for="exampleInputSlug"><?php echo e(__('SelectLanguage')); ?>: <span class="redstar">*</span></label>
              <select name="language_id" class="form-control js-example-basic-single col-md-7 col-xs-12">
                <option value="none" selected disabled hidden>
                  <?php echo e(__('SelectanOption')); ?>

                </option>
                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php echo e($cor->language_id == $cat->id ? 'selected' : ""); ?> value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>


            <div class="col-md-4">

              <?php
              $ref_policy = App\RefundPolicy::all();
              ?>
              <label for="exampleInputSlug"><?php echo e(__('SelectRefundPolicy')); ?></label>
              <select name="refund_policy_id" class="form-control js-example-basic-single col-md-7 col-xs-12">
                <option value="none" selected disabled hidden>
                  <?php echo e(__('SelectanOption')); ?>

                </option>
                <?php $__currentLoopData = $ref_policy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ref): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php echo e($cor->refund_policy_id == $ref->id ? 'selected' : ""); ?> value="<?php echo e($ref->id); ?>"><?php echo e($ref->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>

            <?php if(Auth::User()->role == "admin"): ?>
            <div class="col-md-4">
              <label><?php echo e(__('Institute')); ?>: <span class="redstar">*</span></label>
              <select name="institude_id" class="form-control select2">
                <?php
                $institute = App\Institute::all();
                ?>
                <option value="0" disabled hidden>
                  <?php echo e(__('SelectanOption')); ?>

                </option>
                <?php $__currentLoopData = $institute; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($inst->id); ?>" <?php echo e($inst->id  == $cor->institude_id ? 'selected' : ''); ?>><?php echo e($inst->title); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
            <?php endif; ?>
            <?php if(Auth::User()->role == "instructor"): ?>
            <div class="col-md-4">
              <label><?php echo e(__('Institute')); ?>: <span class="redstar">*</span></label>
              <select name="institude_id" class="form-control select2">
                <?php
                $institute = App\Institute::where('user_id',Auth::user()->id)->get();
                ?>
                <option value="0" disabled hidden>
                  <?php echo e(__('SelectanOption')); ?>

                </option>
                <?php $__currentLoopData = $institute; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($inst->id); ?>" <?php echo e($inst->id  == $cor->institude_id ? 'selected' : ''); ?>><?php echo e($inst->title); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
            <?php endif; ?>
          </div>


          <div class="row">

            <div class="col-md-6">
              <label for="exampleInputTit1e"><?php echo e(__('Title')); ?>:<sup class="redstar">*</sup></label>
              <input type="text" class="form-control" name="title" id="exampleInputTitle" value="<?php echo e($cor->title); ?>">
            </div>

            <div class="col-md-6">
              <label for="exampleInputSlug"><?php echo e(__('Slug')); ?>: <sup class="redstar">*</sup></label>
              <input pattern="[/^\S*$/]+" type="text" class="form-control" name="slug" value="<?php echo e($cor->slug); ?>" required>
            </div>
          </div>
          <br>

          <div class="row">
            <div class="col-md-6">
              <label for="exampleInputDetails"><?php echo e(__('ShortDetail')); ?>:<sup class="redstar">*</sup></label>
              <textarea name="short_detail" rows="3" class="form-control"><?php echo $cor->short_detail; ?></textarea>
            </div>
            <div class="col-md-6">
              <label for="exampleInputDetails"><?php echo e(__('Requirements')); ?>:<sup class="redstar">*</sup></label>
              <textarea name="requirement" rows="3" class="form-control" required><?php echo $cor->requirement; ?></textarea>
            </div>
          </div>
          <br>


          <br>
          <?php if(Auth::User()->role == "admin"): ?>

          <div class="row">
            <div class="col-md-6">
              <label for="exampleInputSlug"><?php echo e(__('Level/Type Tags')); ?></label>
              <select class="form-control js-example-basic-single" name="level_tags">
                <option value="0" disabled hidden>
                  <?php echo e(__('SelectanOption')); ?>

                </option>

                <option <?php echo e($cor->level_tags == 'trending' ? 'selected' : ''); ?> value="trending"><?php echo e(__('Trending')); ?></option>

                <option <?php echo e($cor->level_tags == 'onsale' ? 'selected' : ''); ?> value="onsale"><?php echo e(__('Onsale')); ?></option>

                <option <?php echo e($cor->level_tags == 'bestseller' ? 'selected' : ''); ?> value="bestseller"><?php echo e(__('Bestseller')); ?></option>

                <option <?php echo e($cor->level_tags == 'beginner' ? 'selected' : ''); ?> value="beginner"><?php echo e(__('Beginner')); ?></option>

                <option <?php echo e($cor->level_tags == 'intermediate' ? 'selected' : ''); ?> value="intermediate"><?php echo e(__('Intermediate')); ?></option>

                <option <?php echo e($cor->level_tags == 'expert' ? 'selected' : ''); ?> value="expert"><?php echo e(__('Expert')); ?></option>

              </select>

            </div>




            <div class="col-md-6">
              <label for="exampleInputSlug"><?php echo e(__('CourseTags')); ?></label>
              <select class="select2-multi-select form-control" name="course_tags[]" multiple="multiple" size="5">


                <?php if(is_array($cor['course_tags']) || is_object($cor['course_tags'])): ?>

                <?php $__currentLoopData = $cor['course_tags']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <option value="<?php echo e($cat); ?>" <?php echo e(in_array($cat, $cor['course_tags'] ?: []) ? "selected": ""); ?>><?php echo e($cat); ?>

                </option>


                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

              </select>
            </div>

          </div>
          <br>
          <br>

          <?php endif; ?>



          <div class="row">
            <div class="col-md-12">
              <label for="exampleInputDetails"><?php echo e(__('Detail')); ?>:<sup class="redstar">*</sup></label>
              <textarea id="detail" name="detail" rows="3" class="form-control"><?php echo $cor->detail; ?></textarea>
            </div>
          </div>
          <br>


          <!-- country start -->
          <div class="row">
            <div class="col-md-12">

              <label><?php echo e(__('Country')); ?>: <span></span></label>
              <select class="select2-multi-select form-control" name="country[]" multiple="multiple">
                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php echo e(in_array($country->name, $cor->country ?: []) ? "selected": ""); ?> value="<?php echo e($country->name); ?>"><?php echo e($country->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>

              <small class="text-info"><i class="fa fa-question-circle"></i> (<?php echo e(__('Select those countries where you want to block courses')); ?> )</small>

            </div>
          </div>
          <br>
          <!-- country end -->

          <div class="row">
            
          <div class="col-md-3">
            <label for="exampleInputDetails"><?php echo e(__('Paid')); ?>:</label><br>
            <label class="switch">
              <input class="slider" type="checkbox" id="customSwitch2" name="type" <?php echo e($cor->type == '1' ? 'checked' : ''); ?> />
              <span class="knob"></span>
            </label>

            <br>

            <div style="<?php echo e($cor->type == 1 ? '' : 'display:none'); ?>" id="doabox">
              <label for="exampleInputSlug"><?php echo e(__('Price')); ?>: <sup class="redstar">*</sup></label>
              <input step="0.01" type="text" inputmode="numeric" pattern="[-+]?[0-9]*[.,]?[0-9]+" class="form-control" name="price" id="priceMain" placeholder="<?php echo e(__('Enter')); ?> <?php echo e(__('Price')); ?>" value="<?php echo e($cor->price); ?>">

              <br>
              <label for="exampleInputSlug"><?php echo e(__('DiscountPrice')); ?>: <sup class="redstar">*</sup></label>
              <input step="0.01" type="text" inputmode="numeric" pattern="[-+]?[0-9]*[.,]?[0-9]+" class="form-control" name="discount_price" id="exampleInputPassword1" placeholder="<?php echo e(__('Enter')); ?> <?php echo e(__('DiscountPrice')); ?>" value="<?php echo e($cor->discount_price); ?>">
            </div>
          </div>

          <div class="col-md-3">
            <?php if(Auth::User()->role == "admin"): ?>
            <label for="exampleInputTit1e"><?php echo e(__('Featured')); ?>:</label><br>
            <label class="switch">
              <input class="slider" type="checkbox" id="customSwitch6" name="featured" <?php echo e($cor->featured==1 ? 'checked' : ''); ?> />
              <span class="knob"></span>
            </label>

            <?php endif; ?>
          </div>
          <div class="col-md-3">
            <?php if(Auth::User()->role == "admin"): ?>
            <label for="exampleInputTit1e"><?php echo e(__('Status')); ?>:</label><br>
            <label class="switch">
              <input class="slider" type="checkbox" id="customSwitch6" name="status" <?php echo e($cor->status==1 ? 'checked' : ''); ?> />
              <span class="knob"></span>
            </label>


            <?php endif; ?>
          </div>
          <div class="row">
            <div class="col-md-4">
              <label for="exampleInputDetails"><?php echo e(__('Instructor InvolvementRequest')); ?>:</label><br>
              <label class="switch">
                <input class="slider" type="checkbox" id="customSwitch6" name="involvement_request" <?php echo e($cor->involvement_request==1 ? 'checked' : ''); ?> />
                <span class="knob"></span>
              </label>


            </div>
          </div>
          <br>


          <div class="col-md-4">
            <label for="exampleInputDetails"><?php echo e(__('PreviewVideo')); ?>:</label><br>
            <label class="switch">
              <input class="slider" type="checkbox" id="customSwitch61" name="preview_type" <?php echo e($cor->preview_type=="video" ? 'checked' : ''); ?> />


              <span class="knob"></span>
            </label>




            <div style="<?php echo e($cor->preview_type == 'url' ? 'display:none' : ''); ?>" id="document1">
              <br>
              <label for="exampleInputSlug"><?php echo e(__('UploadVideo')); ?>: <sup class="redstar">*</sup></label>
              <!-- -------------- -->
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupFileAddon01"><?php echo e(__('Upload')); ?></span>
                </div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="inputGroupFile01" name="video" value="<?php echo e($cor->video); ?>" aria-describedby="inputGroupFileAddon01">
                  <label class="custom-file-label" for="inputGroupFile01"><?php echo e(__('Choose file')); ?></label>
                </div>
              </div>
              <?php if($cor->video !=""): ?>
              <video src="<?php echo e(asset('video/preview/'.$cor->video)); ?>" width="200" height="150" controls>
              </video>
              <?php endif; ?>
              <!-- -------------- -->
            </div>

            <div <?php if($cor->preview_type =="video"): ?> class="display-none" <?php endif; ?> id="document2">
              <br>
              <label for="exampleInputSlug"><?php echo e(__('URL')); ?>: <sup class="redstar">*</sup></label>
              <input type="url" class="form-control" placeholder="<?php echo e(__('Enter')); ?> URL" name="url" id="url" value="<?php echo e($cor->url); ?>">
            </div>
          </div>

          <div class="col-md-4">
            <label for=""><?php echo e(__('Duration')); ?>: </label><br>
            <label class="switch">
              <input class="slider" type="checkbox" name="duration_type" <?php echo e($cor->duration_type == "m" ? 'checked' : ''); ?> />
              <span class="knob"></span>
            </label>
            <br>
            <small class="text-info"><i class="fa fa-question-circle"></i> <?php echo e(__('If enabled duration can be in months')); ?>.</small><br>
            <small class="text-info"> <?php echo e(__('when Disabled duration can be in days')); ?>.</small>

            <br>
            <label for="exampleInputSlug"><?php echo e(__('Course Expire Duration')); ?></label>
            <input min="1" class="form-control" name="duration" type="number" id="duration" value="<?php echo e($cor->duration); ?>" placeholder="<?php echo e(__('Enter')); ?> <?php echo e(__('Duration')); ?>">
          </div>
      </div>
      <br>

      <div class="row">

        <?php if(Auth::user()->role == 'instructor'): ?>
        <div class="col-md-6">
          <label><?php echo e(__('PreviewImage')); ?>:size: 270x200</label>
          <br>
          <!-- ====================== -->
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroupFileAddon01"><?php echo e(__('Upload')); ?></span>
            </div>
            <div class="custom-file">
              <input type="text" class="custom-file-input" id="inputGroupFile01" name="preview_image" value="<?php echo e($cor->preview_image); ?>">
              <label class="custom-file-label" for="inputGroupFile01"><?php echo e(__('Choose file')); ?></label>
            </div>
          </div>
          <?php if($cor['preview_image'] !== NULL && $cor['preview_image'] !== ''): ?>
          <img src="<?php echo e(url('/images/course/'.$cor->preview_image)); ?>" height="70px;" width="70px;" />
          <?php else: ?>
          <img src="<?php echo e(Avatar::create($cor->title)->toBase64()); ?>" alt="course" class="img-fluid">
          <?php endif; ?>
          <!-- ====================== -->
          <br>
        </div>

        <?php endif; ?>

        <?php if(Auth::user()->role == 'admin'): ?>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label" for="first-name"><?php echo e(__('Image')); ?> <span class="required">*</span> </label>

            <div class="input-group">

              <input required readonly id="image" name="preview_image" type="text" class="form-control" value="<?php echo e($cor['preview_image'] != NULL ? $cor['preview_image'] : ''); ?>">
              <div class="input-group-append">
                <span data-input="image" class="bg-primary text-light midia-toggle input-group-text"><?php echo e(__('Browse')); ?></span>
              </div>
            </div>

            <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>(<?php echo e(__('Choose Image for 
                          post')); ?>)</small>
            <br>

            <?php if($cor['preview_image'] !== NULL && $cor['preview_image'] !== ''): ?>
            <img src="<?php echo e(url('/images/course/'.$cor->preview_image)); ?>" height="70px;" width="70px;" />
            <?php else: ?>
            <img src="<?php echo e(Avatar::create($cor->title)->toBase64()); ?>" alt="course" class="img-fluid">
            <?php endif; ?>
          </div>
        </div>

        <?php endif; ?>




        <div class="col-md-6">
          <?php if(Auth::User()->role == "admin"): ?>
          <label for="Revenue"><?php echo e(__('Instructor Revenue')); ?>:</label>

          <div class="input-group">

            <input min="1" max="100" class="form-control" name="instructor_revenue" type="number" value="<?php echo e($cor['instructor_revenue']); ?>" id="revenue" placeholder="Enter revenue percentage" class="<?php echo e($errors->has('instructor_revenue') ? ' is-invalid' : ''); ?> form-control">
            <span class="input-group-addon"><i class="fa fa-percent"></i></span>
          </div>
          <?php endif; ?>
        </div>
      </div>
      <br>

      <div class="row">
        <div class="col-sm-3">

          <label for="exampleInputDetails"><?php echo e(__('Assignment')); ?>:</label><br>
          <label class="switch">
            <input class="slider" type="checkbox" name="assignment_enable" <?php echo e($cor['assignment_enable']=="1" ? 'checked' : ''); ?> />
            <span class="knob"></span>
          </label>
          <br>
          <small class="text-info"><i class="fa fa-question-circle"></i> <?php echo e(__('To enable assignment on portal')); ?>

          </small>

        </div>

        <div class="col-sm-3">

          <label for="exampleInputDetails"><?php echo e(__('Appointment')); ?>:</label><br>
          <label class="switch">
            <input class="slider" type="checkbox" name="appointment_enable" <?php echo e($cor['appointment_enable']=="1" ? 'checked' : ''); ?> />
            <span class="knob"></span>
          </label>

        </div>

        <div class="col-sm-3">

          <label for="exampleInputDetails"><?php echo e(__('CertificateEnable')); ?>:</label><br>
          <!--  -->
          <label class="switch">
            <input class="slider" type="checkbox" name="certificate_enable" id="customSwitch10" <?php echo e($cor['certificate_enable'] == "1" ? 'checked' : ''); ?> />
            <span class="knob"></span>
          </label>

        </div>

        <div class="col-sm-3">

          <label for=""><?php echo e(__('DripContent')); ?>: </label><br>
          <label class="switch">
            <input class="slider" type="checkbox" name="drip_enable" <?php echo e($cor['drip_enable'] == 1 ? 'checked' : ''); ?> />
            <span class="knob"></span>
          </label>
          <br>
          <small class="text-info"><i class="fa fa-question-circle"></i> <?php echo e(__('To release content on chapter & classes by a specific date or amount of days after enrollment')); ?>.
          </small>
        </div>
      </div>
      <br>
      <br>
      <br>

      <div class="box-footer">
        <button type="submit" class="btn btn-lg col-md-3 btn-primary-rgba"><?php echo e(__('Save')); ?></button>
      </div>

      </form>
    </div>
  </div>
</div>
</div>
<!-- edit media Modal start -->

<!-- edit media Model ended -->
<?php $__env->startSection('scripts'); ?>
<script>
  (function($) {
    "use strict";

    $(function() {
      $('.js-example-basic-single').select2({
        tags: true,
        tokenSeparators: [',', ' ']
      });
    });

    $(function() {
      $('#cb1').change(function() {
        $('#f').val(+$(this).prop('checked'))
      })
    })

    $(function() {
      $('#cb3').change(function() {
        $('#test').val(+$(this).prop('checked'))
      })
    })

    $(function() {

      $('#murl').change(function() {
        if ($('#murl').val() == 'yes') {
          $('#doab').show();
        } else {
          $('#doab').hide();
        }
      });

    });

    $(function() {

      $('#murll').change(function() {
        if ($('#murll').val() == 'yes') {
          $('#doabb').show();
        } else {
          $('#doab').hide();
        }
      });

    });

    $('#customSwitch2').change(function() {
      if ($('#customSwitch2').is(':checked')) {
        $('#doabox').show('fast');

        $('#priceMain').prop('required', 'required');

      } else {
        $('#doabox').hide('fast');

        $('#priceMain').removeAttr('required');
      }

    });

    $('#customSwitch61').on('change', function() {

      if ($('#customSwitch61').is(':checked')) {
        $('#document1').show('fast');
        $('#document2').hide('fast');

      } else {
        $('#document2').show('fast');
        $('#document1').hide('fast');
      }

    });

    $(function() {
      var urlLike = '<?php echo e(url('admin/dropdown')); ?>';
      $('#category_id').change(function() {
        var up = $('#upload_id').empty();
        var cat_id = $(this).val();
        if (cat_id) {
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: urlLike,
            data: {
              catId: cat_id
            },
            success: function(data) {
              console.log(data);
              up.append('<option value="0">Please Choose</option>');
              $.each(data, function(id, title) {
                up.append($('<option>', {
                  value: id,
                  text: title
                }));
              });
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
              console.log(XMLHttpRequest);
            }
          });
        }
      });
    });

    $(function() {
      var urlLike = '<?php echo e(url('admin/gcat')); ?>';
      $('#upload_id').change(function() {
        var up = $('#grand').empty();
        var cat_id = $(this).val();
        if (cat_id) {
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: urlLike,
            data: {
              catId: cat_id
            },
            success: function(data) {
              console.log(data);
              up.append('<option value="0">Please Choose</option>');
              $.each(data, function(id, title) {
                up.append($('<option>', {
                  value: id,
                  text: title
                }));
              });
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
              console.log(XMLHttpRequest);
            }
          });
        }
      });
    });

  })(jQuery);
</script>


<script>
  $(".midia-toggle").midia({
    base_url: '<?php echo e(url('')); ?>',
    title: 'Choose Course Image',
    dropzone: {
      acceptedFiles: '.jpg,.png,.jpeg,.webp,.bmp,.gif'
    },
    directory_name: 'course'
  });
</script>



<?php $__env->stopSection(); ?><?php /**PATH C:\laragon\www\eclass_5.4\resources\views/admin/course/editcor.blade.php ENDPATH**/ ?>