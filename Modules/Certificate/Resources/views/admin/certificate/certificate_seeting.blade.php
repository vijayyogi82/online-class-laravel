@extends('admin.layouts.master')
@section('title', 'Certificate Setting - Admin')
@section('maincontent')
<?php
$data['heading'] = 'Certificate Setting';
$data['title'] = 'Certificate Setting';
?>
@include('admin.layouts.topbar',$data)
<style>
    .error
    {
    color:red;
    font-family:verdana, Helvetica;
    }
</style>
<div class="contentbar">
    <div class="row">
@if ($errors->any())  
  <div class="alert alert-danger" role="alert">
  @foreach($errors->all() as $error)     
  <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true" style="color:red;">&times;</span></button></p>
      @endforeach  
  </div>
  @endif
  <!-- row started -->
    <div class="col-lg-12">
        <div class="card dashboard-card m-b-30">
                <!-- Card header will display you the heading -->
                <div class="card-header">
                    <h5 class="card-box">{{ __('Certificate Setting') }}</h5>
                </div> 
               
                <!-- card body started -->
                <div class="card-body">
                <form class="form" action="{{route('manage.certificate')}}" id="myform" method="POST" novalidate enctype="multipart/form-data">
						{{ csrf_field() }}
		                {{ method_field('POST') }}

                        <div class="row">
                            <div class="col-md-6">            
                                <div class="form-group">
                                    <label class="text-dark">{{ __('Percentage') }} : </label>
                                    <input name="percentage" id="field" type="number" class="form-control" value="{{$certificate->percentage}}" placeholder="Enter Percentage" required>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <button type="reset" class="btn btn-danger-rgba mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
                            <button type="submit" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
                                {{ __("Update")}}</button>
                        </div>
                        
                    </form>

                </div><!-- card body end -->
            
        </div><!-- col end -->
    </div>
</div>
</div><!-- row end -->
    <br><br>
@endsection
<!-- main content section ended -->
<!-- This section will contain javacsript start -->
@section('script')
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
$(function()
{
    $("#myform").validate(
      {
        rules: 
        {
          items: 
          {
            required: true,
            min:1
          },
          percentage: 
          {
            range:[1,100]
          }
        }
      });	
});
</script>
@endsection
<!-- This section will contain javacsript end -->