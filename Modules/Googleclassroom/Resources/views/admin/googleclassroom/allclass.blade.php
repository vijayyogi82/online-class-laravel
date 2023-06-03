@extends('admin.layouts.master')
@section('title', 'Your Google Class Room Class - Admin')
@section('maincontent')
<?php
$data['heading'] = 'Google Class Room Class';
$data['title'] = 'Class';
$data['title1'] = 'Google Class Room Class';
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
    <!-- Start row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card dashboard-card m-b-30">
                <div class="card-header">
                    <h5 class="box-title">{{ __('Class List')}}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                    # 
                                    </th>
                                    <th>
                                        {{ __('Class ID') }}
                                    </th>
                                    <th>
                                        {{ __('Status') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
								@php
								$i = 0;
							@endphp

							@foreach($courses as $key => $course)
		  
								@php
									$i++;
								@endphp
							    <tr>
                                    <td>{{ $i }}</td>
                                    <td>
                                        <p><b>{{ __('Class Id :') }}</b> {{ $course->course_id }} </p>
                                        <p><b>{{ __('Class Room Course Id :') }}</b> {{ $course->classroom_cource_id }} </p>
                                        <p><b>{{ __('Owner Id :') }}</b> {{ $course->owner_id }} </p>
                                        <p><b>{{ __('Class On Course :') }}</b> {{ $course->cource_title }} </p>
                                        <p><b>{{ __('Class Description :') }}</b> {{ $course->cource_description }} </p>
                                        <p><b>{{ __('Class State :') }}</b> {{ $course->cource_state }} </p>
                                        <p><b>{{ __('Enrollment Code :') }}</b> {{ $course->classroom_cource_enrollment_code }} <small>{{ __('( Share the code with student to join the class. )') }}</small></p>
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-{{ $course->status == '1' ? 'success' : 'danger' }}">{{ $course->status == '1' ? 'Active' : 'Inactive' }}</span>
                                    </td>
                                </tr>
                            @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
      <!-- End col -->
  </div>
  <!-- End row -->
</div>        
@endsection

            
                                    
                                     
                                      
                                    
                                   
                              
                               
                                
    
              
                               
                              
                
                               
                              
