@extends('admin.layouts.master')
<!-- section  start -->
@section('title',__('Create Homework- Admin'))
@section('maincontent')
<?php
$data['heading'] = 'Create Homework';
$data['title'] = 'Homework';
$data['title1'] = 'Create Homework';
?>
@include('admin.layouts.topbar',$data)
<!-- back button start-->
<!-- container start -->
<div class="contentbar">   
    @if ($errors->any())  
    <div class="alert alert-danger" role="alert">
    @foreach($errors->all() as $error)     
    <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span></button></p>
        @endforeach  
    </div>
    @endif
    <!-- row start -->
    <div class="row">
        <!-- column start -->
        <div class="col-lg-12">
            <div class="card dashboard-card m-b-30">
                <!-- card header start -->
                <div class="card-header">
                  <h5 class="card-title"> {{__("Create Homework")}}</h5>
                  <div>
                    <div class="widgetbar">
                      <a href="{{ route('homework.index',["id" => $course->id])}}" class="btn btn-primary-rgba mr-2"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
                    </div>
                  </div>
                </div>
                <!-- card header end -->
                <!-- card body  start -->
                <div class="card-body">
                    <!-- form start -->
                    <form method="post" enctype="multipart/form-data" action="{{ route('homework.store')}}" >
                    @csrf
                    <!-- row start -->
                    <div class="row">
                        <!-- title --> 
                        <div class="col-md-12 form-group">
                            <label>{{ __("Title:")}}<sup class="redstar">*</sup></label>
                            <input  class="form-control" name="title" placeholder="{{ __("Please enter homework title") }}">
                        </div>
                        <!-- description --> 
                        <div class="col-md-12 form-group">
                            <label>{{ __("Description:")}}<sup class="redstar">*</sup></label>
                            <textarea   class="form-control col-md-12" rows="4" class="" name="description" placeholder="{{ __("Please enter homework description") }}"></textarea>
                        </div>
                        <!-- pdf --> 
                        <div class="col-md-6 form-group">
                            <label for="first-name">{{ __("Choose Pdf/Zip:")}}<sup class="redstar">*</sup></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">{{ __("Upload")}}</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="homework" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">{{ __("Choose file")}}</label>
                                </div>
                            </div>
                        </div>
                         <!--Submission Date  --> 
                        <div class="form-group col-md-6" >
                            <label>
                                {{ __('Submission Date :') }}<sup class="redstar">*</sup>
                            </label>
                            <div class="input-group" id='datetimepicker1'>
                                <input type="text" name="endtime" id="time-format1" class="form-control" placeholder="{{ __("dd/mm/yyyy - hh:ii aa") }}" aria-describedby="basic-addon5" />
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon5"><i class="feather icon-calendar"></i></span>
                                </div>
                            
                            </div>
                        </div>
                        <div class="form-group col-md-6" >
                            <label>
                                {{ __('Out of marks :') }}<sup class="redstar">*</sup>
                            </label>
                            <input  class="form-control" name="marks" type="number" placeholder="{{ __("Out of marks") }}">
                        </div>
                         
                        <div class="col-md-6 form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <!--Status -->
                                    <label> {{ __('Status :') }}</label><br>
                                    <label class="switch">
                                        <input class="slider" type="checkbox" id="toggle-event3" name="status" checked>
                                        <span class="knob"></span>
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <!--Compulsory -->
                                    <label> {{ __('Compulsory :') }}</label><br>
                                    <label class="switch">
                                        <input class="slider" type="checkbox" id="toggle-event3" name="compulsory" checked>
                                        <span class="knob"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!--User id  --> 
                        <div class="d-none">
                            <input  value="{{ Auth::user()->id }}" name="user_id" >
                        </div>
                        <!--Course id --> 
                        <div class="d-none">
                            <input name="course_id" value="{{ filter_var($course->id) }}" name="course_id"/>
                        </div>
                        <!--Reset and  Create button --> 
                        <div class="col-md-12 form-group">
                            <button type="reset" class="btn btn-danger mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>
                            {{ __("Create")}}</button>
                        </div>
                    </div>
                    <!-- row end -->
                    </form>
                    <!-- form end -->
                </div>
                <!-- card body end -->
            </div>
        </div>
       <!-- column end -->
    </div>
     <!-- row end -->
</div>
<!-- end container -->
@endsection
<!-- end section -->
