@extends('admin.layouts.master')
@section('title', 'QrSetting - Admin')
@section('maincontent')
<?php
$data['heading'] = 'QrSetting';
$data['title'] = 'QrSetting';
$data['title1'] = 'QrSetting';
?>
@include('admin.layouts.topbar',$data)
<div class="contentbar">
    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
      @foreach($errors->all() as $error)
      <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true" class="text-danger" >&times;</span></button></p>
      @endforeach
    </div>
    @endif
    <div class="row">
    <div class="col-lg-12">
        <div class="card dashboard-card m-b-30">
            <div class="card-header">
                <h5 class="card-title">{{ __('QrSetting') }}</h5>
            </div>
            <div class="card-body">
                <form class="form" action="{{ route('mobileqr.update') }}" method="POST" novalidate
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="text-dark" for="exampleInputSlug">{{ __('User QR') }}:
                            </label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"
                                        id="inputGroupFileAddon01">{{ __('Upload') }}</span>
                                </div>
                                <div class="custom-file">

                                    <input type="file" name="image" class="custom-file-input" id="img"
                                        aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label"
                                        for="inputGroupFile01">{{ __('Choose file') }}</label>
                                </div>
                            </div>
                            <img src="{{ url('/images/qr/'.$qrsetting->image) }}" height="100px;" width="100px;" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-dark" for="exampleInputSlug">{{ __('Instructor QR') }}:
                            </label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"
                                        id="inputGroupFileAddon01">{{ __('Upload') }}</span>
                                </div>
                                <div class="custom-file">

                                    <input type="file" name="image2" class="custom-file-input" id="img2"
                                        aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label"
                                        for="inputGroupFile01">{{ __('Choose file') }}</label>
                                </div>
                            </div>
                            <img src="{{ url('/images/qr/'.$qrsetting->image2) }}" height="100px;" width="100px;" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-dark" for="exampleInputSlug">{{ __('Demo Image') }}:
                            </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"
                                        id="inputGroupFileAddon01">{{ __('Upload') }}</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="demo_image" class="custom-file-input" id="demo"
                                        aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label"
                                        for="inputGroupFile01">{{ __('Choose file') }}</label>
                                </div>
                            </div>
                            <img src="{{ url('/images/qr/'.$qrsetting->demo_image) }}" height="100px;" width="100px;" />
                        </div>
                    </div>
                    <div class="form-group">
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