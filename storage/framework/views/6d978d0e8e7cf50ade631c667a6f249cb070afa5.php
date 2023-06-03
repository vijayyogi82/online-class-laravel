<div class="row">
  <div class="col-lg-12">
    <div class="card m-b-30">
      <div class="card-header">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('announcement.delete')): ?>
      <button type="button" class="btn btn-danger-rgba mr-2" data-toggle="modal" data-target="#bulk_delete8"><i
          class="feather icon-trash mr-2"></i><?php echo e(__('Delete Selected')); ?></button>
          <?php endif; ?>
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('announcement.create')): ?>
        <a data-toggle="modal" data-target="#myModalabcdef" href="#" class="btn btn-primary-rgba"><i
            class="feather icon-plus mr-2"></i><?php echo e(__('Announcement')); ?></a>
            <?php endif; ?>
      </div>
      <div class="card-body">

        <div class="table-responsive">
          <table id="" class="displaytable table table-striped table-bordered w-100">
            <thead>
              <tr>
                <th><input id="checkboxAll8" type="checkbox" class="filled-in" name="checked[]"
                  value="all" />
              <label for="checkboxAll" class="material-checkbox"></label>#</th>
                <th><?php echo e(__('Announcement')); ?></th>
                <th><?php echo e(__('Status')); ?></th>
                <th><?php echo e(__('Action')); ?></th>
              
              </tr>
            </thead>
            <tbody>
              <?php $i=0;?>
              <?php $__currentLoopData = $cor->announsment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $an): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <?php $i++;?>
                <td>
                  <input type="checkbox" form="bulk_delete_form8" class="filled-in material-checkbox-input8" name="checked[]" value="<?php echo e($an->id); ?>" id="checkbox<?php echo e($an->id); ?>">
                    <label for="checkbox<?php echo e($an->id); ?>" class="material-checkbox"></label> <?php echo $i; ?>
                      <!-- bulk delete modal end -->
                      <div id="bulk_delete8" class="delete-modal modal fade" role="dialog">
                          <div class="modal-dialog modal-sm">
                              <!-- Modal content-->
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <div class="delete-icon"></div>
                                  </div>
                                  <div class="modal-body text-center">
                                      <h4 class="modal-heading"><?php echo e(__('Are You Sure')); ?> ?</h4>
                                      <p><?php echo e(__('Do you really want to delete selected item ? This process
                                          cannot be undone')); ?>.</p>
                                  </div>
                                  <div class="modal-footer">
                                      <form id="bulk_delete_form8" method="post"
                                          action="<?php echo e(route('announcement.bulk_delete')); ?>">
                                          <?php echo csrf_field(); ?>
                                          <?php echo method_field('POST'); ?>
                                          <button type="reset" class="btn btn-gray translate-y-3"
                                              data-dismiss="modal"><?php echo e(__('No')); ?></button>
                                          <button type="submit" class="btn btn-danger"><?php echo e(__('Yes')); ?></button>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- bulk delete modal end -->
                </td>
                <td><?php echo e(str_limit($an->announsment, $limit = 70, $end = '....')); ?></td>
                <!-- ================================== -->
                <td>
                  <?php if($an->status=='1'): ?>
                    <button type="button" class="btn btn-rounded btn-success-rgba" data-toggle="modal" data-target="#myModal">
                      <?php echo e(__('Active')); ?>

                  </button>
                  <?php else: ?>
                  <button type="button" class="btn btn-rounded btn-danger-rgba" data-toggle="modal" data-target="#myModal">
                    <?php echo e(__('Deactive')); ?>

                  </button>
                  <?php endif; ?>
              </td>
                <!-- ================================== -->
                <td>
                  <div class="dropdown">
                    <button class="btn btn-round btn-outline-primary" type="button" id="CustomdropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                    <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('announcement.edit')): ?>
                        <a class="dropdown-item" href="<?php echo e(url('announsment/'.$an->id)); ?>"><i class="feather icon-edit mr-2"></i><?php echo e(__('Edit')); ?></a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('announcement.delete')): ?>
                        <a class="dropdown-item btn btn-link" data-toggle="modal" data-target="#delete<?php echo e($an->id); ?>" >
                            <i class="feather icon-delete mr-2"></i><?php echo e(__("Delete")); ?></a>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="modal fade bd-example-modal-sm" id="delete<?php echo e($an->id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleSmallModalLabel"><?php echo e(__('Delete')); ?></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                                  <h4><?php echo e(__('Are You Sure ?')); ?></h4>
                                  <p><?php echo e(__('Do you really want to delete')); ?> <b><?php echo e($an->courses->title); ?></b> ? <?php echo e(__('This process cannot be undone.')); ?></p>
                          </div>
                          <div class="modal-footer">
                              <form method="post" action="<?php echo e(url('announsment/'.$an->id)); ?>" class="pull-right">
                                  <?php echo e(csrf_field()); ?>

                                  <?php echo e(method_field("DELETE")); ?>

                                  <button type="reset" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('No')); ?></button>
                                  <button type="submit" class="btn btn-primary"><?php echo e(__('Yes')); ?></button>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
                </td>

                
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- End col -->



<div class="modal fade" id="myModalabcdef" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="my-modal-title">
          <b><?php echo e(__('Add Announsment')); ?></b>
      </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
      </div>
      <div class="box box-primary">
        <div class="panel panel-sum">
          <div class="modal-body">
            <form id="demo-form2" method="post" action="<?php echo e(route('announsment.store')); ?>" data-parsley-validate
              class="form-horizontal form-label-left">
              <?php echo e(csrf_field()); ?>



              <select class="d-none" name="course_id" class="form-control select2">
                <option value="<?php echo e($cor->id); ?>"><?php echo e($cor->title); ?></option>
              </select>
              
              <div class="row">
               <div class="col-md-12">
                  <label class="d-none" for="exampleInputTit1e"><?php echo e(__('Select a User :')); ?></label>
                  <select class="d-none" name="user_id" class="form-control select2">
                    <?php
                    $users = App\User::all();
                    ?>

                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $us): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($us->id); ?>" ><?php echo e($us->fname); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
             
                <div class="col-md-12">
                  <label for="exampleInputDetails"><?php echo e(__('Announcement')); ?>:<sup class="redstar">*</sup></label>

                  <textarea name="announsment" id="editor6" rows="2" class="form-control"
                    placeholder="Enter Your Announcement"></textarea>
                </div>
                <div class="col-md-12">
                  <label for="exampleInputDetails"><?php echo e(__('Status')); ?> :</label><br>
                  <label class="switch">
                      <input class="slider" type="checkbox" name="status" checked />
                      <span class="knob"></span>
                    </label>
                
                </div>
               
                <div class="form-group">
                  <button type="reset" class="btn btn-danger-rgba"><i class="fa fa-ban"></i> <?php echo e(__('Reset')); ?></button>
                  <button type="submit" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
                   <?php echo e(__('Create')); ?> </button>
                </div>

                <div class="clear-both"></div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- script to change status start -->


<script>


$(document).on("change",".announ",function() {
        
      $.ajax({
          type: "POST",
          dataType: "json",
          url: 'announcement/status',
          data: {'approved': $(this).is(':checked') ? 1 : 0, 'id': $(this).data('id')},
          success: function(data){
          var warning = new PNotify( {
              title: 'success', text:'Status Update Successfully', type: 'success', desktop: {
              desktop: true, icon: 'feather icon-thumbs-down'
              }
            });
            warning.get().click(function() {
              warning.remove();
            });
        }
      })
  });

  (function ($) {
    "use strict";
    tinymce.init({
      selector: 'textarea#detail'
    });
  })(jQuery);

  $("#checkboxAll").on('click', function () {
$('input.check').not(this).prop('checked', this.checked);
});
</script>
<?php /**PATH C:\laragon\www\eclass_5.4\resources\views/admin/course/announsment/index.blade.php ENDPATH**/ ?>