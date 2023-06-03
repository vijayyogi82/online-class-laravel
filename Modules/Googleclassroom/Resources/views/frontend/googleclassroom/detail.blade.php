@extends('theme.master')
@section('title', "$googleclassroomdetail->cource_title")
@section('content')
@include('admin.message')
<!-- google class room class detail header start -->
<section id="about-home" class="about-home-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="about-home-block text-white">
                    <h1 class="about-home-heading text-white">{{ $googleclassroomdetail['cource_title'] }}</h1>
                    <ul>
                    <ul>
                        <li><a href="#" title="about"></a></li>
                        <li><a href="#" title="about">Start At: {{ date('d-m-Y | h:i:s A',strtotime($googleclassroomdetail['start_time'])) }}</a></li>
                    </ul>
                </div>
            </div>
            <!-- google class room class preview -->
            <div class="col-lg-4">
                <div class="about-home-product">
                    <div class="video-item hidden-xs">
                       
                        <div class="video-device">
                                @if($googleclassroomdetail['image'] !== NULL && $googleclassroomdetail['image'] !== '')
                                <img src="{{ asset('/images/googleclassroom/profile_image/'.$googleclassroomdetail['image']) }}" class="bg_img img-fluid" alt="Background">
                                @else
                                <img src="{{ Avatar::create($googleclassroomdetail['cource_title'])->toBase64() }}" class="bg_img img-fluid" alt="Background">
                                @endif
                        </div>
                    </div>
               
                    <div class="about-home-dtl-training">
                        <div class="about-home-dtl-block btm-10">
                        
                            <div class="about-home-btn btm-20">
                                <a href="{{ $googleclassroomdetail->join_url }}" target="_blank" class="btn btn-secondary">{{ __('Join Class') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- google class room class header end -->
<!-- google class room class detail start -->
<section id="about-product" class="about-product-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="requirements">
                    <h3>{{ __('frontstaticword.Agenda') }}</h3>
                    <ul>
                        <li class="comment more"> 
                        {!! $googleclassroomdetail->cource_description !!} 
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- google class room class detail end -->
@endsection
