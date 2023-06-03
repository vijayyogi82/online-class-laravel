@extends('theme.master')
@section('title', 'Ebook')
@section('content')
@include('admin.message')
@php
$gets = App\Breadcum::first();
@endphp
@if(isset($gets))
<section id="business-home" class="business-home-main-block">
    <div class="business-img">
        @if($gets['img'] !== NULL && $gets['img'] !== '')
        <img src="{{ url('/images/breadcum/'.$gets->img) }}" class="img-fluid" alt="" />
        @else
        <img src="{{ Avatar::create($gets->text)->toBase64() }}" alt="{{ __('course')}}" class="img-fluid">
        @endif
    </div>
    <div class="overlay-bg"></div>
    <div class="container-xl">
        <div class="business-dtl">
            <div class="row">
                <div class="col-lg-6 col-md-5">
                    <div class="bredcrumb-dtl">
                        <h1 class="wishlist-home-heading">{{ __('Ebook') }}</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-7">
                    <div class="ebook-search">
                        <form method="GET" id="searchform" action="{{ route('web.ebook.search') }}" class="float-right">
                            <div class="search">
                                <input type="text" name="search" class="searchTerm"
                                    placeholder="{{ __('Search Ebook')}}">
                                <button type="submit" class="searchButton">{{ __('Search')}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<section id="ebook" class="ebook-main-block">
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" data-toggle="collapse" href="#collapseOne" data-closetxt="Stäng block" data-opentxt="Visa innehåll">
                            <a class="card-title">
                                {{ __('Categories') }}
                            </a>
                        </div>
                        <div id="collapseOne" class="collapse show" data-parent="">
                            <div class="card-body">
                                <div class="wrapper-two center-block">
                                    
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        @foreach($categories as $cate)
                                        <div class="panel panel-default">
                                            <div class="panel-heading active" role="tab" id="headingOnexxx">
                                                <h4 class="panel-title">
                                                    @if($category_id==$cate->id)
                                                    <a role="button" href="{{ url('filter/category/'.$cate->id) }}">
                                                        <i class="fa {{ $cate->image }} rgt-10"></i><label class="prime-cat text-success">{{ str_limit($cate->title, $limit = 20, $end = '..') }}</label>
                                                    </a>
                                                    @else 
                                                    <a role="button" href="{{ url('filter/category/'.$cate->id) }}">
                                                        <i class="fa {{ $cate->image }} rgt-10"></i><label class="prime-cat">{{ str_limit($cate->title, $limit = 20, $end = '..') }}</label>
                                                    </a>
                                                    @endif
                                                </h4>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-9 col-md-8">
                <div class="ebook-block">
                    <div class="row">
                        @if(count($ebooks)>0)                        
                        @php
		            		$currency = App\Currency::where('default', '=', '1')->first();
                        @endphp
                        @foreach($ebooks as $key => $item)
                        <div class="col-lg-4 col-md-6">
                            <a href="{{url('web/ebook/detail/'.$item->id)}}">
                                <div class="ebook-card">
                                    <div class="ebook-img text-center">
                                        <img src="{{ url('images/ebook/'.$item->thumbnali) }}" class="img-fluid" alt="">
                                    </div>
                                    <div class="ebook-title text-left view-dtl">
                                        <a href="{{url('web/ebook/detail/'.$item->id)}}" title=""><h5 class="mb-2">{{$item->title}}</h5></a>
                                        <div class="user-name">
                                            <h6>By <span><a href="{{url('web/ebook/detail/'.$item->id)}}">{{$item->user_id?$item->user->fname:''}} {{$item->user_id?$item->user->lname:''}}</a></span></h6>
                                        </div>
                                        <div class="view-footer ebook-price">
                                            <div class="row">
                                                <div class="col-lg-6"></div>
                                                <div class="col-lg-6">
                                                    <div class="rate text-right">
                                                        <ul>
                                                            @if($item->free=='Yes')
                                                                <li><a class="rate"><b>Free</b></a></li>
                                                            @else
                                                                @if($item->discount_check=='Yes')
                                                                <li><a class="rate"><b>{{ currency($item->discount_price, $from = $currency->code, $to = $currency->code, $format = true) }}</b></a></li>
                                                                <li><a><strike>{{ currency($item->price, $from = $currency->code, $to = $currency->code, $format = true) }}</strike></a></li>
                                                                @else
                                                                <li><a class="rate"><b>{{ currency($item->price, $from = $currency->code, $to = $currency->code, $format = true) }}</b></a></li>
                                                                @endif
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="img-wishlist ebook-buy-view-btn">
                                            <div class="protip-wishlist">
                                                <ul>
                                                    <!-- <li class="protip-wish-btn"><a href="{{url('web/ebook/addtocart/'.$item->id)}}" title="Add TO Cart"><i data-feather="shopping-cart"></i></a></li> -->
                                                    <li class="protip-wish-btn"><a href="{{url('web/ebook/detail/'.$item->id)}}" title="View"><i data-feather="eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach 
                        @else 
                        <div class="col-lg-12">
                            <div class="data-not-found">
                                <div class="text-center">
                                    <h5>No Data Found!</h5>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection