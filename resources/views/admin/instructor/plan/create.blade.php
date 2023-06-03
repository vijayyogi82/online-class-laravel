@extends('admin.layouts.master')
@section('title', 'Add Instructor Plan - Admin')
@section('maincontent')
<?php
$data['heading'] = 'Instructor Plan';
$data['title'] = 'Instructor Plan';
$data['title1'] = 'Add Instructor Plan';
?>
@include('admin.layouts.topbar',$data)
<div class="contentbar">
@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
<div class="row">
    <div class="col-lg-12">
      <div class="card dashboard-card m-b-30">
        <div class="card-header">
          <h5 class="card-title">{{ __('Add Instructor Plan') }}</h5>
          <div>
            <div class="widgetbar">
              <a href="{{url('subscription/plan')}}" class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="form-group">
            <form action="{{action('InstructorPlanController@store')}}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" class="form-control" name="user_id" id="exampleInputTitle" value="{{ Auth::User()->id }}" required>
                <div class ="row">
                <div class="form-group col-lg-4 col-md-6">
                  <label for="exampleInputTit1e">{{ __('Title') }}: <sup class="redstar">*</sup></label>
                  <input type="title" class="form-control" name="title" id="exampleInputTitle" placeholder="{{ __('Enter') }} {{ __('Title') }}" value="" required>

                </div>
                <div class="col-lg-4 col-md-6">
                  <label for="exampleInputSlug">{{ __('Image') }}:<sup class="redstar">*</sup></label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroupFileAddon01">{{ __('Upload') }}</span>
                    </div>
                    <div class="custom-file">
                      <input type="file"name="preview_image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                      <label class="custom-file-label" for="inputGroupFile01">{{ __('Choose file') }}</label>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6">
                  <label for="exampleInputSlug">{{ __('No of Courses allowed in this plan') }}:</label>
                  <input min="1" class="form-control" name="courses_allowed" type="number" id="courses_allowed"  placeholder="" value="{{ (old('courses_allowed')) }}">
                </div>
              </div>
                </div>
                <div class="col-md-12">
                  <label for="exampleInputTit1e">{{ __('Detail') }}: <sup class="redstar">*</sup></label>
                  <textarea id="detail" name="detail" rows="5"  class="form-control" placeholder="{{ __('Enter') }} {{ __('Detail') }}"></textarea>
                </div>
                <br>
                <div class="row"> 
                <div class="col-md-4">
                  <label for="exampleInputDetails">{{ __('Paid') }}:</label>                 
                  <input type="checkbox" class="custom_toggle" id="cb111" name="type" />
                  <label class="tgl-btn" data-tg-off="{{ __('Free') }}" data-tg-on="{{ __('Paid') }}" for="cb111"></label>
                  <br>
                  <div style="display: none;" id="pricebox">
                    <label for="exampleInputSlug">{{ __('Price') }}: <sup class="redstar">*</sup></label>
                    <input type="number" step="0.01" class="form-control" name="price" id="priceMain" placeholder="{{ __('Enter') }} {{ __('Price') }}" value="{{ (old('price')) }}">
        
                    <label for="exampleInputSlug">{{ __('DiscountPrice') }}: </label>
                    <input type="number" step="0.01" class="form-control" name="discount_price" id="offerPrice" placeholder="{{ __('Enter') }} {{ __('DiscountPrice') }}" value="{{ (old('discount_price')) }}">
                  </div>
                </div>
                <div class="col-md-4">
                  @if(Auth::User()->role == "admin")
                   <label for="exampleInputDetails">{{ __('Status') }}:</label>
                  <input  id="status" type="checkbox" name="status" class="custom_toggle" checked />
                  <input type="hidden"  name="free" value="0" for="status" id="status">
                  @endif
                </div>
                <div class="col-md-4">
                  <label for="exampleInputSlug">{{ __('CourseExpireDuration') }}</label>
                  <div class="row">
                    <div class="col-lg-8">
                      <input min="1" class="form-control" name="duration" type="number" id="duration"  placeholder="{{ __('Enter') }} {{ __('CourseExpireDuration') }}" value="{{ (old('duration')) }}">
                    </div>
                    <div class="col-lg-4">
                      <select name="duration_type" class="form-control" id="exampleFormControlSelect1">
                        <option value="d">{{ __('days') }}</option>
                        <option value="m">{{ __('months') }}</option>
                      </select>
                      <small class="text-muted"><i class="fa fa-question-circle"></i> {{ __('If enabled duration can be in months') }},</small>
                      <small class="text-muted"> {{ __('when Disabled duration can be in days') }}.</small>
                    </div>
                  </div>
                   
                  <br>   
                  
                </div>
              </div>
              <br>
             
              <div class="box-footer">
                <button type="submit" class="btn btn-lg col-md-4 btn-primary-rgba">{{ __('Submit') }}</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box -->
      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</div>
@endsection
@section('scripts')
<script>
(function($) {
"use strict";
$(function() {
    $('.js-example-basic-single').select2();
  });

  $(function() {
    $('#cb1').change(function() {
      $('#j').val(+ $(this).prop('checked'))
    })
  })

  $(function() {
    $('#cb3').change(function() {
      $('#test').val(+ $(this).prop('checked'))
    })
  })
  $('#cb111').on('change',function(){

    if($('#cb111').is(':checked')){
      $('#pricebox').show('fast');

      $('#priceMain').prop('required','required');

    }else{
      $('#pricebox').hide('fast');

      $('#priceMain').removeAttr('required');
    }

  });

  $('#preview').on('change',function(){

    if($('#preview').is(':checked')){
      $('#document1').show('fast');
      $('#document2').hide('fast');
    }else{
      $('#document2').show('fast');
      $('#document1').hide('fast');
    }

  });

  $("#cb3").on('change', function() {
    if ($(this).is(':checked')) {
      $(this).attr('value', '1');
    }
    else {
      $(this).attr('value', '0');
    }});

  $(function(){

      $('#ms').change(function(){
        if($('#ms').val()=='yes')
        {
            $('#doabox').show();
        }
        else
        {
            $('#doabox').hide();
        }
      });

  });

  $(function(){

      $('#ms').change(function(){
        if($('#ms').val()=='yes')
        {
            $('#doaboxx').show();
        }
        else
        {
            $('#doaboxx').hide();
        }
      });

  });

  $(function(){

      $('#msd').change(function(){
        if($('#msd').val()=='yes')
        {
            $('#doa').show();
        }
        else
        {
            $('#doa').hide();
        }
      });

  });
})(jQuery);
</script>

@endsection
