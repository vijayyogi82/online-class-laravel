@extends('theme.master')
<!--title section-->
@section('title', __('Job'))
<!--section start-->
@section('content')
<!-- css section start-->
@section('custom-head')
<link rel="stylesheet" href="{{ Module::asset('resume:css/resume.css') }}">
<link rel="stylesheet" href="{{ Module::asset('resume:css/view.css') }}">
@endsection
<!-- css section end-->
@include('admin.message')
<!-- container fluid  start -->
<div class="container-fluid back" id="grad1">
  <!-- row start -->
  <div class="row ml-3 mt-0">
    <!-- col start -->
    <div class="col-md-8">
      <!-- card start -->
      <div class="card mt-3  mb-3 ">
        <div class="row ml-2 mr-2 mt-3 mb-3">
          <div class="col-md-10">
            <h4 class="title">{{ filter_var($job->title) }} <img src="{{ Module::asset('resume:image/verified.png') }}"
                class="img-fluid verfied" alt="image"></h4>
            <p>{{ filter_var($job->companyname) }}</p>
            <p class="p-color"> <i class="fa fa-suitcase text-muted mr-2"></i> {{ filter_var($job->min_experience) }} -
              {{ filter_var($job->max_experience) }} {{ filter_var($job->experience) }}</p>
            <p class="p-color"> <i class="fa fa-money text-muted mr-2"></i> @if(filter_var($job->min_salary))
              {{ filter_var($job->min_salary) }} - {{ filter_var($job->max_salary) }} {{ filter_var($job->salary) }}
              @else {{ __("Not Disclosed") }}@endif</p>
            <p class="p-color"> <i class="fa fa-map-marker text-muted  mr-3"></i>{{ filter_var($job->location) }}</p>
            <p class="p-color mt-3"><span class="date-color"><i class="fa fa-clock-o mr-1"
                  aria-hidden="true"></i>{{ filter_var($job->created_at->diffForHumans()) }}</span>
              <span class="date-color ml-2">{{ __("Requirement") }} &nbsp;{{ filter_var($job->requirement) }}</span>
              <span class="date-color ml-2">{{ __("Job Applicants") }}
                &nbsp;{{ filter_var($job->postjob->count()) }}</span>
            </p>
          </div>
          <div class="col-md-2">
            <?php
              $photo =  Modules\Resume\Models\Applyjob::where('user_id', Auth::user()->id)->count();
              ?>
            @if(filter_var($job->image))
            <img src="{{ asset('files/job/'.filter_var($job->image)) }}" class="img-fluid job-image" alt="image">
            @else
            <img src="{{ Module::asset('resume:image/noimage.jpg') }}" class="img-fluid job-image" alt="image">
            @endif
            @if(filter_var($job->user_id) == Auth::user()->id)
            <span class="badge badge-pill badge-info apply-button2">{{ __("You posted this job")}}</span>
            @elseif($photo == 1)
            <span class="badge badge-pill badge-success apply-button2">{{ __("Already Applied") }}<i
                class="fa fa-check-square-o ml-1" aria-hidden="true"></i></span>
            @else
            <button type="button" data-toggle="modal" data-target="#exampleModal"
              class="apply-button btn-sm btn btn-info">{{ __("Apply") }}</button>
            @endif
          </div>
        </div>
      </div>

      <div class="card mt-3  mb-3">
        <div class="row ml-2 mr-2 mt-3 mb-3">
          <div class="col-md-12">
            <h5 class="title">{{ __("Description") }}</h5>

            <p class="p-color">{!! filter_var($job->description) !!}
              <p class="p-color mt-5"><span class="s-color mr-5">{{ __("Role") }}</span> <span
                  class="s-left">{{ filter_var($job->role) }}</span></p>
              <p class="p-color"><span class="s-color">{{ __("Industry Type") }}</span> <span
                  class="s-left1">{{ filter_var($job->industry_type) }}</span> </p>

              <p class="p-color"><span class="s-color">{{ __("Employment Type") }} </span> <span
                  class="s-left2">{{ filter_var($job->employment_type) }}</span></p>
              <h5 class="title mt-4">{{ __("Key Skills") }}</h5>
              <p class="p-color mt-2">{{ str_replace(',', '    .    ', ucfirst(trans($job->skills)) )}}</p>

          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <!-- card start -->
      <div class="card mt-3 mb-3 ">
        <!-- row start -->
        <div class="row ml-2 mr-2 mt-3 mb-3">

          <div class="col-md-12">
            <h5></i>{{ __("Company") }}</h5>
            <hr>
            <div class="row">
              <?php
                $photo =  Modules\Resume\Models\Postjob::where('status', 1)->take(9)->get();
                ?>
              @foreach ($photo as $item)
              @if(filter_var($item->image))
              <div class="col-4">
                <img src="{{ asset('files/job/'.filter_var($item->image)) }}" class="img-fluid company-image"
                  alt="image">
              </div>
              @endif
              @endforeach
            </div>
          </div>
        </div>
        <!-- row end -->
      </div>
      <!-- card end -->

    </div>
    <!-- col end -->
  </div>
  <!-- row end -->
</div>
<!-- container fluid  end -->

<!-- Apply for job  Model start-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <!-- model dialog start-->
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __("Apply") }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="msform" enctype="multipart/form-data"
        action="{{ route('job.applyjob',["id" =>filter_var($job->id)])}}">
        @csrf
        <div class="modal-body">

          <div class="row">
            <div class="col-md-12 from-group">
              <label for="">{{ __('Total Experience') }} <span class="text-danger">*</span></label>
              <div class="row">
                <div class="col-md-6 exp">
                  <input type="number" name="experience" class="form-control" placeholder="{{ __("") }}">
                </div>
                <div class="col-md-6 exp">
                  <select name="years" class="form-control" id="size">
                    <option value="months">{{ __("Months") }}</option>
                    <option value="years">{{ __("Years") }}</option>
                  </select>
                </div>
              </div>
              <input type="checkbox" class="mt-3 fresher"> {{ __("Fresher") }}
            </div>
            <div class="col-md-12 from-group mt-3">
              <label for="">{{ __('Key Skills') }} <span class="text-danger">*</span></label>
              <textarea type="text" name="skills" class="form-control" placeholder="{{ __("Keys Skills") }}"
                required></textarea>
            </div>
            <div class="col-md-12 mt-3">
              <div class="form-group upload_resume">
                <label class="control-label">{{ __("Upload Resume") }} <span
                    class="text-danger">*</span></label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="customFile" name="pdf">
                  <label class="custom-file-label" for="customFile">{{ __("Choose file") }}</label>
                </div>
              </div>
              <?php
                  $persoanl =  Modules\Resume\Models\Personalinfo::where('user_id',Auth::user()->id)
                                                                   ->where('status' ,1)->count();
                  ?>
              @if(filter_var($persoanl) == 1)
              <input type="checkbox" class="job"> {{ __("Upload internal resume") }}
              @endif

            </div>

          </div>
        </div>
        <div class="modal-footer">

          <button type="submit" class="btn btn-info">{{ __("Submit") }}</button>
        </div>
      </form>
    </div>
  </div>
  <!-- model dialog end -->
</div>
<!-- Apply for job  Model end-->

@endsection
<!-- main section end -->

<!-- This section will contain javacsript start -->
@section('custom-script')
<script src="{{ Module::asset('resume:js/resume.js') }}"></script>
<script src="{{ Module::asset('resume:js/append.js') }}"></script>
@endsection
<!-- This section will contain javacsript end -->