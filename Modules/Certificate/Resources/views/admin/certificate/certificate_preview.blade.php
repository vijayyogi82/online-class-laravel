@extends('admin/layouts.master')
@section('title', __("Certicficate Preview"))
@section('stylesheet')
  <link rel="stylesheet" href="{{ Module::asset('certificate:css/certificate_preview.css') }}">
@endsection
@section('body')
<script src="{{ url('js/jquery-2.min.js') }}"></script> <!-- jquery library js -->
<style>
  /* css for certificate design start */

  .cirtificate-border-one {
    font-family: "Times New Roman", Times, serif;
    /* border: 15px groove var(--text-blue-color);  */
    /* border: 15px solid #0284a2; */
    border: '{{ $outerborderstyle->border }}';
    border-top-color: '{{ $outerborderstyle->border_top_color }}';
    border-right-color: '{{ $outerborderstyle->border_right_color }}';
    border-bottom-color: '{{ $outerborderstyle->border_bottom_color }}';
    border-left-color: '{{ $outerborderstyle->border_left_color }}';
    padding: '{{ $outerborderstyle->padding }}';
    background-color: '{{ $outerborderstyle->background_color }}';

  }

  .cirtificate-border-one-sub {
    font-family: "Times New Roman", Times, serif;

    <?php if( !empty($outersubborderstyle->border)) {
      ?>border: '{{ $outersubborderstyle->border }}';
      <?php
    }

    ?><?php if( !empty($outersubborderstyle->border_top_color)) {
      ?>border-top-color: '{{ $outersubborderstyle->border_top_color }}';
      <?php
    }

    ?><?php if( !empty($outersubborderstyle->border_right_color)) {
      ?>border-right-color: '{{ $outersubborderstyle->border_right_color }}';
      <?php
    }

    ?><?php if( !empty($outersubborderstyle->border_bottom_color)) {
      ?>border-bottom-color: '{{ $outersubborderstyle->border_bottom_color }}';
      <?php
    }

    ?><?php if( !empty($outersubborderstyle->border_left_color)) {
      ?>border-left-color: '{{ $outersubborderstyle->border_left_color }}';
      <?php
    }

    ?><?php if( !empty($outersubborderstyle->padding)) {
      ?>padding: '{{ $outersubborderstyle->padding }}';
      <?php
    }

    ?><?php if( !empty($outersubborderstyle->background_color)) {
      ?>background-color: '{{ $outersubborderstyle->background_color }}';
      <?php
    }

    ?><?php if( !empty($outersubborderstyle->margin_top)) {
      ?>margin-top: '{{ $outersubborderstyle->margin_top }}';
      <?php
    }

    ?><?php if( !empty($outersubborderstyle->margin_left)) {
      ?>margin-left: '{{ $outersubborderstyle->margin_left }}';
      <?php
    }

    ?><?php if( !empty($outersubborderstyle->margin_bottom)) {
      ?>margin-bottom: '{{ $outersubborderstyle->margin_bottom }}';
      <?php
    }

    ?><?php if( !empty($outersubborderstyle->margin_right)) {
      ?>margin-right: '{{ $outersubborderstyle->margin_right }}';
      <?php
    }

    ?><?php if( !empty($certificatebackgroundstyle->certi_background_image)) {
      ?>background-image: url('{{ asset('admin/certificate_pic/'.$certificatebackgroundstyle->certi_background_image ) }}');
      <?php
    }

    ?>
  }

  .cirtificate-border-two {
    <?php if( !empty($innerborderstyle->border)) {
      ?>border: '{{ $innerborderstyle->border }}';
      <?php
    }

    ?><?php if( !empty($innerborderstyle->padding)) {
      ?>padding: '{{ $innerborderstyle->padding }}';
      <?php
    }

    ?>
  }

  .cirtificate-border-two-sub {
    <?php if( !empty($innersubborderstyle->border)) {
      ?>border: '{{ $innersubborderstyle->border }}';
      <?php
    }

    ?><?php if( !empty($innersubborderstyle->padding)) {
      ?>padding: '{{ $innersubborderstyle->padding }}';
      <?php
    }

    ?><?php if( !empty($innersubborderstyle->margin_top)) {
      ?>margin-top: '{{ $innersubborderstyle->margin_top }}';
      <?php
    }

    ?><?php if( !empty($innersubborderstyle->margin_left)) {
      ?>margin-left: '{{ $innersubborderstyle->margin_left }}';
      <?php
    }

    ?><?php if( !empty($innersubborderstyle->margin_bottom)) {
      ?>margin-bottom: '{{ $innersubborderstyle->margin_bottom }}';
      <?php
    }

    ?><?php if( !empty($innersubborderstyle->margin_right)) {
      ?>margin-right: '{{ $innersubborderstyle->margin_right }}';
      <?php
    }

    ?>
  }

  .cirtificate-heading {
    <?php if( !empty($titlestyle->font_size)) {
      ?>font-size: '{{ $titlestyle->font_size }}';
      <?php
    }

    ?><?php if( !empty($titlestyle->font_weight)) {
      ?>font-weight: '{{ $titlestyle->font_weight }}';
      <?php
    }

    ?><?php if( !empty($titlestyle->font_style)) {
      ?>font-style: '{{ $titlestyle->font_style }}';
      <?php
    }

    ?><?php if( !empty($titlestyle->margin_bottom)) {
      ?>margin-bottom: '{{ $titlestyle->margin_bottom }}';
      <?php
    }

    ?>
  }

  .cirtificate-detail {
    <?php if( !empty($contentstyle->margin_bottom)) {
      ?>margin-bottom: '{{ $contentstyle->margin_bottom }}';
      <?php
    }

    ?><?php if( !empty($contentstyle->font_size)) {
      ?>font-size: '{{ $contentstyle->font_size }}';
      <?php
    }

    ?>
  }

  /* left */
  .cirtificate-instructor {
    font-family: 'Great Vibes';

    <?php if( !empty($contentstyleblock2->font_style)) {
      ?>font-style: '{{ $contentstyleblock2->font_style }}';
      <?php
    }

    ?><?php if( !empty($contentstyleblock2->font_size)) {
      ?>font-size: '{{ $contentstyleblock2->font_size }}';
      <?php
    }

    ?><?php if( !empty($contentstyleblock2->margin)) {
      ?>margin: '{{ $contentstyleblock2->margin }}';
      <?php
    }

    ?><?php if( !empty($contentstyleblock2->text_align)) {
      ?>text-align: '{{ $contentstyleblock2->text_align }}';
      <?php
    }

    ?>
  }

  .cirtificate-logo img {
    <?php if( !empty($logostyle->width)) {
      ?>width: '{{ $logostyle->width }}';
      <?php
    }

    ?>
  }

  .img-fluid {
    max-width: <?php echo "100%";
    ?>;
    height: <?php echo "auto";
    ?>;
  }

  .box-body img {
    <?php if( !empty($logostyle->height)) {
      ?>height: '{{ $logostyle->height }}';
      <?php
    }

    ?>
  }

  .cirtificate-signature img {
    <?php if( !empty($certificatesignaturestyle->width)) {
      ?>width: '{{ $certificatesignaturestyle->width }}';
      <?php
    }

    ?>
  }

  /* CSS for certificate design end */
