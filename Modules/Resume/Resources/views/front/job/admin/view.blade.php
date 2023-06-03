@extends('admin.layouts.master')
@section('title', __('Job view - Admin'))

@section('stylesheet')

<link rel="stylesheet" href="{{ Module::asset('resume:css/edit.css') }}">
@endsection
<!-- section start -->
@section('maincontent')
<?php
$data['heading'] = 'Job view';
$data['title'] = 'Job view';
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
                    <h5 class="card-title">{{ __('Job view')}}</h5>
                    <div>
                      <div class="widgetbar">
                        <!-- back button  -->
                        <a href="{{url('adminjob')}}"  class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
                        <!-- action button  start -->
                        <button class="btn btn-primary-rgba dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         {{ __("Action") }}
                       </button>
                       <!-- action button  end -->
                       <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item"  href="{{ route('job.approved',['id' => filter_var($job->id)]) }}" > <i class="feather icon-check-square"></i> {{ __("Approved") }}</a>
                          <a class="dropdown-item"  data-toggle="modal" data-target="#reject_{{ filter_var($job->id) }}"><i class="feather icon-x-square"></i> {{ __("Reject") }}</a>
                       </div>
                      </div>
                    </div>
                    <!-- action button  end -->       
                      
                    <!-- model start-->
                    <div class="modal fade" id="reject_{{ filter_var($job->id) }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog admin_model" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ __("Message") }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form method="post" id="msform" enctype="multipart/form-data"  action="{{ route('job.notapproved',["id" => filter_var($job->id)])}}" >
                          @csrf
                              <div class="modal-body">
                                  <textarea name="message" class="w-100 form-control" placeholder="{{ __("Please enter reason for rejection") }}" rows="5"></textarea>
                              </div>
                          
                              <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Close") }}</button>
                              <button type="submit" class="btn btn-primary">{{ __("Update") }}</button>
                              </div>
                         </form>
                        </div>
                      </div>
                    </div>
                </div>
                <!-- end card header -->
                <!-- Start card body -->
                  <div class="row ml-3 mt-0">
                    <!-- col start -->
                    <div class="col-10">
                       <!-- card start -->
                      <div class="card mt-3  mb-3 ">
                          <div class="row ml-2 mr-2 mt-3 mb-3">
                            <div class="col-md-10">
                              <h4 class="title">{{ filter_var($job->title) }}  <img src="{{ Module::asset('resume:image/verified.png') }}" class="img-fluid verfied" alt="image"></h4>
                              <p>{{ filter_var($job->companyname) }}</p>
                              <p class="p-color"> <i class="fa fa-suitcase text-muted mr-2"></i> {{ filter_var($job->min_experience) }} - {{ filter_var($job->max_experience) }} {{ filter_var($job->experience) }}</p>
                              <p class="p-color"> <i class="fa fa-money text-muted mr-2"></i> @if(filter_var($job->min_salary)) {{ filter_var($job->min_salary) }} - {{ filter_var($job->max_salary) }} {{ filter_var($job->salary) }} @else <p>{{ __("Not Disclosed") }}</p>@endif</p>
                              <p class="p-color">  <i class="fa fa-map-marker text-muted  mr-3" ></i>{{ filter_var($job->location) }}</p>
                            </div>
                             
                            <div class="col-md-2">
                              @if(filter_var($job->image))
                                <img src="{{ asset('files/job/'.filter_var($job->image)) }}" class="img-fluid job-image" alt="image">
                                @else
                                <img src="{{ Module::asset('resume:image/noimage.jpg') }}" class="img-fluid job-image" alt="image">
                              @endif
                            </div>
                          </div>
                      </div>
                      <div class="card mt-3  mb-3">
                        <div class="row ml-2 mr-2 mt-3 mb-3">
                          <div class="col-md-12">
                            <h5 class="title">{{ __("Description") }}</h5>
                           
                            <p class="p-color">{{ filter_var($job->description) }}
                            <p class="p-color mt-5"><span class="s-color mr-5">{{ __("Role") }}</span> <span class="s-left">{{ filter_var($job->role) }}</span></p>
                            <p class="p-color"><span  class="s-color" >{{ __("Industry Type") }}</span> <span  class="s-left1">{{ filter_var($job->industry_type) }}</span> </p>
                             
                            <p class="p-color"><span  class="s-color">{{ __("Employment Type") }} </span> <span  class="s-left2">{{ filter_var($job->employment_type) }}</span></p>
                            <h5 class="title mt-4">{{ __("Key Skills") }}</h5>
                            <p class="p-color mt-2">{{ str_replace(',', '    .    ', ($job->skills))}}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                    <!-- col end -->
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