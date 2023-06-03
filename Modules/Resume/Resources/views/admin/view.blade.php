@extends('admin.layouts.master')
@section('title', __('Resume - Admin'))
@section('maincontent')
<?php
$data['heading'] = 'Resume';
$data['title'] = 'Resume';
?>
@include('admin.layouts.topbar',$data)

<!-- contentbar start -->
<div class="contentbar mb-5"> 
      <!-- row started -->
      <div class="col-lg-12">
        <div class="card dashboard-card m-b-30">
            <!-- Card header will display you the heading -->
            <div class="card-header">
              <h5 class="card-box">{{ __('Resume') }}</h5>
              <div>
                <div class="widgetbar">
                     <!-- back button  -->
                  <a href="{{url('resume')}}"  class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
                  <!-- download button  -->
                  <a href="javascript:window.print()" class="d-print-none btn btn-primary-rgba py-1 font-16"><i class="feather icon-download mr-2"></i>{{ __("Download") }}</a>
                    <!-- action button  start -->
                  <button class="btn btn-primary-rgba dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ __("Action") }}
                  </button>
                  <!-- action button  end -->
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item"  href="{{ route("resume.approved",["id" => filter_var($persoanl->id)]) }}"> <i class="feather icon-check-square"></i> {{ __("Approved") }}</a>
                    <a class="dropdown-item"  data-toggle="modal" data-target="#reject_{{ filter_var($persoanl->id) }}"><i class="feather icon-x-square"></i> {{ __("Reject") }}</a>
                  </div>
                </div>
              </div>
              
              
              <!-- rejection message model start  -->
              <div class="modal fade" id="reject_{{ filter_var($persoanl->id) }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog admin_model" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">{{ __("Message") }}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="post" id="msform" enctype="multipart/form-data"  action="{{ route('resume.notapproved',["id" => filter_var($persoanl->id)])}}" >
                      @csrf
                      <div class="modal-body">
                        <textarea name="message" placeholder="{{ __("Please enter reason for rejection") }}" class="w-100 form-control" rows="5"></textarea>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Close") }}</button>
                        <button type="submit" class="btn btn-primary">{{ __("Update") }}</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
    <!-- row start -->           
    <div class="row">
          <!-- col start -->
        <div class="col-md-4 bg-info-rgba ">
            @if(filter_var($persoanl->image))
              <img src="{{ asset('files/resume/'.filter_var($persoanl->image)) }}" class="img-fluid resume-image mx-auto d-block mt-5 " alt="image">
              @else
              <img src="{{ Module::asset('resume:image/noimage.jpg') }}" class="img-fluid resume-image1 mx-auto d-block mt-5 " alt="image">
            @endif
            <p class="offset-md-3 text-primary mt-4"> <i class="feather icon-map-pin mr-2 "></i>{{ filter_var($persoanl->address)}}</p>
            <p class="offset-md-3 text-primary mt-4"><i class="feather icon-phone-call  mr-2"></i>{{ filter_var($persoanl->phone)}}</p>
            <p class="offset-md-3 text-primary mt-4"><i class="feather icon-mail  mr-2"></i>{{ filter_var($persoanl->email)}}</p>
            <p class="text-primary offset-md-3 mt-4"><b>{{ __("Profession :") }}</b><br>{{ filter_var($persoanl->profession)}}</p>
            <p class="text-primary offset-md-3 mt-4"><b>{{ __("Skills :") }}</b><br>{{ filter_var($persoanl->skill)}}</p>
            <p class="text-primary offset-md-3 mt-4"><b>{{ __("Strength :") }}</b><br>{{ filter_var($persoanl->strength)}}</p>
            <p class="text-primary offset-md-3 mt-4"><b>{{ __("Interest :") }}</b><br>{{ filter_var($persoanl->interest)}}</p>
            <p class="text-primary offset-md-3 mt-4"><b>{{ __("Language :") }}</b><br>{{ filter_var($persoanl->language)}}</p>
        </div>
            
        <div class="col-md-8 bg-white">
            <h3 class="text-primary  mt-3">{{ filter_var($persoanl->fname)}} {{ filter_var($persoanl->lname)}}</h3>
            <!-- objective-->
            <h5 class="mt-3 text-info">{{ __("OBJECTIVE :") }}</h5>
            <p>{{ filter_var($persoanl->objective) }}</p>
            <!-- education text -->
            <h5 class="mt-3 text-info">{{ __("EDUCATION :") }}</h5>
            <div class="row">
                @foreach($education as $education)
                <div class="col-md-4 form-group">
                        <p>{{ filter_var($education->course)}}</p>
                </div>
                <div class="col-md-8">
                    <h6>{{ filter_var($education->school)}}</h6>
                    <p>{{ filter_var($education->marks)}} - {{ filter_var($education->yearofpassing)}}</p>
                </div>
                @endforeach
            </div>
            <!-- experience text -->
            <h5 class="mt-3 text-info">{{ __("EXPERIENCE :") }}</h5>
            <div class="row">
                @foreach($works as $work)
                    <div class="col-md-4 form-group">
                        <p>{{ filter_var($work->startdate)}}  - {{ filter_var($work->enddate)}}</p>
                    </div>
                    <div class="col-md-8">
                        <h6>{{ filter_var($work->jobtitle)}}</h6>
                        <h6>{{ filter_var($work->employer)}}</h6>
                        <p>{{ filter_var($work->city)}},{{ filter_var($work->state)}}</p>
                    </div>
                @endforeach
            </div>
            <!-- project text -->
            <h5 class="mt-3 text-info">{{ __("PROJECT :") }}</h5>
            <div class="row">
                @foreach($project as $project)
                    <div class="col-md-12">
                        <ul>
                            <li>
                                <h6>{{ filter_var($project->projecttitle)}} [{{ filter_var($project->role)}}]</h6>
                                <p>{{ filter_var($project->description)}}</p>
                            </li>
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
          <!-- col end -->
    </div>
        </div>
      </div>
      <!-- row end -->
</div>
 <!-- contentbar end -->
@endsection