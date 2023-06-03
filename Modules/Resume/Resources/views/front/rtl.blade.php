<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ Module::asset('resume:css/resume/download.css') }}">
    <title>{{ __("Download") }}</title>
  </head>

  <body>
    <section id="blog" class="back">
      <!-- container start -->
      <div class="container">
            <div class="row border">
                
                  
                <div class="col-8 col-lg-8 bg-white text-right">
                    <h3 class="text-primary  mt-3">{{ filter_var($personal->fname)}} {{ filter_var($personal->lname)}} @if(filter_var($personal->verified) == 1)  <img src="{{ Module::asset('resume:image/verified.png') }}" class="img-fluid verfied" alt="image"> @endif</h3>
                    <h5 class="mt-3 text-info">{{ __("OBJECTIVE :") }}</h5>
                    <p>{{ filter_var($personal->objective) }}</p>
                    <h5 class="mt-3 text-info">{{ __("EDUCATION :") }}</h5>
                    <div class="row">
                        @foreach($educations as $personal)
                        
                        <div class="col-md-8">
                            <p><span class="text-font">{{ filter_var($personal->school)}}</span> <br>
                                {{ filter_var($personal->marks)}} - {{ filter_var($personal->yearofpassing)}}</p>
                        </div>
                        <div class="col-md-4 form-group">
                            <p>{{ filter_var($personal->course)}}</p>
                        </div>
                        @endforeach
                    </div>

                    <h5 class="mt-3 text-info">{{ __("EXPERIENCE :") }}</h5>
                    <div class="row">
                        @foreach($works as $work)
                            
                            <div class="col-md-8">
                                <p><span class="text-font">{{ filter_var($work->jobtitle)}}</span><br>
                                    {{ filter_var($work->employer)}} <br>
                                {{ filter_var($work->city)}},{{ filter_var($work->state)}}</p>
                            </div>
                            <div class="col-md-4 form-group">
                                <p> {{ date('d-m-Y', strtotime(filter_var($work->startdate)))}}  - {{ date('d-m-Y', strtotime(filter_var($work->enddate)))}}</p>
                            </div>
                        @endforeach
                    </div>

                    <h5 class="mt-3 text-info">{{ __("PROJECT :") }}</h5>
                    <div class="row">
                        @foreach($projects as $personal)
                            <div class="col-md-12">
                                <ul class="download-project-list">
                                    <li>
                                        <p><span class="text-font">{{ filter_var($personal->projecttitle)}} [{{ filter_var($personal->role)}}] </span><br>
                                        {{ filter_var($personal->description)}}</p>
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                    <div class="submit-btn">
                        
                        <a href="javascript:window.print()" class="d-print-none btn btn-outline-info float-right mt-5"><i class="feather icon-printer mr-2"></i>{{ __("Print") }}</a>
                    </div>
               
                </div>
                <div class="col-4 col-lg-4 bg-info text-right">
                    @if(filter_var($personal->image))
                    <img src="{{ asset('files/resume/'.filter_var($personal->image)) }}" class="img-fluid resume-image d-block mt-4 mb-4 float-right" alt="image">
                    @else
                    <img src="{{ Module::asset('resume:image/noimage.jpg') }}" class="img-fluid resume-image1 d-block mt-4 mb-4 float-right" alt="image">
                    @endif
                      <div class="invoice-info">
                        <p class="text-white mt-4"> <i class="fa fa-map-marker mr-2"></i>{{ filter_var($personal->address)}}</p>
                        <p class="text-white mt-4"><i class="fa fa-phone  mr-2"></i>{{ filter_var($personal->phone)}}</p>
                        <p class="text-white mt-4"><i class="fa fa-envelope  mr-2"></i>{{ filter_var($personal->email)}}</p>
                        <p class="text-white mt-4"><b>{{ __("Profession :") }}</b><br>{{ filter_var($personal->profession)}}</p>
                        <p class="text-white mt-4"><b>{{ __("Skills :") }}</b><br>{{ filter_var($personal->skill)}}</p>
                        <p class="text-white mt-4"><b>{{ __("Strength :") }}</b><br>{{ filter_var($personal->strength)}}</p>
                        <p class="text-white mt-4"><b>{{ __("Interest :") }}</b><br>{{ filter_var($personal->interest)}}</p>
                        <p class="text-white mt-4"><b>{{ __("Language :") }}</b><br>{{ filter_var($personal->language)}}</p>
                      </div>
                  </div>
            </div>
      <!-- container end -->
    </section>
    <script src="{{ url('js/jquery-2.min.js') }}"></script> <!-- jquery library js -->
    <script src="{{ url('js/bootstrap.bundle.js') }}"></script> <!-- bootstrap bundle js -->
</body>
</html>