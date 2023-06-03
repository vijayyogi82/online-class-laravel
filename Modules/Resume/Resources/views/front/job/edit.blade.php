@extends('theme.master')
@section('title', 'Edit Job')
@section('content')

@section('custom-head')
<link rel="stylesheet" href="{{ Module::asset('resume:css/edit.css') }}">
@endsection
@include('admin.message')

<!-- section start -->
<section  class="blog-home-main-block">
  <p class="ml-md-5">{{ __('Edit Job') }} <span class="name">[{{ filter_var($job->companyname) }}]</span></p>
</section> 
<!-- section end--> 
    
<!-- section start -->
<section id="blog" class="back">
    <!-- container start -->
    <div class="container">
      <!-- row start -->
        <div class="row justify-content-center">
          <!-- column start -->
            <div class="col-md-10 card bord mt-5  mb-5 ">

              <form method="post" id="msform" enctype="multipart/form-data"  action="{{ route('job.update',["id" => filter_var($job->id)])}}" >
                @csrf
                <div class="row mt-3">
                    <!-- compant name -->
                  <div class="form-group col-md-12">
                    <label for="">{{ __('Company Name') }}   <span class="text-danger">*</span></label>
                    <input type="text"  name="companyname" class="form-control" value="{{ filter_var($job->companyname) }}" required>
                  </div>

                    <!-- jon title-->
                  <div class="form-group col-md-12">
                    <label for="">{{ __('Job Title') }} <span class="text-danger">*</span></label>
                    <input type="text"  name="title" class="form-control" value="{{ filter_var($job->title) }}" required>
                  </div>

                    <!-- job description -->
                  <div class="form-group col-md-12">
                    <label for="">{{ __('Job Description') }} <span class="text-danger">*</span></label>
                    <textarea id="detail" name="description" class="form-control" value="">{{ filter_var($job->description) }} </textarea>
                  </div>

                    <!-- job requirement -->
                  <div class="form-group col-md-6">
                    <label for="">{{ __('Requirement') }} <span class="text-danger">*</span></label>
                    <input type="number"  name="requirement" class="form-control" value="{{ filter_var($job->requirement) }}" required>
                  </div>

                    <!-- job lacation-->
                  <div class="form-group col-md-6">
                    <label for="">{{ __('Location') }} <span class="text-danger">*</span></label>
                    <input type="text"  name="location" class="form-control" value="{{ filter_var($job->location) }}" required>
                  </div>

                    <!--experience-->
                  <div class="form-group col-md-12">
                    <label for="">{{ __('Experience') }} <span class="text-danger">*</span></label>
                    <div class="row">
                      <div class="col-md-4">
                        <input type="number"  name="minexp" class="form-control" value="{{ filter_var($job->min_experience) }}" required>
                      </div>
                      <div class="col-md-4">
                        <input type="number"  name="maxexp" class="form-control" value="{{ filter_var($job->max_experience) }}" required>
                      </div>
                      <div class="col-md-4">
                        <select name="experience" class="form-control" id="size">
                          <option value="{{ filter_var($job->experience) }}">{{ filter_var($job->experience) }}</option>
                          <option value="months">{{ __("Months") }}</option>
                          <option  value="years">{{ __("Years") }}</option>
                        </select>
                      </div>
                    </div>
                  </div>
                    
                    <!-- job role-->
                  <div class="form-group col-md-6">
                    <label for="">{{ __('Role') }} <span class="text-danger">*</span></label>
                    <input type="text"  name="role" class="form-control" value="{{ filter_var($job->role) }}" required>
                  </div>
                    <!-- job industry type -->
                  <div class="form-group col-md-6">
                    <label for="">{{ __('Industry Type') }} <span class="text-danger">*</span></label>
                    <input type="text"  name="industry_type" class="form-control" value="{{ filter_var($job->industry_type) }}" required>
                  </div>

                  <!-- job employment type -->
                  <div class="form-group col-md-6">
                    <label for="">{{ __('Employment Type') }} <span class="text-danger">*</span></label>
                    <input type="text"  name="employment_type" class="form-control" value="{{ filter_var($job->employment_type) }}"  required>
                  </div>

                  <!-- job image-->
                  <div class="form-group col-md-6">
                    <label class="control-label">{{ __("Image") }}</span></label>
                      <div class="custom-file">
                          <input type="file" class="custom-file-input" id="customFile" name="image">
                          <label class="custom-file-label" for="customFile">{{ __("Choose file") }}</label>
                      </div>
                  </div>

                  <!-- salary -->
                  <div class="form-group col-md-12">
                    <label for="">{{ __('Salary') }} </span></label>
                    <div class="row">
                      <div class="col-md-4">
                        <input type="number"  name="minsalary" class="form-control"  value="{{ filter_var($job->min_salary) }}">
                      </div>
                      <div class="col-md-4">
                        <input type="number"  name="maxsalary" class="form-control" value="{{ filter_var($job->max_salary) }}">
                      </div>
                      <div class="col-md-4">
                        <select name="salary" class="form-control" id="size">
                          <option value="{{ filter_var($job->salary) }}">{{ filter_var($job->salary) }}</option>
                          <option value="months">{{ __("P.A.") }}</option>
                          <option  value="years">{{ __("P.M.") }}</option>
                        </select>
                      </div>
                    </div>
                  </div>
                   <!-- job skills -->
                  <div class="form-group col-md-12">
                    <label for="">{{ __('Key Skills') }} <span class="text-danger">*</span></label>
                    <input type="text"  name="skills" class="form-control" value="{{ filter_var($job->skills) }}" required>
                  </div>

                  <!-- submit button -->
                  <div class="form-group col-md-12 text-right">
                    <button type="submit" class=" btn btn-danger" title="upload items">{{ __('Submit') }}</button>
                  </div>
                </div>
              </form>
            </div>
              <!-- column end -->
        </div>
        <!-- row end -->
    </div>
    <!-- container end-->
</section>
<!-- section end -->
@endsection

<!-- This section will contain javacsript start -->
@section('custom-script')
<script src="{{ Module::asset('resume:js/resume.js') }}"></script>
<script src="{{ Module::asset('resume:js/job.js') }}"></script>
<script src="{{ Module::asset('resume:js/append.js') }}"></script>
@endsection
<!-- This section will contain javacsript end -->