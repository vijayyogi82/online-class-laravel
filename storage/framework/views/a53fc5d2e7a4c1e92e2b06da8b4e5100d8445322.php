<div class="row">
      
  <div class="col-lg-12">
      <div class="card m-b-30">
          <div class="card-header">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('review-rating.manage')): ?>
            <button type="button" class="btn btn-danger-rgba mr-2" data-toggle="modal" data-target="#bulk_deletereviewrating"><i
              class="feather icon-trash mr-2"></i><?php echo e(__('Delete Selected')); ?></button>
              <?php endif; ?>
             
          </div>
          <div class="card-body">
          
              <div class="table-responsive">
                  <table id="" class="displaytable table table-striped table-bordered">
                      <thead>
                      <tr>

                        <th><input id="checkboxAllrerating" type="checkbox" class="filled-in" name="checked[]" value="all" />
                        <label for="checkboxAll" class="material-checkbox"></label> #
                        </th>
                        <th><?php echo e(__('Course')); ?></th>
                        <th><?php echo e(__('User')); ?></th>
                        <th><?php echo e(__('Review')); ?></th>
                        <th><?php echo e(__('Learn')); ?></th>
                        <th><?php echo e(__('Price')); ?></th>
                        <th><?php echo e(__('Value')); ?></th>
                        <th><?php echo e(__('Status')); ?></th>
                        <th><?php echo e(__('Approved')); ?></th>
                        <th><?php echo e(__('Featured')); ?></th>
                        <th><?php echo e(__('Action')); ?></th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=0;?>
                      <?php $__currentLoopData = $cor->review; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <?php $i++;?>
                        <td>
                                      
                         <input type="checkbox" form="bulk_delete_formr7" class="filled-in material-checkbox-input check" name="checked[]" value="<?php echo e($jp->id); ?>" id="checkbox<?php echo e($jp->id); ?>">
                          <label for="checkbox<?php echo e($jp->id); ?>" class="material-checkbox"></label> <?php echo $i; ?>
                            <div id="bulk_deletereviewrating" class="delete-modal modal fade" role="dialog">
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
                                            <form id="bulk_delete_formr7" method="post"
                                                action="<?php echo e(route('reviewrating.bulk_delete')); ?>">
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
                          <td><?php echo e($jp->courses->title); ?></td>
                          <td>
                          <?php echo e($jp->user['fname']); ?> <?php echo e($jp->user['lname']); ?>

                          </td>
                          <td><?php echo e(str_limit($jp->review, $limit = 50, $end = '...')); ?></td>
                          <td><?php echo e($jp->learn); ?></td>
                          <td><?php echo e($jp->price); ?></td>
                          <td><?php echo e($jp->value); ?></td> 
                          <td>
                              <label class="switch">
                                <input class="slider" type="checkbox"  data-id="<?php echo e($jp->id); ?>" name="status" <?php echo e($jp->status ==1 ? 'checked' : ''); ?> onchange="reviewratingstatus('<?php echo e($jp->id); ?>')" />
                                <span class="knob"></span>
                              </label>
                          </td>
                          <td>
                              <label class="switch">
                                <input class="slider" type="checkbox"  data-id="<?php echo e($jp->id); ?>" name="approved" <?php echo e($jp->approved ==1 ? 'checked' : ''); ?> onchange="reviewratingapproved('<?php echo e($jp->id); ?>')" />
                                <span class="knob"></span>
                              </label>
                          </td>
                          <td>
                              <label class="switch">
                                <input class="slider" type="checkbox"  data-id="<?php echo e($jp->id); ?>" name="featured" <?php echo e($jp->featured ==1 ? 'checked' : ''); ?> onchange="reviewratingfeatured('<?php echo e($jp->id); ?>')" />
                                <span class="knob"></span>
                              </label>
                          </td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-round btn-outline-primary" type="button" id="CustomdropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                              <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('review-rating.manage')): ?>
                                  <a class="dropdown-item" href="<?php echo e(url('reviewrating/'.$jp->id)); ?>"><i class="feather icon-edit mr-2"></i><?php echo e(__('Edit')); ?></a>
                                  <a class="dropdown-item btn btn-link" data-toggle="modal" data-target="#deletereviewrating<?php echo e($jp->id); ?>" >
                                      <i class="feather icon-delete mr-2"></i><?php echo e(__("Delete")); ?></a>
                                  </a>
                                  <?php endif; ?>
                              </div>
                          </div>
      
                          <!-- delete Modal start -->
                          <div class="modal fade bd-example-modal-sm" id="deletereviewrating<?php echo e($jp->id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                                              <p><?php echo e(__('Do you really want to delete')); ?> <b><?php echo e($jp->courses->title); ?></b> ? <?php echo e(__('This process cannot be undone.')); ?></p>
                                      </div>
                                      <div class="modal-footer">
                                          <form method="post" action="<?php echo e(url('reviewrating/'.$jp->id)); ?>" class="pull-right">
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
 
</div>
<!-- script to change status start -->
<script>
  function reviewratingstatus(id){
    
    var status = $(this).prop('checked') == true ? 1 : 0; 
    
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo e(url('/Review-rating/status/')); ?>/" + id,
            data: {'status': status, 'id': id},
            success: function(data){
              console.log(id)
            }
        });
    };


    function reviewratingapproved(id){
    
    var approved = $(this).prop('checked') == true ? 1 : 0; 
    
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo e(url('/Review-rating/approved/')); ?>/" + id,
            data: {'approved': approved, 'id': id},
            success: function(data){
              console.log(id)
            }
        });
    };

    function reviewratingfeatured(id){
    
    var featured = $(this).prop('checked') == true ? 1 : 0; 
    
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo e(url('/Review-rating/featured/')); ?>/" + id,
            data: {'featured': featured, 'id': id},
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
        });
    };
 
</script>
<script>
  $("#checkboxAllrerating").on('click', function () {
    $('input.check').not(this).prop('checked', this.checked);
});
</script>



<?php /**PATH C:\laragon\www\eclass_5.4\resources\views/admin/course/reviewrating/index.blade.php ENDPATH**/ ?>