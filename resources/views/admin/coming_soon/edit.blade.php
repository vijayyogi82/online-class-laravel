@extends('admin.layouts.master')
@section('title', 'Coming Soon - Admin')
@section('maincontent')
<?php
$data['heading'] = 'Coming Soon';
$data['title'] = 'Coming Soon';
?>
@include('admin.layouts.topbar',$data)
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
                    <h5 class="card-box">{{ __('ComingSoon') }}</h5>
                </div> 
               <!-- card body started -->
                <div class="card-body">
                <!-- form for coming soon start -->
				<form action="{{ action('ComingSoonController@update') }}" method="POST" enctype="multipart/form-data">
		                {{ csrf_field() }}
		                {{ method_field('PUT') }}
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<!-- Heading -->
												<div class="col-md-6">
													<div class="form-group">
														<label class="text-dark">{{ __('Heading') }} : <span class="text-danger">*</span></label>
														<input type="text" value="{{ optional($comingsoon)->heading }}" autofocus="" class="form-control @error('heading') is-invalid @enderror" placeholder="{{ __('Enter') }} {{ __('Heading') }}" name="heading" required="">
														@error('heading')
															<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
													</div>
												</div>
												
													<!-- ButtonText -->
													<div class="col-md-6">
														<div class="form-group">
															<label class="text-dark">{{ __('ButtonText') }} : <span class="text-danger">*</span></label>
															<input type="text" value="{{ optional($comingsoon)->btn_text }}" autofocus="" class="form-control @error('btn_text') is-invalid @enderror" placeholder="{{ __('Enter') }} {{ __('ButtonText') }}" name="btn_text" required="">
															@error('btn_text')
																<span class="invalid-feedback" role="alert">
																	<strong>{{ $message }}</strong>
																</span>
															@enderror
														</div>
													</div>
													
													<div class="col-md-3">
														<div class="form-group">
															<label class="text-dark" for="count_one">{{ __('CounterOne') }} <span class="text-danger">*</span></label>
															<input value="{{ optional($comingsoon)->count_one }}" autofocus="" type="text" name="count_one" class="form-control @error('count_one') is-invalid @enderror" placeholder="{{ __('Enter') }} {{ __('CounterOne') }}" required>
															@error('count_one')
																<span class="invalid-feedback" role="alert">
																	<strong>{{ $message }}</strong>
																</span>
															@enderror
														</div>
													</div>
													<!-- CounterTwo -->
													<div class="col-md-3">
														<div class="form-group">
															<label class="text-dark" for="count_two">{{ __('CounterTwo') }} <span class="text-danger">*</span></label>
															<input value="{{ optional($comingsoon)->count_two }}" autofocus="" type="text" name="count_two" class="form-control @error('count_one') is-invalid @enderror" placeholder="{{ __('Enter') }} {{ __('CounterTwo') }}" required>
														</div>
													</div>

													<!-- CounterThree -->
													<div class="col-md-3">
														<label class="text-dark" for="count_three">{{ __('CounterThree') }} <span class="text-danger">*</span></label>
														<input value="{{ optional($comingsoon)->count_three }}" type="text" name="count_three" class="form-control" placeholder="{{ __('Enter') }} {{ __('CounterThree') }}" required>
													</div>

													<!-- CounterFour -->
													<div class="col-md-3">
														<div class="form-group">
															<label class="text-dark" for="count_four">{{ __('CounterFour') }} <span class="text-danger">*</span></label>
															<input type="text" name="count_four" class="form-control" value="{{ optional($comingsoon)->count_four }}" placeholder="{{ __('Enter') }} {{ __('CounterFour') }}" required/>
															
															@error('count_four')
																<span class="invalid-feedback" role="alert">
																	<strong>{{ $message }}</strong>
																</span>
															@enderror
														</div>
													</div>   

											</div>
										</div>
									</div>

									<hr>
										<div class="row">
											<!-- CounterOne Text -->
											<div class="col-md-3">
												<div class="form-group">
													<label class="text-dark" for="text_one">{{ __('CounterOne') }} {{ __('Text') }} <span class="text-danger">*</span></label>
													<input type="text" name="text_one" class="form-control" value="{{ optional($comingsoon)->text_one }}" placeholder="{{ __('Enter') }} {{ __('CounterOne') }}" required/>
													@error('text_one')
														<span class="invalid-feedback" role="alert">
															<strong>{{ $message }}</strong>
														</span>
													@enderror
												</div>
											</div>   

											<!-- CounterTwo Text -->
											<div class="col-md-3">
												<div class="form-group">
													<label class="text-dark" for="text_two">{{ __('CounterTwo') }} {{ __('Text') }} <span class="text-danger">*</span></label>
													<input value="{{ optional($comingsoon)->text_two }}" name="text_two" type="text" class="form-control" placeholder="{{ __('Enter') }} {{ __('CounterTwo') }}" required/>
													@error('text_two')
														<span class="invalid-feedback" role="alert">
															<strong>{{ $message }}</strong>
														</span>
													@enderror
												</div>
											</div>   

											<!-- CounterThree Text -->
											<div class="col-md-3">
												<div class="form-group">
													<label class="text-dark" for="text_three">{{ __('CounterThree') }} {{ __('Text') }}<span class="text-danger">*</span></label>
													<input value="{{ optional($comingsoon)->text_three }}" name="text_three" type="text" class="form-control" placeholder="{{ __('Enter') }} {{ __('CounterThree') }}" required/>
													@error('text_three')
														<span class="invalid-feedback" role="alert">
															<strong>{{ $message }}</strong>
														</span>
													@enderror
												</div>
											</div>   

											<!-- CounterFour Text -->
											<div class="col-md-3">
												<div class="form-group">
													<label class="text-dark" for="text_four">{{ __('CounterFour') }} {{ __('Text') }} <span class="text-danger">*</span></label>
													<input value="{{ optional($comingsoon)->text_four }}" name="text_four" type="text" class="form-control" placeholder="{{ __('Enter') }} {{ __('CounterFour') }}" required/>
													@error('text_four')
														<span class="invalid-feedback" role="alert">
															<strong>{{ $message }}</strong>
														</span>
													@enderror
												</div>
											</div>  

										</div>
									<!-- ============================ -->
									<hr>
										<div class="row">
											<!-- IP Address -->
											<div class="col-md-6">
												<div class="form-group">
													<label class="text-dark" for="url">{{ __("Enter IP Address to allowed while Maintenance Mode is Enabled (ex: 172.16.254.1, 506.457.14.512)") }} <span class="text-danger">*</span></label>
													<select class="select2-multi-select form-control" name="allowed_ip[]" multiple="multiple">
													
														@if(is_array(optional($comingsoon)->allowed_ip) || is_object(optional($comingsoon)->allowed_ip)) 
															@foreach(optional($comingsoon)->allowed_ip as $cat)
															<option value="{{ $cat }}" {{in_array($cat, $comingsoon['allowed_ip'] ?: []) ? "selected": ""}} >{{ $cat }}
															</option>
															@endforeach
														@endif
													</select>
												</div>
											</div>  
											<div class="form-group col-md-6">
												<label class="text-dark" for="exampleInputDetails">{{ __('Enable Maintenance Mode') }} :</label><br>
												<input type="checkbox" class="custom_toggle" name="enable" {{ optional($comingsoon)['enable'] == '1' ? 'checked' : '' }} />
												<input type="hidden"  name="free" value="0" for="status" id="status"><br>
												<small>({{ __('Enable') }} {{ __('Enable Maintenance Mode') }})</small>
											</div>
											<!-- image -->
											<div class="form-group col-md-6">
												<label class="text-dark">{{ __('Image') }}:<span class="text-danger">*</span></label><br>
												<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text" id="inputGroupFileAddon01">{{ __('Upload') }}</span>
												</div>
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="inputGroupFile01" name="bg_image" aria-describedby="inputGroupFileAddon01">
													<label class="custom-file-label" for="inputGroupFile01">{{ __('Choose file') }}</label>
												</div>
												</div>
												@if($image = @file_get_contents('../public/images/comingsoon/'.$comingsoon->bg_image))
												<img src="{{ url('/images/comingsoon/'.$comingsoon->bg_image) }}" class="image_size"/>
												@endif
											</div>
											
											<!-- enable -->
										
										
											<div class="col-md-12">
												<div class="form-group">
													<button type="reset" class="btn btn-danger-rgba mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
													<button type="submit" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
													{{ __("Update")}}</button>
												</div>
											</div>
				
										</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!-- form for comming soon end -->
                </div>
				<!-- card body end -->
            
        </div><!-- col end -->
    </div>
</div>
</div><!-- row end -->
    <br><br>
@endsection
<!-- main content section ended -->
<!-- This section will contain javacsript start -->
@section('script')
<!-- css for coming soon start -->
<style>
    .image_size{
    height:80px;
    width:200px;
}
</style>
<!-- css for coming soon end -->
@endsection
<!-- This section will contain javacsript end -->


