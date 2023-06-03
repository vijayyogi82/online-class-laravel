@extends('theme.master')
@section('title', 'Mybook')
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
                <div class="col-lg-6">
                    <div class="bredcrumb-dtl">
                        <h1 class="wishlist-home-heading">{{ __('My Ebooks') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<section id="my-ebook" class="my-ebook-main-block">
    <div class="container-xl">
        <h4>Total {{count($myebooks)}} Ebooks purchased</h4>
        <div class="ebook-block">
            <div class="row">
                @foreach($myebooks as $key => $mybook)
                <div class="col-lg-3 col-md-4">
                    <div class="ebook-card">
                        <div class="ebook-img text-center">
                            @if($mybook->ebook->thumbnali !== NULL && $mybook->ebook->thumbnali !== '')
                                <img src="{{ asset('images/ebook/'.$mybook->ebook->thumbnali) }}" class="img-fluid">
                            @else
                                <img src="{{ Avatar::create($mybook->ebook->title)->toBase64() }}" class="img-fluid">
                            @endif
                        </div>
                        <div class="ebook-title text-left view-dtl">
                            <div class="view-heading">
                                <a href="{{ url('web/ebook/detail/'.$mybook->ebook->id) }}" title=""><h5 class="mb-2">{{ str_limit($mybook->ebook->title, $limit =35 , $end = '...') }}</h5></a>
                            </div>
                            <div class="user-name">
                                <h6>By <span><a href="javascript:"> {{$mybook->ebook->user_id?$mybook->ebook->user->fname:''}} {{$mybook->ebook->user_id?$mybook->ebook->user->lname:''}}</a></span></h6>
                            </div>
                            <div class="view-footer ebook-price text-center">
                                <div class="row">
                                    @if(isset($mybook->ebook->all_file))
                                    <div class="col-lg-4 col-md-4 col-4">
                                        <div class="download-btn">
                                            <a href="{{ url('images/ebook/all_file/'.$mybook->ebook->all_file)}}" target="_blank" type="button" class="btn btn-success" title="Download"><i data-feather="download"></i></a>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-lg-4 col-md-4 col-4">
                                        <div class="rating-btn">
                                            <a href="javascript:" type="button" class="btn btn-warning" data-toggle="modal" data-target="#rating-modal{{$mybook->id}}" title="Rating"><i data-feather="star"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-4">
                                        <div class="invoice-btn">
                                            <a href="{{url('my/ebook/invoice/'.$mybook->id)}}" type="button" class="btn btn-secondary" title="Invoice"><i data-feather="file-text"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="rating-modal{{$mybook->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Rating</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{url('ebook/rating')}}" class="form" method="POST" novalidate enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="ebook-reviews-block btm-20">
                                                <h4>Ebook Review</h4>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="ebook-rating">
                                                            <!-- <h3 class="rating-no">5.0</h3> -->
                                                        </div>
                                                        <div class="ebook-reviews">
                                                            <div class="review-table">
                                                                <table class="table">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="star-rating">
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
                                                            <textarea name="comment" rows="4" class="form-control" placeholder="" autocomplete="off"></textarea>
                                                            <input type="hidden" name="ebook_id" value="{{$mybook->ebook_id}}">
                                                        </div>
                                                        <div class="review-rating-btn text-right">
                                                            <button type="submit" class="btn btn-primary" title="Review">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection
@section('script')
  <script>
    function rating(ebook_id) {
        alert(ebook_id);
    }
  </script>
@endsection