@extends('theme.master')
@section('title', __('Job Search'))
<!--section start--> 
@section('content')
<!-- css section start--> 
@section('custom-head')
  <link rel="stylesheet" href="{{ Module::asset('resume:css/resume.css') }}">
  <!-- <link rel="stylesheet" href="{{ Module::asset('resume:css/search.css') }}"> -->
  <link rel="stylesheet" href="{{ Module::asset('resume:css/find.css') }}">
@endsection
<!-- css section end--> 
@include('admin.message')

<section id="search-job" class="search-job-main-block">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4">
		     	<div class="card mt-3 mb-3 ">
		        	<form action="{{ route("job.filter") }}" >
		          		<div class="row ml-2 mr-2 mt-3 mb-3">
		              		<div class="col-lg-12 col-md-12">
		                		<div class="row">
		                  			<div class="col-lg-8 col-md-8">
					                    <h5 class="search-title"><i class="fa fa-signal mr-2"></i>{{ __("All Filter") }}</h5>
				                  	</div>
		                  			<div class="col-lg-4 col-md-4">
		                      			<button type="submit" class="btn-sm shadow-sm submit_button">{{ __("Filter") }}</button>
		                  			</div>
		                		</div>
		                		<hr>
		                		<div class="row">
		                  			<div class="col-lg-12 col-md-12">
		                   		 		<h5> <i class="fa fa-globe mr-2"></i>{{ __("Location") }}</h5>
		                  			</div>
				                  	<?php
				                  	$query =  Modules\Resume\Models\Postjob::select('id','location')->where('status', 1)->take(9)->get();
				                  	?>  
		                    	  	@foreach ($query as $item)
			                    		<div class="col-lg-12 col-md-12">
			                    			<div class="location-name">
			                      				<input type="checkbox"   name="location[]" value="{{ $item->location  }}" >
			                      				<span class="ml-2">{{ filter_var($item->location) }}</span>
			                      			</div>
			                    		</div>
			                  		@endforeach		                
		                		</div>
		              		</div>
		          		</div>
		        	</form>
		      	</div>
		    </div>
		    <div class="col-lg-8 col-md-5">      
		      	@if(request()->get('search'))
		        	<h5 class="mt-3 float-left mb-1">{{ __("Showing") }} {{ filter_var($result->count()) }} {{ __("of") }} {{ filter_var($result->total()) }} {{ __("results for ") }} "<span class="text-primary">{{  Request::get('search') }}</span>"</h5>
		        	<div class="clearfix"></div>
		      	@endif
		      	@forelse($result as $data)
       			<!-- card start -->
  				<a href="{{route('job.view',["id" => $data->id])}}">
			        <div class="card mt-3  mb-3 ">
			          	<div class="row ml-2 mr-2 mt-3 mb-3">
			            	<div class="col-md-10">
			              		<h5 class="title">{{ filter_var($data->title) }}  @if(filter_var($data->varified) == 1)  
			              			<img src="{{ Module::asset('resume:image/verified.png') }}" class="img-fluid verfied" alt="image"> @endif
			              		</h5>
			              		<p>{{ filter_var($data->companyname) }}</p>
			              		<p class="p-color"> <i class="fa fa-suitcase mr-2"></i> {{ filter_var($data->min_experience) }} - {{ filter_var($data->max_experience) }} {{ filter_var($data->experience) }}   &nbsp; &nbsp; <i class="fa fa-map-marker mr-2" ></i>{{ filter_var($data->location) }}</p>
			              		<p class="p-color"><i class="fa fa-file-text-o mr-2" aria-hidden="true"></i>{{substr(strip_tags($data->description), 0, 80)}}{{strlen(strip_tags($data->description))>80 ? '...' : ""}}</p>
			              		<p class="p-color mt-3">{{ str_replace(',' , '   .   ', ucfirst(trans($data->skills)) )}}</p>
			              		<p class="p-color mt-3">
			              			<span class="date-color">
			              				<i class="fa fa-clock-o mr-1 ml-2" aria-hidden="true"></i>{{ filter_var($data->created_at->diffForHumans()) }}
			              			</span>
			              		</p>
			            	</div>
			            	<div class="col-md-2">
			               		@if(filter_var($data->image))
			              			<img src="{{ asset('files/job/'.filter_var($data->image)) }}" class="img-fluid job-image" alt="image">
			              		@else
			              			<img src="{{ Module::asset('resume:image/noimage.jpg') }}" class="img-fluid search1-image" alt="image">
			              		@endif
			            	</div>
			          	</div>
			        </div>
			    </a>
      			@empty
		      	<h3 class="mt-3 text-center">
		        	<i class="fa fa-frown-o text-warning"></i> {{ __("No Job Found !") }}
		      	</h3>
      			@endforelse
		      	<div class="mx-auto mb-3 paginate-resume">
		         	{!! $result->links() !!} 
		      	</div>
			</div>
		</div>
	</div>
</section>
@endsection