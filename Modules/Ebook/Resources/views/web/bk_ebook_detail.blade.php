@extends('theme.master')
@section('title', 'Institute Profile')
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
                        <h1 class="wishlist-home-heading">{{ __('Ebook / Adobe photoshop complete guidelines') }}</h1>
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
                <div class="col-lg-3">
                    <div class="ebook-deatil-img">
                        <img src="{{ url('images/ebook/ebook-02.jpg') }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="ebook-dtl-block">
                        <h4 class="mb-2">Adobe photoshop complete guidelines</h4>
                        <div class="user-name mb-2">
                            <h6>Created By <span><a href="#"> John Doe</a></span></h6>
                        </div>
                        <ul class="mb-3">
                            <li class="mb-2">Publication name : Isaac Asimov</li>
                            <li class="mb-2">Published date : Tue, 08-Oct-2022</li>
                            <li class="mb-2">Category name : Education</li>
                        </ul>
                        <div class="ebook-dtl-btn">
                            <ul>
                                <li class="mr-2">
                                    <div class="ebook-read-btn">
                                        <a href="#" type="button" class="btn btn-primary" data-toggle="modal" data-target="#readpreviewmodal">Read preview</a>
                                    </div>
                                </li>
                                <li>    
                                    <div class="ebook-buy-btn">
                                        <a href="#" type="button" class="btn btn-warning">Buy Now</a>
                                    </div>
                                </li>
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
                                    ...
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ebook-dtl-price">
                        <div class="rate text-right">
                            <ul class="mb-2">
                                <li class="rate-r">800.00$&nbsp; <br><s>1500.00$</s> </li>
                            </ul>
                            <div class="rating">
                                <ul>
                                    <li> 
                                        <div class="pull-left">
                                            <div class="star-ratings-sprite">
                                                <span style="width:100%" class="star-ratings-sprite-rating"></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="reviews">
                                        (1 Reviews)
                                    </li>
                                </ul>
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
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                        </div>
                        <div class="tab-pane fade" id="pills-specification" role="tabpanel" aria-labelledby="pills-specification-tab">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">Title</th>
                                        <td>Adobe photoshop complete guidelines</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Author</th>
                                        <td>John Doe</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Publisher</th>
                                        <td>Isaac Asimov</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Edition</th>
                                        <td>New</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">No. of page</th>
                                        <td>13</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="pills-author" role="tabpanel" aria-labelledby="pills-author-tab">
                            <div class="ebook-author-block">
                                <div class="ebook-author-img">
                                    <img src="{{ url('images/ebook/user.png') }}" class="img-fluid" alt="">
                                </div>
                                <div class="ebook-author-title">
                                    <h4>John Doe</h4>
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
                    <h4>Other related ebooks</h4>
                    <div class="about-instructor-block btm-40">
                        <h4>About Instructor</h4>
                        <div class="about-instructor">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-4">
                                    <div class="instructor-img btm-30">
                                        <a href="http://localhost/eclass_5.0_new/public/instructor/2/11" title="instructor">
                                            <img src="http://localhost/eclass_5.0_new/public/images/user_img/159116551043.jpg" class="img-fluid" alt="instructor">
                                        </a>                            
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-9 col-8">
                                    <div class="instructor-block">
                                        <div class="instructor-name btm-10">
                                            <a href="http://localhost/eclass_5.0_new/public/instructor/2/11" title="instructor-name"> Instructor Example </a>
                                        </div>
                                        <div class="instructor-post btm-5">About Instructor</div>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p><p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ebook-reviews-block btm-60">
                        <h4>Ebook Review</h4>
                        <div class="row">
                            <div class="col-lg-12 my-3">
                                <div class="ebook-rating">
                                    <h3 class="rating-no">5.0</h3>
                                </div>
                                <div class="ebook-reviews">
                                    <div class="review-table">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="star-rating">
                                                            <input id="option1" type="radio" name="learn" value="5">
                                                            <label for="option1" title="5 stars">
                                                            <i class="active fa fa-star mrg-lft" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="option2" type="radio" name="learn" value="4">
                                                            <label for="option2" title="4 stars">
                                                            <i class="active fa fa-star mrg-lft" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="option3" type="radio" name="learn" value="3">
                                                            <label for="option3" title="3 stars">
                                                            <i class="active fa fa-star mrg-lft" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="option4" type="radio" name="learn" value="2">
                                                            <label for="option4" title="2 stars">
                                                            <i class="active fa fa-star mrg-lft" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="option5" type="radio" name="learn" value="1">
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
                                    <textarea name="review" rows="4" class="form-control" placeholder="" autocomplete="off"></textarea>
                                </div>
                                <div class="review-rating-btn text-right">
                                    <button type="submit" class="btn btn-primary" title="Review">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection