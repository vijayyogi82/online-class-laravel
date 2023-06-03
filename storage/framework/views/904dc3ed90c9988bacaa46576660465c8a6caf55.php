<div class="row">
  <div class="col-lg-12">
    <div class="card m-b-30">
      <div class="card-header">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('previous-paper.delete')): ?>
        <button type="button" class="btn btn-danger-rgba mr-2 " data-toggle="modal" data-target="#bulk_delete12"><i
          class="feather icon-trash mr-2"></i> <?php echo e(__('Delete Selected')); ?></button>
          <?php endif; ?>
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('previous-paper.create')): ?>
        <a data-toggle="modal" data-target="#myModalPaper" href="#" class="btn btn-primary-rgba"><i
            class="feather icon-plus mr-2"></i><?php echo e(__('Previous Paper')); ?></a>
            <?php endif; ?>
      </div>
      <div class="card-body">

        <div class="table-responsive">
          <table id="" class="displaytable table table-striped table-bordered w-100">
            <thead>
              <tr>
                <th> <input id="checkboxAll12" type="checkbox" class="filled-in" name="checked[]"
                  value="all" />
              <label for="checkboxAll" class="material-checkbox"></label> #</th>
                <th><?php echo e(__('Title')); ?></th>
                <th><?php echo e(__('Detail')); ?></th>
                <th><?php echo e(__('Status')); ?></th>
                <th><?php echo e(__('Action')); ?></th>

              </tr>
            </thead>

            <tbody>
              <?php $i=0;?>
              <?php $__currentLoopData = $papers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paper): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <?php $i++;?>
                <td> 
                   <input type="checkbox" form="bulk_delete_form12" class="filled-in material-checkbox-input12" name="checked[]" value="<?php echo e($paper->id); ?>" id="checkbox<?php echo e($paper->id); ?>">
                    <label for="checkbox<?php echo e($paper->id); ?>" class="material-checkbox"></label> <?php echo $i; ?>

                  <div id="bulk_delete12" class="delete-modal modal fade" role="dialog">
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
                                  <form id="bulk_delete_form12" method="post"
                                      action="<?php echo e(route('previouspaper.bulk_delete')); ?>">
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
                </td>
                <td><?php echo e($paper->title); ?></td>
                <td><?php echo e(strip_tags($paper->detail)); ?></td>
                <td>
                    <label class="switch">
                      <input class="slider" type="checkbox"  data-id="<?php echo e($paper->id); ?>" name="status" <?php echo e($paper->status ==1 ? 'checked' : ''); ?> onchange="previouspaper('<?php echo e($paper->id); ?>')" />
                      <span class="knob"></span>
                    </label>
                </td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-round btn-outline-primary" type="button" id="CustomdropdownMenuButton1"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                        class="feather icon-more-vertical-"></i></button>
                    <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('previous-paper.edit')): ?>
                      <a class="dropdown-item" href="<?php echo e(url('previous-paper/'.$paper->id)); ?>"><i
                          class="feather icon-edit mr-2"></i><?php echo e(__('Edit')); ?></a>
                          <?php endif; ?>
                          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('previous-paper.delete')): ?>
                      <a class="dropdown-item btn btn-link" data-toggle="modal" data-target="#deletepaper<?php echo e($paper->id); ?>">
                        <i class="feather icon-delete mr-2"></i><?php echo e(__("Delete")); ?></a>
                      </a>
                      <?php endif; ?>
                    </div>
                  </div>

                  <!-- delete Modal start -->
                  <div class="modal fade bd-example-modal-sm" id="deletepaper<?php echo e($paper->id); ?>" tabindex="-1" role="dialog"
                    aria-hidden="true">
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
                          <p><?php echo e(__('Do you really want to delete')); ?> <b><?php echo e($paper->title); ?></b> ? <?php echo e(__('This process cannot be undone.')); ?></p>
                        </div>
                        <div class="modal-footer">
                          <form method="post" action="<?php echo e(url('previous-paper/'.$paper->id)); ?>" class="pull-right">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field("DELETE")); ?>

                            <button type="reset" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('No')); ?></button>
                            <button type="submit" class="btn btn-primary"><?php echo e(__('Yes')); ?></button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- delete Model ended -->

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
</div>
</div>
<script>
  $("#checkboxAll").on('click', function () {
$('input.check').not(this).prop('checked', this.checked);
});
</script>
<!-- End row -->
<div class="modal fade" id="myModalPaper" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="my-modal-title">
          <b><?php echo e(__('Previous Paper')); ?></b>
      </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="box box-primary">
        <div class="panel panel-sum">
          <div class="modal-body">
            <form id="demo-form2" method="post" action="<?php echo e(route('previous-paper.store')); ?>" data-parsley-validate
              class="form-horizontal form-label-left" enctype="multipart/form-data">
              <?php echo e(csrf_field()); ?>

              <div class="col-md-12">
                <select class="d-none" name="course_id" class="form-control select2 d-none">
                  <option value="<?php echo e($cor->id); ?>"><?php echo e($cor->title); ?></option>
                </select>
              </div>
              <div class="col-md-12">
                <label for=""><?php echo e(__('Title')); ?>:<sup class="redstar">*</sup></label>
                <input type="text" name="title" class="form-control select2" autocomplete="off" required>
              </div>
              <div class="col-md-12">
                <label for="exampleInputDetails"><?php echo e(__('Detail')); ?>:<sup class="redstar">*</sup></label>
                <textarea rows="1" name="detail" class="form-control select2"
                  placeholder="Enter Your Detail"></textarea>
              </div>

              <div class="col-md-12 mt-2">
                <label for=""><?php echo e(__('Paperupload')); ?>:<sup class="redstar">*</sup></label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01"><?php echo e(__('Upload')); ?></span>
                  </div>
                  <div class="custom-file">
                    <input type="file" name="file" class="custom-file-input" id="inputGroupFile01"
                      aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01"><?php echo e(__('Choose file')); ?></label>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <label for="exampleInputDetails"><?php echo e(__('Status')); ?>:</label><br>
                  <label class="switch">
                      <input class="slider" type="checkbox" name="status" checked />
                      <span class="knob"></span>
                    </label>
              </div>

              <div class="col-md-12">
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
  function  previouspaper(id){
    
    var status = $(this).prop('checked') == true ? 1 : 0; 
    
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo e(url('/previous/paper/status/')); ?>/" + id,
            data: {'status': status, 'id': id},
            success: function(data){
              console.log(id)
            }
        });
    };
 
</script>
<!-- script to change status end -->
<script>
    $("#checkboxAll12").on('click', function () {
$('input.check').not(this).prop('checked', this.checked);
});
</script><?php /**PATH C:\laragon\www\eclass_5.4\resources\views/admin/course/previous_paper/index.blade.php ENDPATH**/ ?>