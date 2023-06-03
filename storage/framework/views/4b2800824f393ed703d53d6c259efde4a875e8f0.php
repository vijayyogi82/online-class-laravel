<div class="modal fade" data-backdrop="" style="z-index: 99999999999999999;" id="myModalinstructor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">

          <h4 class="modal-title" id="myModalLabel"><?php echo e(__('Become An Instructor')); ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="box box-primary">
          <div class="panel panel-sum">
            <div class="modal-body">
              <?php if(Auth::check()): ?>
              <?php
                $users = App\Instructor::where('user_id', Auth::user()->id)->first();

              ?>

              <?php if($users != NULL): ?>
                  
                  <div class="alert alert-danger" role="alert">
                    <?php echo e(__('Already Request')); ?> 
                  </div>

                 

                  <form  method="post" action="<?php echo e(url('requestinstructor/'.$users->id)); ?>" data-parsley-validate class="form-horizontal form-label-left">
                      <?php echo e(csrf_field()); ?>

                      <?php echo e(method_field('DELETE')); ?>

                      <div class="cancel-button" style="text-align:center">
                      <button type="submit" class="btn btn-primary"> <?php echo e(__('Cancel')); ?> <?php echo e(__('Request')); ?> </button>
                    </div>
                  </form>
              <?php else: ?>
                <form id="demo-form2" method="post" action="<?php echo e(route('apply.instructor')); ?>" data-parsley-validate 
                  class="form-horizontal form-label-left" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>


                    
                    
                    <input type="hidden" name="user_id"  value="<?php echo e(Auth::User()->id); ?>" />
                      
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="fname"><?php echo e(__('First Name')); ?>:<sup class="redstar">*</sup></label>
                          <input type="text" class="form-control" name="fname" id="title" placeholder="  <?php echo e(__('Enter First Name')); ?>" value="<?php echo e(Auth::User()->fname); ?>" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="lname"><?php echo e(__('Last Name')); ?>:<sup class="redstar">*</sup></label>
                          <input type="text" class="form-control" name="lname" id="title" placeholder="  <?php echo e(__('Enter Last Name')); ?>" value="<?php echo e(Auth::User()->lname); ?>" required>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="email"><?php echo e(__('Email')); ?>:<sup class="redstar">*</sup></label>
                          <input type="email" value="<?php echo e(Auth::User()->email); ?>" class="form-control" name="email" id="title" placeholder="<?php echo e(('Enter Email')); ?>" value="">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="contact"><?php echo e(__('Mobile')); ?>:<sup class="redstar">*</sup></label>
                          <input type="text" class="form-control" name="mobile" id="contact" placeholder="<?php echo e(__('Enter Mobile No')); ?>" value="" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="detail"><?php echo e(__('Detail')); ?>:<sup class="redstar">*</sup></label>
                          <textarea name="detail" rows="5"  class="form-control" placeholder="" required></textarea>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="file"><?php echo e(__('Upload Resume')); ?>:<sup class="redstar">*</sup></label>
                          <input type="file" class="form-control" name="file" id="file" value="" required>
                        </div>
                         <div class="form-group">
                          <label for="image"><?php echo e(__('Upload Image')); ?>:<sup class="redstar">*</sup></label>
                          <input type="file" class="form-control" name="image"  id="image" required>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="box-footer">
                     <button type="submit" class="btn btn-lg col-md-3 btn-primary"><?php echo e(__('Submit')); ?></button>
                    </div>
                </form>
              <?php endif; ?>
              <?php else: ?>
                <div class="box-footer">
                  <button type="submit" onclick="window.location.href = '<?php echo e(route('login')); ?>';" class="btn btn-lg col-md-3 btn-primary"><?php echo e(__('Submit')); ?></button>
                </div>
              <?php endif; ?>  
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<?php /**PATH C:\laragon\www\eclass_5.4\resources\views/instructormodel.blade.php ENDPATH**/ ?>