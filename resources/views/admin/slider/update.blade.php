@extends('admin.layouts.master')
@section('title', 'Edit Slider - Admin')
@section('maincontent')
<?php
$data['heading'] = 'Edit Slider';
$data['title'] = 'Slider';
$data['title1'] = 'Mobile Setting';
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
            <h5 class="card-title">{{ __("Edit Slider")}} </h5>
            <div>
              <div class="widgetbar">
                <a href="{{url('slider')}}" class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
          </div>
            </div>
          </div>
          <div class="card-body">
            
            <form id="demo-form" method="post"  action="{{url('slider/'.$cate->id)}}
              "data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
            
            <div class="row">
              <div class="form-group col-md-6">
                <label for="exampleInputTit1e">{{ __('Heading') }}:<sup class="redstar">*</sup></label>
                  <input type="text" class="form-control" name="heading" id="exampleInputTitle" value="{{$cate->heading}}">
                
              </div>
              <div class="form-group col-md-6">
                <label for="exampleInputTit1e">{{ __('SubHeading') }}:<sup class="redstar">*</sup></label>
                <input type="text" class="form-control" name="sub_heading" id="exampleInputTitle" value="{{$cate->sub_heading}}">
              </div>

              <div class="d-none">
                <label for="exampleInputTit1e d-none">{{ __('SearchText') }}:<sup class="redstar">*</sup></label>
                <input type="text" class="form-control display-none" name="search_text" id="exampleInputTitle" value="0">
              </div>
              <div class="form-group col-md-12">
                <label for="exampleInputTit1e">{{ __('Detail') }}:<sup class="redstar">*</sup></label>
                <input type="text" class="form-control" name="detail" id="exampleInputTitle" value="{{$cate->detail}}">
              </div>


              @if(Auth::user()->role == 'instructor')
              <div class="form-group col-md-6">
                <label>{{ __('Image') }}:<sup class="redstar text-danger">*</sup></label>
                <small class="text-muted"><i class="fa fa-question-circle"></i> {{ __('Recommendedsize') }} (1375 x 409px)</small>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">{{__('Upload')}}</span>
                  </div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="image" aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">{{__('Choose file')}}</label>
                    
                  </div>
                </div>
                <img src="{{ url('/images/slider/'.$cate->image) }}" class="image_size"/>
                </div>

                @endif

                 @if(Auth::user()->role == 'admin')
                <div class="form-group col-md-6">
                  <label class="control-label" for="first-name">{{__('Image')}} <span
                      class="required">*</span> </label>
                 
                      <div class="input-group">

                        <input required readonly id="image" name="image" type="text"
                            class="form-control">
                        <div class="input-group-append">
                            <span data-input="image"
                                class="bg-primary text-light midia-toggle input-group-text">{{__('Browse')}}</span>
                        </div>
                      </div>

                    
                      <br>
                      <img src="{{ url('/images/slider/'.$cate->image) }}"
                      class="image_size" />
                </div>

                @endif
            
              
              <div class="form-group col-md-2">
                <label for="exampleInputTit1e">{{ __('Status') }}:</label><br>
                <input type="checkbox" class="custom_toggle" name="status" {{ $cate->status == '1' ? 'checked' : '' }} />
                <input type="hidden"  name="free" value="0" for="status" id="status">
              </div>
               
              
              <div class="form-group col-md-2">
                <label for="exampleInputTit1e">{{ __('TextPosition') }}:</label><br>
                  <input  class="custom_toggle"   type="checkbox" name="left" {{ $cate->left == '1' ? 'checked' : '' }} />
                  <input type="hidden"  name="free" value="0" for="left" id="left">
                  
                
              </div>
              <div class="form-group col-md-2">
                <label for="exampleInputTit1e">{{ __('Enable Search on Slider') }}:</label><br>
                 
                  <input  type="checkbox" name="search_enable" {{ $cate->search_enable == '1' ? 'checked' : '' }}  class="custom_toggle"/>
                  <input type="hidden"  name="free" value="0" for="search_enable" id="search_enable">
              
              </div>
            </div>
            <div class="form-group">
              <button type="reset" class="btn btn-danger-rgba mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
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


@section('script')
    <script>
        $(".midia-toggle").midia({
            base_url: '{{url('')}}',
            title : 'Choose Slider Image',
        dropzone : {
          acceptedFiles: '.jpg,.png,.jpeg,.webp,.bmp,.gif'
        },
            directory_name : 'slider'
        });
    </script>
@endsection