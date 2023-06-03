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
            <div class="col-md-12 card bord mt-5  mb-5 ">
                <div class="row">
                    <div class="col-md-4 bg-info ">
                      @if(filter_var($personal->image))
                      <img src="{{ asset('files/resume/'.filter_var($personal->image)) }}" class="img-fluid resume-image d-block mt-4 mb-4 " alt="image">
                      @else
                      <img src="{{ Module::asset('resume:image/noimage.jpg') }}" class="img-fluid resume-image1 d-block mt-4 mb-4 " alt="image">
                      @endif
                        <div class="invoice-info">
                          <p class=text-white mt-4"> <i class="fa fa-map-marker mr-2 "></i>{{ filter_var($personal->address)}}</p>
                          <p class="text-white mt-4"><i class="fa fa-phone  mr-2"></i>{{ filter_var($personal->phone)}}</p>
                          <p class="text-white mt-4"><i class="fa fa-envelope  mr-2"></i>{{ filter_var($personal->email)}}</p>
                          <p class="text-white mt-4"><b>{{ __("Profession :") }}</b><br>{{ filter_var($personal->profession)}}</p>
                          <p class="text-white mt-4"><b>{{ __("Skills :") }}</b><br>{{ filter_var($personal->skill)}}</p>
                          <p class="text-white mt-4"><b>{{ __("Strength :") }}</b><br>{{ filter_var($personal->strength)}}</p>
                          <p class="text-white mt-4"><b>{{ __("Interest :") }}</b><br>{{ filter_var($personal->interest)}}</p>
                          <p class="text-white mt-4"><b>{{ __("Language :") }}</b><br>{{ filter_var($personal->language)}}</p>
                        </div>
                    </div>
                      
                    <div class="col-md-8 bg-white">
                        <h3 class="text-primary  mt-3">{{ filter_var($personal->fname)}} {{ filter_var($personal->lname)}} @if(filter_var($personal->verified) == 1)  <img src="{{ Module::asset('resume:image/verified.png') }}" class="img-fluid verfied" alt="image"> @endif</h3>
                        <h5 class="mt-3 text-info">{{ __("OBJECTIVE :") }}</h5>
                        <p>{{ filter_var($personal->objective) }}</p>
                        <h5 class="mt-3 text-info">{{ __("EDUCATION :") }}</h5>
                        <div class="row">
                            @foreach($educations as $personal)
                            <div class="col-md-4 form-group">
                                <p>{{ filter_var($personal->course)}}</p>
                            </div>
                            <div class="col-md-8">
                                <p><span class="text-font">{{ filter_var($personal->school)}}</span> <br>
                                   {{ filter_var($personal->marks)}} - {{ filter_var($personal->yearofpassing)}}</p>
                            </div>
                            @endforeach
                    </div>

                    <h5 class="mt-3 text-info">{{ __("EXPERIENCE :") }}</h5>
                    <div class="row">
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
                    </div>

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
                    <div class="submit-btn">
                        
                        <a href="{{ route('resume.pdfdownload',['id'=>Auth::user()->id]) }}" class="btn btn-info mb-2 float-right">{{ __("Download") }}</a>
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