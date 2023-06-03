@extends('admin.layouts.master')
@section('title',__('Edit Homework- Admin'))
@section('maincontent')
<?php
$data['heading'] = 'Edit Homework';
$data['title'] = 'Homework';
$data['title1'] = 'Edit Homework';
?>
@include('admin.layouts.topbar',$data)
<!-- Container start-->
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
            <!-- card  start --> 
            <div class="card dashboard-card m-b-30">
                <!-- card header start --> 
                <div class="card-header">
                  <h5 class="card-title"> {{__("Edit Homework")}}</h5>
                  <div>
                    <div class="widgetbar">
                      <a href="{{ route('homework.index',["id" => $course->id])}}" class="btn btn-primary-rgba mr-2"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
                     </div>
                  </div>
                </div>
                 <!-- card header end -->
                 <!-- card body start --> 
                <div class="card-body">
                     <!-- form start --> 
                    <form method="post" enctype="multipart/form-data" action="{{ route('homework.update',["id" => $homework->id,"cat" =>$course->id])}}" >
                    @csrf
                    <div class="row">
                         <!-- title --> 
                        <div class="col-md-12 form-group">
                            <label>{{ __("Title")}}<sup class="redstar">*</sup></label>
                            <input  class="form-control" value="{{ filter_var($homework->title) }}" name="title" placeholder="{{ __("Please Enter Homework Title") }}">
                        </div>
                        <!-- description--> 
                        <div class="col-md-12 form-group">
                            <label>{{ __("Description")}}<sup class="redstar">*</sup></label>
                            <textarea   class="form-control col-md-12" rows="4" class="" name="description" placeholder="{{ __("Please Enter Homework Description") }}">{{ filter_var($homework->description) }}</textarea>
                        </div>
                        <!--Submission date--> 
                        <div class="form-group col-md-6" >
                            <label>
                                {{ __('Submission Date :') }}<sup class="redstar">*</sup>
                            </label>
                            <div class="input-group" id='datetimepicker1'>
                                <input type="text" name="endtime"   id="time-format1" class="form-control" value="{{ filter_var($homework->endtime) }}" placeholder="{{ __("dd/mm/yyyy - hh:ii aa") }}" aria-describedby="basic-addon5" />
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon5"><i class="feather icon-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                         <!--Out of marks--> 
                         <div class="col-md-6 form-group">
                            <label>{{ __("Out of marks")}}<sup class="redstar">*</sup></label>
                            <input  class="form-control" value="{{ filter_var($homework->marks) }}" name="marks" placeholder="{{ __("Out of marks") }}">
                        </div>
                         <!--Status button--> 
                        <div class="col-md-6 form-group">
                            <label> {{ __('Status :') }}</label><br>
                            <label class="switch">
                                <input class="slider" type="checkbox" id="toggle-event3" name="status" {{ filter_var($homework->status) == '1' ? 'checked' : '' }}>
                                <span class="knob"></span>
                            </label>
                        </div>
                         <!--Compulsory button--> 
                        <div class="col-md-6 form-group">
                            <label> {{ __('Compulsory :') }}</label><br>
                            <label class="switch">
                                <input class="slider" type="checkbox" id="toggle-event3" name="compulsory" {{ filter_var($homework->compulsory) == '1' ? 'checked' : '' }}>
                                <span class="knob"></span>
                            </label>
                        </div>
                        <!--Reset and  Create button --> 
                        <div class="col-md-12 form-group">
                            <button type="reset" class="btn btn-danger mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>
                            {{ __("Update")}}</button>
                        </div>
                    </div>
                    </form>
                     <!-- form end --> 

                </div>
                <!-- card body end --> 
            </div>
            <!-- card end --> 
        </div>
        <!-- column end --> 
    </div>
    <!--row end -->  
</div>
<!-- Container end-->
@endsection
<!--end section -->
