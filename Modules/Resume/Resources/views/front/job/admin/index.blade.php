@extends('admin.layouts.master')
@section('title', __('Job'))
@section('maincontent')
<?php
$data['heading'] = 'Job';
$data['title'] = 'Job';
?>
@include('admin.layouts.topbar',$data)
<!-- component end -->
<!-- Start contentbar -->
<div class="contentbar">
  <!-- Start row -->
    <div class="row">
      <!-- Start col -->
        <div class="col-lg-12">
          <!-- Start card -->
            <div class="card dashboard-card m-b-30">
              <!-- Start card header -->
                <div class="card-header">
                    <h5 class="card-title">{{ __('Job')}}</h5>
                </div>
                <!-- end card header -->
                <!-- Start card body -->
                <div class="card-body">
                  <!-- Start table div -->
                    <div class="table-responsive">
                        <!-- Start table-->
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('Id') }}</th>
                                    <th>{{ __('Comapny Name') }}</th>
                                    <th>{{ __('Job Title') }}</th>
                                   
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Approved') }}</th>
                                    <th>{{ __('Verified') }}</th>
                                    <th>{{ __('Action') }}</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($jobs as $key => $job)
                                <tr>
                                    <td>
                                        {{ filter_var($key+1)}}
                                    </td>
                                    <td>
                                      {{ filter_var($job->companyname)}}
                                    </td> 
                                    <td >
                                        {{ filter_var($job->title)}}
                                    </td> 
                                   
                                    
                                    </td>
                                    <td>
                                      <label class="switch">
                                          <input class="status" type="checkbox" data-id="{{filter_var($job->id)}}" name="status" {{ filter_var($job->status) == '1' ? 'checked' : '' }}>
                                          <span class="knob"></span>
                                      </label>
                                    </td>
                                    <td>
                                      <label class="switch">
                                          <input class="approved" type="checkbox" data-id="{{filter_var($job->id)}}" name="approved" {{ filter_var($job->approved) == '1' ? 'checked' : '' }}>
                                          <span class="knob"></span>
                                      </label>
                                    </td>
                                    <td>
                                      <label class="switch">
                                          <input class="verified" type="checkbox" data-id="{{filter_var($job->id)}}" name="verified" {{ filter_var($job->varified) == '1' ? 'checked' : '' }}>
                                          <span class="knob"></span>
                                      </label>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-round btn-outline-primary" type="button" id="CustomdropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">
                                               
                                                <a class="dropdown-item" href="{{ route("adminjob.view",['id'=> filter_var($job->id)]) }}"><i class="feather icon-eye mr-2"></i>{{ __("View") }}</a>
                                                <a class="dropdown-item btn btn-link" data-toggle="modal" data-target="#delete_{{ filter_var($job->id) }}" >
                                                    <i class="feather icon-delete mr-2"></i>{{ __("Delete") }}</a>
                                                </a>
                                            </div>
                                        </div>
                                        <!-- delete Modal start -->
                                        <div class="modal fade bd-example-modal-sm" id="delete_{{ filter_var($job->id)}}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleSmallModalLabel">{{ __("Delete") }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <h4>{{ __('Are You Sure ?')}}</h4>
                                                            <p>{{ __('Do you really want to delete ? ')}}   {{ __('This process cannot be undone.')}}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="post" action="{{ route('adminjob.destroy',['id' => filter_var($job->id)])}}" class="pull-right">
                                                            {{csrf_field()}}
                                                            {{method_field("DELETE")}}
                                                            <button type="reset" class="btn btn-secondary" data-dismiss="modal">{{ __("No") }}</button>
                                                            <button type="submit" class="btn btn-primary">{{ __("Yes") }}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- delete Model ended -->
                                    </td>
                                </tr> 
                            @endforeach 
                            </tbody>
                        </table>
                        <!-- end table -->
                    </div>
                    <!-- end table div -->
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</div>
<!-- end contentbar -->                    
@endsection
<!--section end --> 
<!-- This section will contain javacsript start -->
@section('script')
<script>var url = @json(url('/'));</script>
<script src="{{ Module::asset('resume:js/job.js') }}"></script>
@endsection
<!-- This section will contain javacsript end -->