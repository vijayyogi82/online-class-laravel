<div class="row">
  <div class="col-lg-12">
    <div class="card m-b-30">
      <div class="card-header">
        <h5 class="card-box"><?php echo e(__('All Report')); ?></h5>
        <div class="widgetbar">
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('review-reports.manage')): ?>
          <button type="button" class="btn btn-danger-rgba mr-2" data-toggle="modal" data-target="#bulk_delete100"><i class="feather icon-trash mr-2"></i><?php echo e(__('Delete Selected')); ?></button>
          <?php endif; ?>
        </div>
      </div>
      <div class="card-body">

        <div class="table-responsive">
          <table id="" class="displaytable table table-striped table-bordered w-100">
            <thead>
              <tr>
                <th>
                  <input id="checkboxAll100" type="checkbox" class="filled-in" name="checked[]" value="all">
                  <label for="checkboxAll" class="material-checkbox"></label>
                  #
                </th>
                <th><?php echo e(__('User')); ?></th>
                <th><?php echo e(__('Course')); ?></th>
                <th><?php echo e(__('Title')); ?></th>
                <th><?php echo e(__('Email')); ?></th>
                <th><?php echo e(__('Detail')); ?></th>
                <th><?php echo e(__('Action')); ?></th>
              </tr>
            </thead>
            <tbody>
              <?php $i=0;?>
              <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <?php $i++;?>
                <td>    
                    <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input100" name="checked[]" value="<?php echo e($report->id); ?>" id="checkbox<?php echo e($report->id); ?>">
                    <label for="checkbox<?php echo e($report->id); ?>" class="material-checkbox"></label> 

                    <?php echo $i; ?>
                    <div id="bulk_delete100" class="delete-modal modal fade" role="dialog">
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
                              <form id="bulk_delete_form11" method="post"
                                  action="<?php echo e(route('report.review.bulk_delete')); ?>">
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
                <td><?php echo e($report->user['fname']); ?></td>
                <td><?php echo e($report->courses['title']); ?></td>
                <td><?php echo e($report->title); ?></td>
                <td><?php echo e($report->email); ?></td>
                <td><?php echo e($report->detail); ?></td>
                <td>
                      <div class="dropdown">
                        <button class="btn btn-round btn-outline-primary" type="button" id="CustomdropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                        <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">
                          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('review-reports.manage')): ?>
                            <a class="dropdown-item" href="<?php echo e(url('reports/'.$report->id)); ?>"><i class="feather icon-edit mr-2"></i><?php echo e(__('Edit')); ?></a>
                            <a class="dropdown-item btn btn-link" data-toggle="modal" data-target="#deleterreport<?php echo e($report->id); ?>" >
                                <i class="feather icon-delete mr-2"></i><?php echo e(__("Delete")); ?></a>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="modal fade bd-example-modal-sm" id="deleterreport<?php echo e($report->id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                                      <p><?php echo e(__('Do you really want to delete')); ?> <b><?php echo e($report->courses['title']); ?></b> ? <?php echo e(__('This process cannot be undone.')); ?></p>
                              </div>
                              <div class="modal-footer">
                                  <form method="post" action="<?php echo e(url('reports/'. $report->id)); ?>" class="pull-right">
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

<?php /**PATH C:\laragon\www\eclass_5.4\resources\views/admin/course/reviewreport/index.blade.php ENDPATH**/ ?>