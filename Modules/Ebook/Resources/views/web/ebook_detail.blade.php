@extends('theme.master')
@section('title', 'Ebook Detail')
@section('content')
@include('admin.message')
@php
$gets = App\Breadcum::first();
@endphp
@if(isset($gets))
<section id="business-home" class="business-home-main-block">
    <div class="business-img">
        @if($ebook->banner !== NULL && $ebook->banner !== '')
        <img src="{{ url('/images/ebook/'.$ebook->banner) }}" class="img-fluid" alt="" />
        @else
        <img src="{{ url('/images/breadcum/'.$gets->img) }}" class="img-fluid" alt="" />
        @endif
    </div>
    <div class="overlay-bg"></div>
    <div class="container-xl">
        <div class="business-dtl">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="bredcrumb-dtl">
                        <h1 class="wishlist-home-heading">{{ $ebook->title }}</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="ebook-back-btn">
                        <a href="{{url('web/ebook')}}" type="button" class="btn btn-primary" title="">Back <i data-feather="chevron-right"></i></a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<section id="ebook-detail" class="ebook-detail-main-block">
    <div class="container-xl">
        <div class="ebook-detail-block">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="ebook-deatil-img">
                        <img src="{{ url('images/ebook/'.$ebook->thumbnali)}}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-5 col-md-5">
                    <div class="ebook-dtl-block">
                        <h4 class="mb-2">{{$ebook->title}}</h4>
                        <div class="user-name mb-2">
                            <h6>Created By <span><a href="#"> {{$ebook->user_id?$ebook->user->fname:''}} {{$ebook->user_id?$ebook->user->lname:''}}</a></span></h6>
                        </div>
                        <ul class="mb-3">
                            <li class="mb-2">Publication name : {{$ebook->publication}}</li>
                            <!-- <li class="mb-2">Published date : Tue, 08-Oct-2022</li> -->
                            <li class="mb-2">Category name : {{$ebook->category_id?$ebook->category->title:''}}</li>
                        </ul>
                        <div class="ebook-dtl-btn">
                            <ul>
                                <li class="mr-2">
                                    <div class="ebook-read-btn">
                                        <a href="{{ url('images/ebook/files/'.$ebook->files)}}" target="_blank" type="button" class="btn btn-secondary">Read preview</a>
                                    </div>
                                </li>
                                @if(count($order)>0)
                                <li class="mr-2">    
                                    <div class="ebook-buy-btn">
                                        <a href="{{url('my/ebook/')}}" type="button" class="btn btn-warning">Purchased</a>
                                    </div>
                                </li>
                                @else
                                <li class="mr-2">    
                                    <div class="ebook-buy-btn">
                                        <a href="{{url('web/ebook/addtocart/'.$ebook->id)}}" type="button" class="btn btn-warning">Buy Now</a>
                                    </div>
                                </li>
                                @endif
                                
                                <!-- <li>
                                    <div class="ebook-cart-btn">
                                        <a href="{{url('web/ebook/addtocart/'.$ebook->id)}}" type="button" class="btn btn-primary">Add To Cart</a>
                                    </div>
                                </li> -->
                            </ul>
                        </div>
                        <div class="modal fade" id="readpreviewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <iframe src="{{ url('images/ebook/'.$ebook->files)}}" frameborder="0"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="ebook-dtl-price">
                        <div class="rate text-right">
                            <ul class="mb-2">
                            @if($ebook->free=='Yes')
                                <li><a class="rate-r"><b>Free</b></a></li>
                            @else
                                @if($ebook->discount_check=='Yes')
                                <li><a class="rate-r"><b>{{ currency($ebook->discount_price, $from = $currency->code, $to = $currency->code, $format = true) }}</b></a></li>
                                <li><a><strike>{{ currency($ebook->price, $from = $currency->code, $to = $currency->code, $format = true) }}</strike></a></li>
                                @else
                                <li><a class="rate-r"><b>{{ currency($ebook->price, $from = $currency->code, $to = $currency->code, $format = true) }}</b></a></li>
                                @endif
                            @endif
                            </ul>
                            <div class="rating">
                                @if(count($reviews)>0)
                                <?php
                                    $rating = 0;
                                    $sub_total = 0;
                                    $sub_total = 0;
                                    foreach($reviews as $review){
                                        $rating = $review->rating*5;
                                        $sub_total = $sub_total + $rating;
                                    }
                                    $countt = count($reviews);
                                    $count = ($countt) * 5;
                                    $rat = $sub_total/$count;
                                    $ratings_var = ($rat*100)/5;
                                ?>
                                <ul>
                                    <li> 
                                        <div class="pull-left">
                                            <div class="star-ratings-sprite">
                                                <span style="width:<?php echo $ratings_var; ?>%" class="star-ratings-sprite-rating"></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="reviews">
                                        ({{count($reviews)}} Reviews)
                                    </li>
                                </ul>
                                @else
                                <ul>
                                    <li> 
                                        <div class="pull-left">
                                            <div class="star-ratings-sprite">
                                                <span class="star-ratings-sprite-rating"></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="reviews">
                                        (0 Reviews)
                                    </li>
                                </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="ebook-detail-summary" class="ebook-detail-summary-main-block">
    <div class="container-xl">
        <div class="ebook-detail-summary-block">
            <div class="row">
                <div class="col-lg-12">
                    <h4>Book Specification and Summary</h4>
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-summary-tab" data-toggle="pill" href="#pills-summary" role="tab" aria-controls="pills-summary" aria-selected="true">Summary</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-specification-tab" data-toggle="pill" href="#pills-specification" role="tab" aria-controls="pills-specification" aria-selected="false">Specification</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-author-tab" data-toggle="pill" href="#pills-author" role="tab" aria-controls="pills-author" aria-selected="false">Author</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-summary" role="tabpanel" aria-labelledby="pills-summary-tab">
                            {!!$ebook->detail!!}
                        </div>
                        <div class="tab-pane fade" id="pills-specification" role="tabpanel" aria-labelledby="pills-specification-tab">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">Title</th>
                                        <td>{{$ebook->title}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Author</th>
                                        <td>{{$ebook->user_id?$ebook->user->fname:''}} {{$ebook->user_id?$ebook->user->lname:''}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Publisher</th>
                                        <td>{{$ebook->publication}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Edition</th>
                                        <td>{{$ebook->edition}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="pills-author" role="tabpanel" aria-labelledby="pills-author-tab">
                            <div class="ebook-author-block">
                                <div class="ebook-author-img">
                                    @if(isset($ebook->user_id))                                    
                                    <img src="{{ url('images/user_img/'.$ebook->user->user_img) }}" class="img-fluid" alt="">
                                    @else
                                    <img src="{{ url('images/ebook/user.png') }}" class="img-fluid" alt="">
                                    @endif
                                    
                                </div>
                                <div class="ebook-author-title">
                                    <h4>{{$ebook->user_id?$ebook->user->fname:''}} {{$ebook->user_id?$ebook->user->lname:''}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="ebook-related" class="ebook-related-mian-block">
    <div class="container-xl">
        <div class="ebook-related-block">
            <div class="row">
                <div class="col-lg-12">
                    @if(count($ebooks)>0)
                    <h4>Other related ebooks</h4>
                    @foreach($ebooks as $key => $item)
                    @if($item->id==$ebook->id)
                    @else
                    <div class="about-instructor-block btm-40">
                        <a href="{{url('web/ebook/detail/'.$item->id)}}">
                        <h4>{{$item->title}}</h4>
                        <div class="about-instructor">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-4">
                                    <div class="instructor-img btm-30">
                                        <a href="{{url('web/ebook/detail/'.$item->id)}}" title="instructor">
                                            <img src="{{url('images/ebook/'.$item->thumbnali)}}" class="img-fluid" alt="instructor">
                                        </a>                            
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-9 col-8">
                                    <div class="instructor-block">
                                        <div class="instructor-name btm-10">
                                            <a href="{{url('web/ebook/detail/'.$item->id)}}" title="instructor-name">{{$ebook->user_id?$ebook->user->fname:''}} {{$ebook->user_id?$ebook->user->lname:''}} </a>
                                        </div>
                                        <!-- <div class="instructor-post btm-5">About Instructor</div> -->
                                        <p>{!!$item->detail!!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    @endif
                    @endforeach
                    @endif
                    <div class="ebook-reviews-block btm-60">
                        <h4>Ebook Review</h4>
                            <?php $rating_info = Modules\Ebook\Models\EbookReview::where('ebook_id',$ebook->id)->where('user_id',Auth::user()?Auth::user()->id:'')->first(); ?>
                            <form action="{{url('ebook/rating')}}" class="form" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 my-3">
                                    <div class="ebook-rating">
                                        <h3 class="rating-no">{{$rating_info?$rating_info->rating:'0'}}.0</h3>
                                    </div>
                                    <div class="ebook-reviews">
                                        <div class="review-table">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="star-rating">
                                                                @if($rating_info)
                                                                    @if($rating_info->rating=='1')
                                                                        <input id="option1" type="radio" name="rating" value="5">
                                                                        <label for="option1" title="5 stars">
                                                                        <i class="fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="option2" type="radio" name="rating" value="4">
                                                                        <label for="option2" title="4 stars">
                                                                        <i class="fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="option3" type="radio" name="rating" value="3">
                                                                        <label for="option3" title="3 stars">
                                                                        <i class="fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="option4" type="radio" name="rating" value="2">
                                                                        <label for="option4" title="2 stars">
                                                                        <i class="fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="option5" type="radio" name="rating" value="1" checked>
                                                                        <label for="option5" title="1 star">
                                                                        <i class="active fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                    @elseif($rating_info->rating=='2')
                                                                        <input id="option1" type="radio" name="rating" value="5">
                                                                        <label for="option1" title="5 stars">
                                                                            <i class="fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="option2" type="radio" name="rating" value="4">
                                                                        <label for="option2" title="4 stars">
                                                                            <i class="fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="option3" type="radio" name="rating" value="3">
                                                                        <label for="option3" title="3 stars">
                                                                            <i class="fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="option4" type="radio" name="rating" value="2" checked>
                                                                        <label for="option4" title="2 stars">
                                                                            <i class="active fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="option5" type="radio" name="rating" value="1">
                                                                        <label for="option5" title="1 star">
                                                                            <i class="fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                    @elseif($rating_info->rating=='3')  
                                                                        <input id="option1" type="radio" name="rating" value="5">
                                                                        <label for="option1" title="5 stars">
                                                                            <i class="fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="option2" type="radio" name="rating" value="4">
                                                                        <label for="option2" title="4 stars">
                                                                            <i class="fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="option3" type="radio" name="rating" value="3" checked>
                                                                        <label for="option3" title="3 stars">
                                                                            <i class="active fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="option4" type="radio" name="rating" value="2">
                                                                        <label for="option4" title="2 stars">
                                                                            <i class="fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="option5" type="radio" name="rating" value="1">
                                                                        <label for="option5" title="1 star">
                                                                            <i class="fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                    @elseif($rating_info->rating=='4')  
                                                                        <input id="option1" type="radio" name="rating" value="5">
                                                                        <label for="option1" title="5 stars">
                                                                            <i class="fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="option2" type="radio" name="rating" value="4" checked>
                                                                        <label for="option2" title="4 stars">
                                                                            <i class="active fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="option3" type="radio" name="rating" value="3">
                                                                        <label for="option3" title="3 stars">
                                                                            <i class="fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="option4" type="radio" name="rating" value="2">
                                                                        <label for="option4" title="2 stars">
                                                                            <i class="fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="option5" type="radio" name="rating" value="1">
                                                                        <label for="option5" title="1 star">
                                                                            <i class="fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                    @elseif($rating_info->rating=='5')  
                                                                        <input id="option1" type="radio" name="rating" value="5" checked>
                                                                        <label for="option1" title="5 stars">
                                                                            <i class="active fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="option2" type="radio" name="rating" value="4" >
                                                                        <label for="option2" title="4 stars">
                                                                            <i class=" fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="option3" type="radio" name="rating" value="3" >
                                                                        <label for="option3" title="3 stars">
                                                                            <i class=" fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="option4" type="radio" name="rating" value="2" >
                                                                        <label for="option4" title="2 stars">
                                                                            <i class=" fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="option5" type="radio" name="rating" value="1">
                                                                        <label for="option5" title="1 star">
                                                                            <i class="fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>  
                                                                    @else
                                                                        <input id="option1" type="radio" name="rating" value="5">
                                                                        <label for="option1" title="5 stars">
                                                                        <i class="active fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="option2" type="radio" name="rating" value="4">
                                                                        <label for="option2" title="4 stars">
                                                                        <i class="active fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="option3" type="radio" name="rating" value="3">
                                                                        <label for="option3" title="3 stars">
                                                                        <i class="active fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="option4" type="radio" name="rating" value="2">
                                                                        <label for="option4" title="2 stars">
                                                                        <i class="active fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                        <input id="option5" type="radio" name="rating" value="1">
                                                                        <label for="option5" title="1 star">
                                                                        <i class="active fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                        </label>
                                                                    @endif
                                                                @else
                                                                <input id="option1" type="radio" name="rating" value="5">
                                                                <label for="option1" title="5 stars">
                                                                <i class="active fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                </label>
                                                                <input id="option2" type="radio" name="rating" value="4">
                                                                <label for="option2" title="4 stars">
                                                                <i class="active fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                </label>
                                                                <input id="option3" type="radio" name="rating" value="3">
                                                                <label for="option3" title="3 stars">
                                                                <i class="active fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                </label>
                                                                <input id="option4" type="radio" name="rating" value="2">
                                                                <label for="option4" title="2 stars">
                                                                <i class="active fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                </label>
                                                                <input id="option5" type="radio" name="rating" value="1">
                                                                <label for="option5" title="1 star">
                                                                <i class="active fa fa-star mrg-lft" aria-hidden="true"></i>
                                                                </label>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="review-text btm-30">
                                        <label for="review">Write review:</label>
                                        <textarea name="comment" rows="4" class="form-control" placeholder="" autocomplete="off">{{$rating_info?$rating_info->comment:''}}</textarea>
                                        <input type="hidden" name="ebook_id" value="{{$ebook->id}}">
                                    </div>
                                    <div class="review-rating-btn text-right">
                                        @if(Auth::check())
                                        <button type="submit" class="btn btn-primary" title="Review">Submit</button>
                                        @else
                                        <a href="{{url('login')}}" class="btn btn-primary" title="Review">Submit</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="review-dtl">
                        @foreach($reviews as $rating)

                        <?php
                            $user_count = count([$rating]);
                            $user_sub_total = 0;
                            $user_sub_total = 0;
                            $user_value_t = $rating->value * 5;
                            $user_sub_total = $user_sub_total + $user_value_t;

                            $user_count = ($user_count) * 5;
                            $rat1 = $user_sub_total / $user_count;
                            $ratings_var7 = ($rating->rating * 100) / 5;

                        ?>
                        <div class="row btm-20">
                            <div class="col-lg-4 col-md-6">
                                @if(isset($rating->user))
                                <div class="review-img text-white">
                                    {{ str_limit($rating->user->fname, $limit = 1, $end = '') }}{{ str_limit($rating->user->lname, $limit = 1, $end = '') }}
                                </div>
                                <div class="review-img-block">
                                    <div class="review-month">{{ date('d-m-Y', strtotime($rating['created_at'])) }}</div>
                                    <div class="review-name">{{ $rating->user['fname'] }} {{ $rating->user['lname'] }}</div>
                                </div>
                                @endif
                            </div>
                            <div class="col-lg-8 col-md-6">
                                <div class="review-rating">
                                    <div class="pull-left-review">
                                        <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var7; ?>%" class="star-ratings-sprite-rating"></span>
                                        </div>
                                    </div>
                                    <div class="review-text">
                                        <p>{{ $rating->comment }}<p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @endforeach
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection