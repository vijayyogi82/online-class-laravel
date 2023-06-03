<!DOCTYPE html>
<!--
**********************************************************************************************************
    Copyright (c) 2019.
**********************************************************************************************************  -->
<!-- 
Template Name: eClass
Author: Media City
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]> -->
<?php
$language = Session::get('changed_language'); //or 'english' //set the system language
$rtl = array('ar','he','ur', 'arc', 'az', 'dv', 'ku', 'fa'); //make a list of rtl languages
?>

<html lang="en" @if (in_array($language,$rtl)) dir="rtl" @endif>
<head>
<link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:300,400,500,700" rel="stylesheet"> <!--  google fonts -->
<link href="https://fonts.googleapis.com/css?family=Muli&display=swap:400,500,600,700" rel="stylesheet"><!-- google fonts -->
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/custom-style.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}" />
<link href="{{ url('css/style.css') }}" rel="stylesheet" type="text/css"/> <!-- custom css -->
<!-- <![endif]-->
<!-- head -->
<!-- theme styles -->


<style>
  .company-logo {
    <?php if(isset($certificate)){ ?>
    width: {{ $certificate->logo_width }}px;
    height: {{ $certificate->logo_height }}px;
    <?php } ?>
  }
  .certificate-title {
    <?php if(isset($certificate)){ ?>
    font-size: {{ $certificate->title_font_size }}px !important;
    color: {{ $certificate->title_font_color }} !important;
    text-align: {{ $certificate->title_position }} !important;
    <?php } ?>
  }
  .certificate-detail p {
    <?php if(isset($certificate)){ ?>
    font-size: {{ $certificate->body_font_size }}px !important;
    color: {{ $certificate->body_font_color }} !important;
    text-align: {{ $certificate->title_position }} !important;
    <?php } ?>
  }
  .cirtificate-border-one { 
    <?php if(!empty($certificate->border_one_enable)){ ?>
      border: {{ $certificate->border_one }}px groove {{ $certificate->border_one_color }} !important;
    <?php } ?>
    <?php if(empty($certificate->border_one_enable)){ ?>
      border: none!important;
    <?php } ?>
  
  }
  .cirtificate-border-two {  
    <?php if(!empty($certificate->border_two_enable)){ ?>
    border: {{ $certificate->border_two }}px groove {{ $certificate->border_two_color }} !important;
    <?php } ?>
    <?php if(empty($certificate->border_two_enable)){ ?>
      border: none !important;
    <?php } ?>
  }
  .certificate-signature img {
    <?php if(isset($certificate)){ ?>
    width: {{ $certificate->signature_width }}px;
  
    height: {{ $certificate->signature_height }}px;
    text-align: {{ $certificate->signature_position }} !important;
    <?php } ?>
  }
  .certificate-date ul li:first-child{
    <?php if(isset($certificate)){ ?>
    font-size: {{ $certificate->date_font_size }}px !important;
    color: {{ $certificate->date_font_color }} !important;
    <?php } ?>
  }

  .sign-name {
    <?php if(isset($certificate)){ ?>
    font-size: {{ $certificate->name_font_size }}px !important;
    color: {{ $certificate->name_font_color }} !important;
    text-align: {{ $certificate->name_font_color }} !important;
    <?php } ?>
  }

  .certificate-img {
    position: relative;
  }
  .certificate-img img {
    border-radius: 6px;
    width: 100%;
    height: 700px;
  }
  .certificate-detail {
    position: absolute;
    top: 12%;
    left: 34%;
    right: 7%;
  }
  .certificate-bottom {
    position: absolute;
    bottom: 6%;
    left: 6%;
    right: 6%;
    margin: 0 20px;
  }
  .company-logo {
    margin: 0 auto;
  }
  .company-logo img {
    width: 200px;
  }
  .certificate-heading {
    text-transform: uppercase;
    font-weight: 500;
    margin-bottom: 60px;
  }
  .certificate-heading span {
    font-size: 60px;
    font-family: 'Roboto Slab', serif;
    letter-spacing: 4px;
    font-weight: 600;
    color: #E65A1D;
  }
  .certificate-title {
    font-size: 20px;
    font-weight: 500;
    margin-bottom: 30px;
  }
  .certificate-name {
    font-size: 44px;
    color: #1B7EC1;
    font-family: 'Dancing Script', cursive;
  }
  .company-logo {
    margin-top: 30px;
  } 
  .certificate-date ul li {
    font-size: 16px;
  }
  .certificate-date ul li.date {
    font-size: 20px;
    font-weight: 500;
  }
  .certificate-signature ul li.signature {
    font-size: 20px;
    font-weight: 500;
  }
  .certificate-date {
    margin-top: 37px;
  }
  .certificate-serial-number {
    position: absolute;
    bottom: 7%;
    left: 5%;
    right: 5%;
    margin: 0 20px;
  }
  .certificate-signature ul hr {
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
  }
  .certificate-date ul hr {
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
  }


  @media (max-width: 767px) {
    .certificate-img {
      margin-bottom: 40px;
    }
    .certificate-heading span {
      font-size: 28px;
    }
    .certificate-heading {
      font-size: 20px;
      margin-bottom: 50px;
    }
    .certificate-title {
      font-size: 18px;
    }
    .certificate-name {
      font-size: 34px;
    }
    .certificate-detail p {
      font-size: 12px;
    }
    .certificate-img img {
      height: 850px;
    }
    .certificate-bottom {
      bottom: 7%;
    }
    .company-logo {
      text-align: center;
    }
    .certificate-detail {
      left: 30%;
    }
    .company-logo {
      margin-bottom: 20px;
    }
    .company-logo img {
      width: 180px;
    }
    .certificate-date {
      margin-top: 36px;
    }
  }
  @media (min-width: 767px) and (max-width: 992px) {
    .certificate-heading {
      font-size: 24px;
    }
    .certificate-heading span {
      font-size: 42px;
    }
    .certificate-heading {
      margin-bottom: 50px;
    }
    .certificate-detail {
      top: 5%;
      left: 30%;
    }
    .certificate-name {
      font-size: 40px;
    }
    .certificate-bottom {
      bottom: 5%;
    }
    .certificate-date {
      margin-top: 36px;
    }
    .company-logo img {
      width: 170px;
    }
  }


</style>
</head>
<!-- end head -->
<!-- body start-->
<body>
  @php
    $certificate = Modules\Certificate\Models\CertificateDesign::first();
    $courses = $course->title;

      $fullname = $progress->user->fname. " " .$progress->user->lname;

      if(isset($certificate))
      {

        $body = $certificate->body;
        $body = str_replace("[user]",$fullname, $body);
        $body = str_replace("[course]",$courses, $body);

      }
  @endphp
  <div class="cirtificate-border-one text-center">
    <div class="cirtificate-border-two">
      <div class="certificate-block">
        @if($certificate->background_image_enable == 1)
        <div class="certificate-img">
          @if(!empty($certificate->background_image))
            <img src="{{ url('images/certificate/background/'.$certificate->background_image) }}" class="img-fluid" alt="">
            @endif
        </div>
        @endif
        <div class="certificate-detail text-center">
            <h2 class="certificate-heading"><span>Certificate</span> </h2>
            <div class="certificate-title">{{ $certificate->title }}</div>
            <h1 class="certificate-name">{{ $progress->user->fname. " " .$progress->user->lname }}</h1>
            <p>{{ $certificate->body }}</p>
        </div>
        <div class="certificate-bottom">
          <div class="row">
            @if($certificate->widget1_enable == 'logo')
            
            <div class="col-lg-4 col-md-5 col-12">
              <div class="company-logo">
                @if(!empty($certificate->logo_image) &&  $certificate->logo_enable == 1)
                  <img src="{{ asset('images/certificate/logo/'.$certificate->logo_image ) }}" class="img-fluid" alt="logo">
                @endif                 
              </div>
            </div>
            @elseif($certificate->widget1_enable == 'signature')
            <div class="col-lg-4 col-md-4 col-6">
              <div class="certificate-signature text-center">
                <ul>
                    <li>  
                      @if(!empty($certificate->signature_image))
                      <img src="{{ asset('images/certificate/signature/'.$certificate->signature_image ) }}" class="img-fluid" alt="logo">
                      @endif
                   
                    </li>
                    <hr>
                    <li class="signature">{{ __('Signature') }}</li>
                   <li>
                    @if(!empty($certificate->name))
                    <span class="sign-name">{{$certificate->name }}</span>
                    @endif
                   </li>
                </ul>
              </div>
            </div>
            @else
            <div class="col-lg-4 col-md-3 col-6">
              @if($certificate->date_enable == 1)
              <div class="certificate-date text-center">
                <ul>
                    <li>{{  date('jS F Y', strtotime($progress['updated_at']))  }}</li>
                    <hr>
                    <li class="date">Date</li>                                        
                </ul>
              </div>
              @endif
            </div>
            @endif
            @if($certificate->widget2_enable == 'logo')
            
            <div class="col-lg-4 col-md-5 col-12">
              <div class="company-logo">
                @if(!empty($certificate->logo_image) &&  $certificate->logo_enable == 1)
                  <img src="{{ asset('images/certificate/logo/'.$certificate->logo_image ) }}" class="img-fluid" alt="logo">
                @endif                 
              </div>
            </div>
            @elseif($certificate->widget2_enable == 'signature')
            <div class="col-lg-4 col-md-4 col-6">
              <div class="certificate-signature text-center">
                <ul>
                    <li>  
                      @if(!empty($certificate->signature_image))
                      <img src="{{ asset('images/certificate/signature/'.$certificate->signature_image ) }}" class="img-fluid" alt="logo">
                      @endif
                   
                    </li>
                    <hr>
                    <li class="signature">{{ __('Signature') }}</li>
                   <li>
                    @if(!empty($certificate->name))
                    <span class="sign-name">{{$certificate->name }}</span>
                    @endif
                   </li>
                </ul>
              </div>
            </div>
            @else
            <div class="col-lg-4 col-md-3 col-6">
              @if($certificate->date_enable == 1)
              <div class="certificate-date text-center">
                <ul>
                    <li>{{  date('jS F Y', strtotime($progress['updated_at']))  }}</li>
                    <hr>
                    <li class="date">Date</li>                                        
                </ul>
              </div>
              @endif
            </div>
            @endif
            @if($certificate->widget3_enable == 'logo')
            
            <div class="col-lg-4 col-md-5 col-12">
              <div class="company-logo">
                @if(!empty($certificate->logo_image) &&  $certificate->logo_enable == 1)
                  <img src="{{ asset('images/certificate/logo/'.$certificate->logo_image ) }}" class="img-fluid" alt="logo">
                @endif                 
              </div>
            </div>
            @elseif($certificate->widget3_enable == 'signature')
            <div class="col-lg-4 col-md-4 col-6">
              <div class="certificate-signature text-center">
                <ul>
                    <li>  
                      @if(!empty($certificate->signature_image))
                      <img src="{{ asset('images/certificate/signature/'.$certificate->signature_image ) }}" class="img-fluid" alt="logo">
                      @endif
                   
                    </li>
                    <hr>
                    <li class="signature">{{ __('Signature') }}</li>
                   <li>
                    @if(!empty($certificate->name))
                    <span class="sign-name">{{$certificate->name }}</span>
                    @endif
                   </li>
                </ul>
              </div>
            </div>
            @else
            <div class="col-lg-4 col-md-3 col-6">
              @if($certificate->date_enable == 1)
              <div class="certificate-date text-center">
                <ul>
                    <li>{{  date('jS F Y', strtotime($progress['updated_at']))  }}</li>
                    <hr>
                    <li class="date">Date</li>                                        
                </ul>
              </div>
              @endif
            </div>
            @endif

            
          </div>
        </div>
        <div class="cirtificate-serial">Certificate no. :{{ $serial_no }}</div>
        <div class="cirtificate-serial">Certificate url. :{{ url()->full() }}</div>
      </div>
    </div>
  </div>



<!-- footer start -->

<!-- footer end -->
<!-- jquery -->
<script src="{{ url('js/jquery-2.min.js') }}"></script> <!-- jquery library js -->
<script src="{{ url('js/bootstrap.bundle.js') }}"></script> <!-- bootstrap js -->
<!-- end jquery -->
</body>
<!-- body end -->
</html> 
