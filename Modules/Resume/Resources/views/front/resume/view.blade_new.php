@extends('theme.master')
@section('title', 'View Resume')
@section('content')
<!-- css section start--> 
@section('custom-head')
<link rel="stylesheet" href="{{ Module::asset('resume:css/resume.css') }}">
<link rel="stylesheet" href="{{ Module::asset('resume:css/style.css') }}">
<link rel="stylesheet" href="{{ Module::asset('resume:css/resume/view.css') }}">
@endsection
<!-- css section end--> 
@include('admin.message')
<!--section start--> 
<section  class="blog-home-main-block">
    <p class="ml-md-5">{{ __('View Resume') }} <span  class="name">({{ filter_var($personal->fname)}} {{ filter_var($personal->lname)}})</span></p>
</section> 
<!--section end--> 

<!--section startt--> 
<section id="blog" class="back">
    <!-- container start -->
    <div class="container">
        <!-- row start -->
        <div class="row justify-content-center">
            <div class="col-md-12 card bord mt-5 mb-5">
                <div class="resume-edit-page">
                    <div class="row">
                        <div class="col-md-4 user-img">
                          @if(filter_var($personal->image))
                          <img src="{{ Module::asset('resume:image/1642075249happy-young-female-student-holding-notebooks-from-courses-smiling-camera-standing-spring-clothes-against-blue-background.jpg') }}" class="img-fluid resume-image d-block mt-4 mb-4 " alt="image">
                          @else
                          <img src="{{ Module::asset('resume:image/1642075249happy-young-female-student-holding-notebooks-from-courses-smiling-camera-standing-spring-clothes-against-blue-background.jpg') }}" class="img-fluid resume-image1 d-block mt-4 mb-4 " alt="image">
                          @endif
                            <div class="job-personal-info">
                                <h2 class="profile-name text-white">User Example</h2>
                                <h4 class="profile-title text-white">Front End Developer</h4>
                                <p class="text-white"><i data-feather="map-pin"></i>{{ filter_var($personal->address)}}</p>
                                <p class="text-white"><i data-feather="mail"></i>{{ filter_var($personal->email)}}</p>
                                <p class="text-white"><i data-feather="map-pin"></i>Website Link</p>
                                <p class="text-white"><i data-feather="phone"></i>{{ filter_var($personal->phone)}}</p>
                            </div>
                            <hr>
                            <div class="job-info">
                                <h3 class="text-white">Skill's</h3>
                                <p class="text-white">Est iusto enim qui i</p>
                            </div>
                            <hr>
                            <div class="job-info">
                                <h3 class="text-white">Strength</h3>
                                <p class="text-white">Duis laborum Amet</p>
                            </div>
                            <hr>
                            <div class="job-info">
                                <h3 class="text-white">Interest</h3>
                                <p class="text-white">Inventore ut magnam</p>
                            </div>
                            <hr>
                            <div class="job-info">
                                <h3 class="text-white">Language</h3>
                                <p class="text-white">English</p>
                            </div>

                              <!-- <p class="text-white mt-4"> <i class="fa fa-map-marker mr-2 "></i>{{ filter_var($personal->address)}}</p>
                              <p class="text-white mt-4"><i class="fa fa-phone  mr-2"></i>{{ filter_var($personal->phone)}}</p>
                              <p class="text-white mt-4"><i class="fa fa-envelope  mr-2"></i>{{ filter_var($personal->email)}}</p>
                              <p class="text-white mt-4"><b>{{ __("Profession :") }}</b><br>{{ filter_var($personal->profession)}}</p>
                              <p class="text-white mt-4"><b>{{ __("Skills :") }}</b><br>{{ filter_var($personal->skill)}}</p>
                              <p class="text-white mt-4"><b>{{ __("Strength :") }}</b><br>{{ filter_var($personal->strength)}}</p>
                              <p class="text-white mt-4"><b>{{ __("Interest :") }}</b><br>{{ filter_var($personal->interest)}}</p>
                              <p class="text-white mt-4"><b>{{ __("Language :") }}</b><br>{{ filter_var($personal->language)}}</p>
                            </div> -->
                        </div>
                          
                        <div class="col-md-8 bg-white resume-block">
                            <!-- <h3 class="text-primary  mt-3">{{ filter_var($personal->fname)}} {{ filter_var($personal->lname)}} @if(filter_var($personal->verified) == 1)  <img src="{{ Module::asset('resume:image/verified.png') }}" class="img-fluid verfied" alt="image"> @endif</h3> -->
                            <div class="job-profile-info">
                                <h5 class="mt-3 text-info">{{ __("ABOUT US :") }}</h5>
                                <p>{{ filter_var($personal->objective) }}</p>
                            </div>
                            <div class="job-profile-info">
                                <h5 class="mt-3 text-info">{{ __("WORK EXPERIENCE :") }}</h5>
                                <div class="company-info mb-2">
                                    <h5 class="job-name mb-0">MEDIACITY PVT LTD - <span>Sept 2019 - Present</span></h5>
                                    <div class="job-position mb-2">Front End Developer</div>
                                    <p class="job-des">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                </div>
                                <!-- <div class="row">
                                    @foreach($works as $work)
                                        <div class="col-md-4 form-group">
                                            <p> {{ date('d-m-Y', strtotime(filter_var($work->startdate)))}}  - {{ date('d-m-Y', strtotime(filter_var($work->enddate)))}}</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p><span class="text-font">{{ filter_var($work->jobtitle)}}</span><br>
                                                {{ filter_var($work->employer)}} <br>
                                            {{ filter_var($work->city)}},{{ filter_var($work->state)}}</p>
                                        </div>
                                    @endforeach
                                </div> -->
                            </div>
                            <div class="job-profile-info">
                                <h5 class="mt-3 text-info">{{ __("EDUCATION :") }}</h5>
                                <div class="degree-info">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h5 class="institution-name mb-0">Dennis and Merritt Inc</h5>
                                            <div class="degree-name">Front End</div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="grade">80%</div>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                                <!-- <div class="row">
                                    @foreach($educations as $personal)
                                    <div class="col-md-4 form-group">
                                        <p>{{ filter_var($personal->course)}}</p>
                                    </div>
                                    <div class="col-md-8">
                                        <p><span class="text-font">{{ filter_var($personal->school)}}</span> <br>
                                           {{ filter_var($personal->marks)}} - {{ filter_var($personal->yearofpassing)}}</p>
                                    </div>
                                    @endforeach
                                </div> -->
                            </div>
                            <div class="job-profile-info">
                                <h5 class="mt-3 text-info">{{ __("PROJECT :") }}</h5>
                                <div class="row">
                                    @foreach($projects as $personal)
                                        <div class="col-md-12">
                                            <ul>
                                                <li>
                                                    <p><span class="text-font">{{ filter_var($personal->projecttitle)}} [{{ filter_var($personal->role)}}] </span><br>
                                                    {{ filter_var($personal->description)}}</p>
                                                </li>
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="submit-btn">
                                
                                <a href="{{ route('resume.pdfdownload',['id'=>Auth::user()->id]) }}" class="btn btn-info mb-2 float-right">{{ __("Download") }}</a>
                            </div>
                        
                    </div>
                
                </div>
            </div> 
        </div>
        <!-- row end -->
    </div>
    <!-- container end -->

</section>
<!--section end--> 
@endsection
<!-- This section will contain javacsript start -->
@section('custom-script')
<script src="{{ Module::asset('resume:js/resume.js') }}"></script>
<script src="{{ Module::asset('resume:js/job.js') }}"></script>
<script src="{{ Module::asset('resume:js/append.js') }}"></script>
@endsection
<!-- This section will contain javacsript end -->