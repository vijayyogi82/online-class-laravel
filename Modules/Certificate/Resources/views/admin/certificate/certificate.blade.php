@extends('admin.layouts.master')
@section('title', 'Design Certificate')
@section('stylesheet')
<link rel="stylesheet" href="{{ Module::asset('certificate:css/custom_certificate.css') }}">
@endsection
@section('maincontent')
<?php
$data['heading'] = 'Design Certificate';
$data['title'] = 'Design Certificate';
?>
@include('admin.layouts.topbar',$data)
<div class="col-md-4 col-lg-4">
  <div class="widgetbar">
    <a href="{{ route('create.certificate') }}" class="float-right btn btn-primary-rgba mr-2"><i
        class="feather icon-plus mr-2"></i>{{ __('Create Certificate') }}</a>
  </div>
</div>
<div class="contentbar">
  <div class="row">
    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
      @foreach($errors->all() as $error)
        <p>
          {{ $error}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span class="text-red" aria-hidden="true">&times;</span></button>
        </p>
      @endforeach
    </div>
    @endif

    <!-- row started -->
    <div class="col-lg-12">
      <div class="card dashboard-card m-b-30">
        @include('admin.message')
        <!-- Card header will display you the heading -->

        <!-- card body started -->
        <div class="card-body">
          <!-- == certificate template start == -->
          <div class="container">
            <div class="row">
              <div class="col-lg-9">
                <div class="cirtificate-border-one text-center">
                  <div class="cirtificate-border-one-sub text-center">
                    <div class="cirtificate-border-two">
                      <div class="cirtificate-border-two-sub">
                        <div class="cirtificate-heading"> {{ __('frontstaticword.CertificateofCompletion') }}
                        </div>
                          @php
                            $mytime = Carbon\Carbon::now();
                          @endphp
                        <p class="cirtificate-detail font-30px">
                          {{ __('frontstaticword.Thisistocertifythat') }}<b> {{__("Admin Example")}} </b>
                          {{ __('frontstaticword.successfullycompleted') }} <b>
                            {{__("The Complete Web Developer Bootcamp")}} </b>
                          {{ __('frontstaticword.onlinecourseon') }} <br>

                          <span class="font-25px">
                            {{ __("16th November 2020") }}</span>

                        </p>

                        <span class="cirtificate-instructor">{{ __("Admin Example") }}</span>
                        <br>
                        <span class="cirtificate-one">{{ __("Admin Example,") }}
                          {{ __('frontstaticword.Instructor') }}</span>
                        <br>
                        <span>{{ __("&") }}</span>
                        <div class="cirtificate-logo">
                          @if($gsetting['logo_type'] == 'L')
                          <img src="{{ asset('images/logo/'.$gsetting['logo']) }}" class="img-fluid" alt="logo">
                          @else()
                          <a href="#"><b>
                              <div class="logotext">{{ __("project_title") }}</div>
                            </b></a>
                          @endif
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
              </div>
            </div>
          </div>
          <!-- == certificate template end == -->
        </div>
        <!-- card body end -->

      </div><!-- col end -->
    </div>
  </div>
</div><!-- row end -->
<br><br>
@endsection