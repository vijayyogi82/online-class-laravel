<div class="row">
      
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-header">
                <h5 class="card-box"><?php echo e(__('All Appointment')); ?></h5>
                  <div class="widgetbar">
                      <button type="button" class="btn btn-danger-rgba mr-2 " data-toggle="modal" data-target="#bulk_delete11"><i class="feather icon-trash mr-2"></i> <?php echo e(__('Delete Selected')); ?></button>
                  </div>
            </div>
  
  
             <div id="bulk_delete11" class="delete-modal modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="delete-icon"></div>
                        </div>
                        <div class="modal-body text-center">
                            <h4 class="modal-heading"><?php echo e(__('Are You Sure ?')); ?></h4>
                            <p><?php echo e(__('Do you really want to delete selected item ? This process
                                cannot be undone.')); ?></p>
                        </div>
                        <div class="modal-footer">
                            <form id="bulk_delete_form11" method="post"
                                action="<?php echo e(route('appointment.bulk_delete')); ?>">
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
  
            <div class="card-body">
            
                <div class="table-responsive">
                    <table id="" class="displaytable table table-striped table-bordered w-100">
                        <thead>
                        <tr>
                          <th> 
                            <input id="checkboxAll11" type="checkbox" class="filled-in" name="checked[]" value="all" />
                            <label for="checkboxAll" class="material-checkbox"></label> #
                          </th>
  
                          <th><?php echo e(__('User')); ?></th>
                          <th><?php echo e(__('Course')); ?></th>
                          <th><?php echo e(__('Instructor')); ?></th>
                          <th><?php echo e(__('Title')); ?></th>
                          <th><?php echo e(__('Accepted')); ?></th>
                          <th><?php echo e(__('Action')); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=0;?>
                        <?php $__currentLoopData = $appointment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appoint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                            <?php $i++;?>
                            <td>
                               <input type="checkbox" form="bulk_delete_form11" class="filled-in material-checkbox-input11" name="checked[]" value="<?php echo e($appoint->id); ?>" id="checkbox<?php echo e($appoint->id); ?>">
                              <label for="checkbox<?php echo e($appoint->id); ?>" class="material-checkbox"></label> <?php echo $i;?>
                            </td>
                            
                            <td><?php if(isset($appoint->user)): ?> <?php echo e($appoint->user->fname); ?> <?php endif; ?></td>
                            <td><?php if(isset($appoint->courses)): ?> <?php echo e($appoint->courses->title); ?> <?php endif; ?></td>
                            <td><?php if(isset($appoint->instructor)): ?> <?php echo e($appoint->instructor->fname); ?> <?php endif; ?></td>
                            <td><?php echo e($appoint->title); ?></td>
                             <!-- ================================== -->
                              <td>
                                  <label class="switch">
                                  <input class="slider" type="checkbox"  data-id="<?php echo e($appoint->id); ?>" name="accept" <?php echo e($appoint->accept ==1 ? 'checked' : ''); ?> onchange="appointment('<?php echo e($appoint->id); ?>')" />
                                  <span class="knob"></span>
                                  </label>
                              </td>
                              <!-- ================================== -->
                            <td>
                              <div class="dropdown">
                                  <button class="btn btn-round btn-outline-primary" type="button" id="CustomdropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                  <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">
                                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('appointment.manage')): ?>
                                      <a class="dropdown-item" href="<?php echo e(url('appointment/'.$appoint->id)); ?>"><i class="feather icon-edit mr-2"></i>Edit</a>
                                      <a class="dropdown-item btn btn-link" data-toggle="modal" data-target="#deleteap<?php echo e($appoint->id); ?>" >
                                          <i class="feather icon-delete mr-2"></i><?php echo e(__("Delete")); ?></a>
                                      </a>
                                      <?php endif; ?>
                                  </div>
                              </div>
  
                              <!-- delete Modal start -->
                              <div class="modal fade bd-example-modal-sm" id="deleteap<?php echo e($appoint->id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                  <div class="modal-dialog modal-sm">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="exampleSmallModalLabel">Delete</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                                          <div class="modal-body">
                                                  <h4><?php echo e(__('Are You Sure ?')); ?></h4>
                                                  <p><?php echo e(__('Do you really want to delete')); ?> <?php if(isset($appoint->courses)): ?> <b><?php echo e($appoint->courses->title); ?></b> <?php endif; ?> ? <?php echo e(__('This process cannot be undone.')); ?></p>
                                          </div>
                                          <div class="modal-footer">
                                              <form method="post" action="<?php echo e(url('appointment/'.$appoint->id)); ?>" class="pull-right">
                                                  <?php echo e(csrf_field()); ?>

                                                  <?php echo e(method_field("DELETE")); ?>

                                                  <button type="reset" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                  <button type="submit" class="btn btn-primary">Yes</button>
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
  
  <!-- script to change status start -->
  <script>
    function  appointment(id){
      
      var accept = $(this).prop('checked') == true ? 1 : 0; 
      
          $.ajax({
              type: "GET",
              dataType: "json",
              url: "<?php echo e(url('/appointment/status/')); ?>/" + id,
              data: {'accept': accept, 'id': id},
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
  <!-- script to change status end -->
  
  
  
  <?php /**PATH C:\laragon\www\eclass_5.4\resources\views/admin/course/appointment/index.blade.php ENDPATH**/ ?>