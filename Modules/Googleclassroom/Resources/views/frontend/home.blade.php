<!-- google class room start -->
<section id="student" class="student-main-block">
    <div class="container">
        @php
            $mytime = Carbon\Carbon::now();
        @endphp
        @if( ! $googleclassrooms->isEmpty())
        <h4 class="student-heading">{{ __('Google Class Room') }}</h4>
        <div id="googleclassroom-view-slider" class="student-view-slider-main-block owl-carousel">

            @if( ! $meetings->isEmpty() )
                @foreach($googleclassrooms as $googleclassroom)
                    <div class="item student-view-block student-view-block-1">
                        <div class="genre-slide-image @if($gsetting['course_hover'] == 1) protip @endif" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block-6{{$meeting->id}}">
                            <div class="view-block">
                                <div class="view-img">
                                    @if($googleclassroom['image'] !== NULL && $googleclassroom['image'] !== '')
                                        <a href="{{ route('googleclassroom.detail', $googleclassroom->id) }}"><img data-src="{{ asset('images/googleclassroom/profile_image/'.$googleclassroom['image']) }}" alt="course" class="img-fluid owl-lazy"></a>
                                    @else
                                       <a href="{{ route('googleclassroom.detail', $googleclassroom->id) }}"><img data-src="{{ Avatar::create($meeting['meeting_title'])->toBase64() }}" alt="course" class="img-fluid owl-lazy"></a>
                                    @endif
                                </div>

                                @if(asset('images/googleclassroom_icons/googleclassroom1.png') == !NULL)
                                <div class="meeting-icon"><img src="{{ asset('images/googleclassroom_icons/googleclassroom1.png')}}" class="img-circle" alt=""></div>
                                @endif

                                <div class="view-dtl">
                                    <div class="view-heading"><a href="#">{{ str_limit($googleclassroom->cource_title, $limit = 30, $end = '...') }}</a></div>
                                    <div class="user-name">
                                        <h6>By <span>{{ optional($googleclassroom->user)['fname'] }}</span></h6>
                                    </div>
                                    <div class="view-footer">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="view-date">
                                                    <a href="#"><i data-feather="calendar"></i>
                                                        {{ date('d-m-Y',strtotime($googleclassroom['start_time'])) }}</a>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="view-time">
                                                    <a href="#"><i data-feather="clock"></i>
                                                        {{ date('h:i:s A',strtotime($googleclassroom['start_time'])) }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <div id="prime-next-item-description-block-6{{$meeting->id}}" class="prime-description-block">
                            <div class="prime-description-under-block">
                                <div class="prime-description-under-block">
                                    <h5 class="description-heading"><a href="{{ route('zoom.detail', $meeting->id) }}">{{ $googleclassroom['cource_title'] }}</a></h5>
                                    <div class="protip-img">
                                        <h3 class="description-heading">{{ __('frontstaticword.by') }} @if(isset($meeting->user)) {{ $meeting->user['fname'] }} @endif</h>
                                        <p class="meeting-owner btm-10"><a herf="#">{{ __('Class Room Owner: ') }}{{ $googleclassroom->owner_id }}</a></p>
                                    </div>
                                    <div class="main-des meeting-main-des">
                                        <div class="main-des-head">Start At: </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="view-date">
                                                    <a href="#"><i data-feather="calendar"></i> {{ date('d-m-Y',strtotime($googleclassroom['start_time'])) }}</a>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="view-time">
                                                    <a href="#"><i data-feather="clock"></i> {{ date('h:i:s A',strtotime($googleclassroom['start_time'])) }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="des-btn-block">
                                        <a href="{{ $googleclassroom->join_url }}" target="__blank" class="iframe btn btn-light">{{ __('Join Class') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                @endforeach
            @endif
        </div>
        @endif
    </div>
</section>
<!-- google class room end -->