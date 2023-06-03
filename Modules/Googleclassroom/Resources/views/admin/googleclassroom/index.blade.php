@extends('admin.layouts.master')
@section('title', 'Your Google Class Room  - Admin')
@section('maincontent')
<?php
$data['heading'] = 'Google Class Room Class';
$data['title'] = 'Class';
$data['title1'] = 'Google Class Room Class';
?>
@include('admin.layouts.topbar',$data)
<div class="contentbar">   
    @if ($errors->any())  
    <div class="alert alert-danger" role="alert">
    @foreach($errors->all() as $error)     
    <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true" style="color:red;">&times;</span></button></p>
        @endforeach  
    </div>
    @endif             
    <!-- Start row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card dashboard-card m-b-30">
                <div class="card-header">
                    <h5 class="box-title">{{ __('Class List')}}</h5>
                    <div>
                        <div class="widgetbar">
                        <button type="button" class="float-right btn btn-danger-rgba mr-2" data-toggle="modal" data-target="#bulk_delete"><i class="feather icon-trash mr-2"></i> Delete Selected</button>
                        <a href="{{ route('googleclassroom.cource.create') }}" class="float-right btn btn-primary-rgba mr-2"><i class="feather icon-plus mr-2"></i>{{ __('Add Class') }}</a>
                        </div>                        
                      </div>
                </div>
                <div class="card-body">
                 
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>
                                    <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]"
                                    value="all" />
                                    <label for="checkboxAll" class="material-checkbox"></label> # 
                                </th>
                                <th>
                                    {{ __('Class ID') }}
                                </th>
                                <th>
                                    {{ __('Class State') }}
                                </th>
                                <th>
                                    {{ __('Status') }}
                                </th>
                                <th>
                                    {{ __('adminstaticword.Action') }}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
								@php
								$i = 0;
							@endphp

							@foreach($courses as $key => $course)
		  
								@php
									$i++;
								@endphp
							    <tr>
                                    <td>        
                                        <input type='checkbox' form='bulk_delete_form' class='check filled-in material-checkbox-input' name='checked[]' value="{{ $course->id }}" id='checkbox{{ $course->id }}'>
                                        <label for='checkbox{{ $course->id }}' class='material-checkbox'></label>
                                        {{ $i }}
                                        <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <div class="delete-icon"></div>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <h4 class="modal-heading">{{ __('Are You Sure ?') }}</h4>
                                                        <p>{{ __('Do you really want to delete selected class ? This process can not be undone.') }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form id="bulk_delete_form" method="post"
                                                            action="{{ route('googlecource.bulk.delete') }}">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="reset" class="btn btn-gray translate-y-3"
                                                                data-dismiss="modal">No</button>
                                                            <button type="submit" class="btn btn-danger">Yes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                            
                                    <td>
                                        <p><b>{{ __('Class Id :') }}</b> {{ $course->course_id }} </p>
                                        <p><b>{{ __('Class Room Course Id :') }}</b> {{ $course->classroom_cource_id }} </p>
                                        <p><b>{{ __('Owner Id :') }}</b> {{ $course->owner_id }} </p>
                                        <p><b>{{ __('Class On Course :') }}</b> {{ $course->cource_title }} </p>
                                        <p><b>{{ __('Class Description :') }}</b> {{ $course->cource_description }} </p>
                                        <p><b>{{ __('Class State :') }}</b> {{ $course->cource_state }} </p>
                                        <p><b>{{ __('Enrollment Code :') }}</b> {{ $course->classroom_cource_enrollment_code }} <small>{{ __('( Share the code with student to join the class. )') }}</small></p>
                                    </td>
                                    <td>
                                        <a title="Accept" target="_blank" href="{{ $course->cource_url }}}">
                                            <button class="btn btn-rounded btn-primary-rgba">{{ __('Join') }}</button>
                                        </a>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input class="googlecourcestatus" type="checkbox"  data-id="{{ $course->id }}" name="status" {{ $course->status == '1' ? 'checked' : '' }}>
                                            <span class="knob"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-round btn-primary-rgba" type="button" id="CustomdropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton3">
                                                <a class="dropdown-item" title="Edit Cource" href="{{ route('googleclassroom.edit',$course->classroom_cource_id) }}"><i class="feather icon-edit mr-2"></i>{{ __("Edit")}}</a>
                                                <a class="dropdown-item" target="_blank" title="Start Class" href="{{ $course->cource_url }}}"><i class="feather icon-send mr-2"></i>{{ __("Start")}}</a>
                                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="feather icon-trash mr-2"></i>{{ __("Delete")}}</a>
                                            </div>
                                        </div>
                                    </td>

                                    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleSmallModalLabel">Delete</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="text-muted">{{ __("Do you really want to delete these cource? This process cannot be undone.")}}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="post" action="{{ route('googleclassroom.delete',$course->classroom_cource_id) }}" class="pull-right">
                                                        {{csrf_field()}}
                                                        {{method_field("DELETE")}}
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("No")}}</button>
                                                    <button type="submit" class="btn btn-danger">{{ __("Yes")}}</button>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                             
                                </tr>
                            @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
      <!-- End col -->
  </div>
  <!-- End row -->
</div>        
@endsection
@section('script')
<!-- script to change status start -->
<script>
  $(function() {
    $('.googlecourcestatus').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var id = $(this).data('id'); 
        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'class-status',
            data: {'status': status, 'id': id},
            success: function(data){
              console.log(id)
            }
        });
    });
  });
</script>
<!-- script to change status end -->
<script>
    $("#checkboxAll").on('click', function () {
$('input.check').not(this).prop('checked', this.checked);
});
</script>
@endsection
            
                                    
                                     
                                      
                                    
                                   
                              
                               
                                
    
              
                               
                              
                
                               
                              