</style>
<section class="content">
  @include('admin.message')
  <div class="box">

    <div class="box-header with-border">
      <!-- === certificate setting button start ==== -->
      <div class="switch-btn c1">
        <label class="switch">
          <input type="checkbox" id="link_by" name="link_by" data-toggle="itemCheckBox"
            {{ $logostyle->setting == 1 ?  'checked' :  ''}}/>
          <span class="slider round"></span>
        </label>
      </div>
      <p class="c2"> {{ __("Enable / Disable") }} <br> {{ __("Certificate") }}</p>
    </div>


    <div class="box-body">
      <!-- == certificate template start == -->
      <div class="container">
        <div class="row">
          <div class="col-lg-9">
            <div class="cirtificate-border-one text-center">
              <div class="cirtificate-border-one-sub text-center">
                <div class="cirtificate-border-two">
                  <div class="cirtificate-border-two-sub">
                    <div class="cirtificate-heading"> {{ strip_tags($titlestyle->title) }}</div>
                    @php
                    $mytime = Carbon\Carbon::now();
                    @endphp
                    <p class="cirtificate-detail font-30px"> {{ strip_tags($contentstyle->content) }}<span class="c3">{{ __("User Name") }}</span>
                      {{ strip_tags($contentstyleblock2->content) }} <span
                       class="c3">{{ __("Course Name") }}</span>
                      {{ $contentstyleblock3->content }}<br>
                      <span class="c3">{{ __("Date") }}</span>
                    </p>
                    <span class="cirtificate-instructor text-underline">
                      {{__("User Name") }}</span>
                    <br>
                    <span class="cirtificate-one text-underline">{{ __("User Name") }}</span>,
                    {{ __("Instructor") }}
                    <br>
                    <span>{{ $contentstyleblock3->symbol }}</span>
                    <!-- ===== signature start ============ -->
                    <div class="cirtificate-signature">
                      @if(!empty($certificatesignaturestyle->signature_image))
                      <img src="{{ asset('admin/certificate_pic/'.$certificatesignaturestyle->signature_image ) }}"
                        class="img-fluid" alt="logo">
                      @endif
                    </div>
                    <!-- ===== signature end ========== -->
                    <div class="cirtificate-logo">

                      @if(!empty($logostyle->logo_image))
                      <img src="{{ asset('admin/certificate_pic/'.$logostyle->logo_image ) }}" class="img-fluid"
                        alt="logo">
                      @else()
                      <a href="#"><b>
                          <div class="logotext">{{ config('app.name') }}</div>
                        </b></a>
                      @endif

                    </div>


                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
          </div>
        </div>
      </div>
      <!-- == certificate template end == -->
      <div class="text-center"></div>

    </div>
  </div>
</section>
<script src="{{ Module::asset('certificate:js/preview_certificate.js') }}"></script>
@endsection