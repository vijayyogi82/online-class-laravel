@extends('admin.layouts.master')
@section('title', __('Forum & Discussion Addon'))
@section('maincontent')
<?php
$data['heading'] = 'Forum & Discussion';
$data['title1'] = 'Forum & Discussion';
?>
@include('admin.layouts.topbar',$data)
<div class="contentbar">
  <div class="row">
    <div class="col-lg-12">
      @if ($errors->any())
      <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $error)
        <p>
          {{ $error}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </p>
        @endforeach
      </div>
      @endif
      <div class="card dashboard-card m-b-30">
        <div class="card-header">
          <h5 class="box-title">{{ __('Forum & Discussion Addon') }}</h5>
        </div>
        <div class="card-body ml-2">
          <!-- main content start -->
          <!-- row start -->
          <div class="row">
            <!-- Status -->
            <div class="col-md-6">
              <div class="form-group">
                <label class="text-dark" for="exampleInputDetails">{{ __('Enable/Disable Community')}} </label><br>
                <label class="switch">
                  <input class="slider" type="checkbox" id="customSwitch1" data-id="{{ strip_tags($forumstatus->id) }}"
                    name="status" {{ $forumstatus->forum_enable == 1 ? "checked" : "" }} />
                  <span class="knob"></span>
                </label>
              </div>
            </div>
          </div>
          <!-- row end -->
          <!-- main content end -->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
  var url = @json(route('forum.changeStatus'));
</script>
<script src="{{ Module::asset('forum:js/check.js') }}"></script>
@endsection
