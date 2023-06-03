@extends('admin.layouts.master')
@section('title', 'Job Setting - Admin')
@section('maincontent')
<?php
$data['heading'] = 'Job Setting';
$data['title'] = 'Job Setting';
?>
@include('admin.layouts.topbar',$data)
<div class="contentbar">
    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $error)
        <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-danger">&times;</span></button></p>
        @endforeach
    </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card dashboard-card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">{{ __('Job Setting') }}</h5>
                </div>
                <div class="card-body">
                    <form class="form" action="{{ route('job.update') }}" method="POST" novalidate
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="text-dark">{{ __('Enable Search') }} :</label><br>
                            <input type="checkbox" class="custom_toggle" id="customSwitch1" name="job_enable"
                                {{ $jsetting->job_enable == 1 ? 'checked' : '' }} />
                        </div>
                        <small class="text-info"><i class="fa fa-question-circle"></i>
                            {{ __('If you enable it, Slider has been remove from home page') }} </small>
                        <div class="form-group mt-4">
                            <button type="reset" class="btn btn-danger-rgba mr-1"><i class="fa fa-ban"></i>
                                {{ __("Reset")}}</button>
                            <button type="submit" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
                                {{ __("Update")}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection