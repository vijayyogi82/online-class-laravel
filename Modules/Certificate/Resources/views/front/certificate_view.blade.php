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
              <div class="company-logo text-center">
                @if(!empty($certificate->logo_image) &&  $certificate->logo_enable == 1)
                  <img src="{{ asset('images/certificate/logo/'.$certificate->logo_image ) }}" class="img-fluid" alt="logo">
                @endif                 
              </div>
            </div>
            @elseif($certificate->widget1_enable == 'signature')
            <div class="col-lg-4 col-md-4 col-12">
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
                    <span class="sign-name">({{$certificate->name }})</span>
                    @endif
                  </li>
                </ul>
              </div>
            </div>
            @else
            <div class="col-lg-4 col-md-3 col-12">
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
              <div class="company-logo text-center">
                @if(!empty($certificate->logo_image) &&  $certificate->logo_enable == 1)
                  <img src="{{ asset('images/certificate/logo/'.$certificate->logo_image ) }}" class="img-fluid" alt="logo">
                @endif                 
              </div>
            </div>
            @elseif($certificate->widget2_enable == 'signature')
            <div class="col-lg-4 col-md-4 col-12">
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
                    <span class="sign-name">({{$certificate->name }})</span>
                    @endif
                  </li>
                </ul>
              </div>
            </div>
            @else
            <div class="col-lg-4 col-md-3 col-12">
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
              <div class="company-logo text-center">
                @if(!empty($certificate->logo_image) &&  $certificate->logo_enable == 1)
                  <img src="{{ asset('images/certificate/logo/'.$certificate->logo_image ) }}" class="img-fluid" alt="logo">
                @endif                 
              </div>
            </div>
            @elseif($certificate->widget3_enable == 'signature')
            <div class="col-lg-4 col-md-4 col-12">
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
                    <span class="sign-name">({{$certificate->name }})</span>
                    @endif
                  </li>
                </ul>
              </div>
            </div>
            @else
            <div class="col-lg-4 col-md-3 col-12">
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
        <div class="certificate-serial-number">
          <div class="row">
            <div class="col-lg-6 text-left">
              <div class="cirtificate-serial">Certificate no. :{{ $serial_no }}</div>
            </div>
            <div class="col-lg-6 text-right">
              <div class="cirtificate-serial">Certificate url. :{{ url()->full() }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

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
    height: 800px;
  }
  .cirtificate-border-two {  
    <?php if(!empty($certificate->border_two_enable)){ ?>
    border: {{ $certificate->border_two }}px groove {{ $certificate->border_two_color }} !important;
    <?php } ?>

    <?php if(empty($certificate->border_two_enable)){ ?>
      border: none !important;
    <?php } ?>
    height: 750px;
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

@if($certificate->background_image_enable != 1)
  .certificate-detail {
    position: absolute;
    top: 12%;
    left: 10%;
    right: 10%;
  }
@endif
  
  @media print {
    .certificate-detail {
      top: 8%;
    }
    .certificate-bottom {
      position: absolute;
      bottom: 54%;
      left: 6%;
      right: 6%;
      margin: 0 20px;
    }
    .certificate-signature img {
      width: 150px;
      height: 60px;
      text-align: center !important;
    }
    .certificate-serial-number {
      position: absolute;
      bottom: 53%;
      left: 5%;
      right: 5%;
      margin: 0 20px;
    }
    .cirtificate-border-one {
      height: 800px;
    }
    .cirtificate-border-two {
      height: 750px;
    }
  }
</style>

<script lang='javascript'>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
  }
</script>

