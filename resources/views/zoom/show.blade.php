@extends('admin.layouts.master')
@section('title', 'View Zoom Meeting : '.$response['id'])
@section('maincontent')
<?php
$data['heading'] = 'View Zoom Setting';
$data['title'] = 'View Zoom Setting';
?>
@include('admin.layouts.topbar',$data)
<div class="contentbar">
  <div class="row">
    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-header">
			<div class="row">
				<div class="col-md-10 col-9">
					<h5 class="card-title">	{{ __('View Meeting') }} : {{ $response['id'] }}</h5>
					<div>
						<div class="widgetbar">
						  <a title="Back" href="{{ route('zoom.index') }}" class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
					  
						</div>
					  </div>
				</div>
				<div class="col-md-2 col-3">
					<button class="btn btn-round btn-primary-rgba" type="button" id="CustomdropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
					<div class="dropdown-menu" aria-h5ledby="CustomdropdownMenuButton3">
						<a class="dropdown-item" title="Edit Meeting" href="{{ route('zoom.edit',$response['id']) }}" ><i class="feather icon-edit mr-2"></i>{{ __("Edit")}}</a>
						<a class="dropdown-item"  title="Start Meeting" target="_blank" href="{{ $response['start_url'] }}"><i class="feather icon-send mr-2"></i>{{ __("Start Mettings")}}</a>
					
						<a class="dropdown-item" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="feather icon-trash mr-2"></i>{{ __("Delete Selected")}}</a>
					</div>
				</div>
			</div>
		</div>
						
		<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleSmallModalh5">Delete</h5>
						<button type="button" class="close" data-dismiss="modal" aria-h5="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p class="text-muted">{{ __("Do you really want to delete these records? This process cannot be undone.")}}</p>
					</div>
					<div class="modal-footer">
					
						<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Close")}}</button>
						<button type="submit" class="btn btn-primary">{{ __("Delete")}}</button>
					</form>
					</div>
				</div>
			</div>
		</div>
			
         
		  
			
		
		
			
		
		
        <div class="card-body">
          
			
          
          <div class="row">
			  <div class="col-md-4 mt-3">
				<h5 for="exampleInputSlug">{{ __('MeetingID') }} :</h5>
				<p style="font-size:18px;">{{ $response['id'] }}</p>
			</div>
			
			  <div class="col-md-4 mt-3">
				<h5 for="exampleInputSlug">{{ __('Meeting') }} Type :</h5>
				<p style="font-size:18px;">@if($response['type'] == '2') Scheduled Meeting @elseif($response['type'] == '3') Recurring Meeting with no fixed time @else Recurring Meeting with fixed time @endif</p>
			</div>
				
		
			<div class="col-md-4 mt-3">
				<h5 for="exampleInputSlug">{{ __('Meeting') }} Topic : </h5>
				<p style="font-size:18px;">{{ $response['topic'] }}</p>
				
			</div>
			
				
			<div class="col-md-4 mt-3">
				<h5 for="exampleInputSlug">{{ __('Meeting') }} Agenda :</h5>
				<p style="font-size:18px;">{{ isset($response['agenda']) ? $response['agenda'] : "" }}</p>
			</div>
			
				
			<div class="col-md-4 mt-3">
				<h5 for="exampleInputSlug">Start Time :</h5>
				

				@php
				    // create a $dt object with the UTC timezone
                    $dt = new DateTime(optional($response)['start_time'], new DateTimeZone('UTC'));
                    
                    $timezone =  $response['timezone'];
                    
                    // change the timezone of the object without changing its time
                    $dt->setTimezone(new DateTimeZone($timezone));
				@endphp
				<p style="font-size:18px;">{{ optional($response)['start_time'] ? $dt->format('d-m-Y | h:i A') : "" }}</p>
				
			</div>
			
				
			<div class="col-md-4 mt-3">
				<h5 for="exampleInputSlug">Meeting Contact Name : </h5>
				
				<p style="font-size:18px;">{{ isset($response['settings']['contact_name']) ? $response['settings']['contact_name'] : $response['host_email'] }}</p>
			</div>
			<div class="col-md-4 mt-3">
				<h5 for="exampleInputSlug">Meeting Duration :</h5>
				
				<p style="font-size:18px;"> {{ isset($response['duration']) ? $response['duration'] : "" }} min</p>
			</div>
			<div class="col-md-8 mt-3">
				<h5 for="exampleInputSlug">Invite URL :</h5>
				
				<p style="font-size:18px;"> <a href="{{ isset($response['join_url']) }}">{{ $response['join_url'] }}</a></p>
			</div>
			
			
			<div class="col-md-6 mt-3">
				<h5 for="exampleInputSlug">Other Meeting Settings :</h5>
				
				
			
			<p><i class="feather icon-mic" aria-hidden="true"></i> Audio : {{ isset($response['settings']['audio']) == 'both' ? "Computer and Internet call" : isset($response['settings']['audio']) }}</p>
			<p><i class="feather icon-video" aria-hidden="true"></i> Host Video : {{ isset($response['settings']['host_video']) == true ? "Enabled" : "Disabled"}}</p>
			<p><i class="feather icon-users" aria-hidden="true"></i> Join before Host : {{ isset($response['settings']['join_before_host']) == true ? "Yes" : "No"}}</p>
			
			<p><i class="feather icon-video" aria-hidden="true"></i> participant Video : {{ isset($response['settings']['participant_video']['join_before_host']) == true ? "Enabled" : "Disabled"}}</p>
			</div>
		 </div>
		</div>
      </div>
    </div>
  </div>
</div>

@endsection

