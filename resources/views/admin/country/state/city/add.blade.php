@extends('admin.layouts.master')
@section('title', 'Add Cities - Admin')
@section('maincontent')
<?php
$data['heading'] = 'Add Cities';
$data['title'] = 'Add Cities';
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
  <div class="row">
    <div class="col-lg-12">
      <div class="card dashboard-card m-b-30">
        <div class="card-header">
          <h5 class="card-title"> {{ __('Add Cities') }}</h5>
          <div>
            <div class="widgetbar">
              <a href="{{url('admin/city')}}" class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
          
            </div>
          </div>
        </div>
        <div class="card-body">
          <form id="demo-form2" method="post" enctype="multipart/form-data" action="{{url('admin/city')}}" data-parsley-validate class="form-horizontal form-label-left">
            {{csrf_field()}}
            <div class="row">
              <div class="form-group col-md-6">
                <label for="exampleInputTit1e">{{ __('City') }}<sup class="redstar">*</sup></label>
                    <select class="select2-single form-control" name="state_id" required>
                      <option value="">{{ __('Choose State') }}:</option>
                      @foreach ($states as $state)
                      <option value="{{ $state->state_id }}">{{ $state->name }}</option>
                      @endforeach
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <button type="reset" class="btn btn-danger-rgba mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
                  <button type="submit" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
                  {{ __("Create")}}</button>
                </div>
    
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    
@endsection
                  

              


