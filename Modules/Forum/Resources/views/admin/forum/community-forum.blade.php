@extends('theme.master')
@section('title', __('Forum & Discussions'))
@section('custom-head')
    <link rel="stylesheet" href="{{ Module::asset('Forum:css/custom.css') }}">
@endsection
@section('content')

@include('admin.message')
<!-- forum & discussion heading start -->
<section id="blog-home" class="blog-home-main-block">
    <div class="container">
        <h1 class="blog-home-heading text-white">{{ __('Forum & Discussions') }}</h1>
    </div>
</section>
<!-- forum & discussion heading end -->
<section id="profile-item" class="profile-item-block forum-page">
    <div class="container">
        <div class="row">
            <!-- forum & discussion menu start -->
            <div class="col-xl-3 col-lg-4">
                <div class="dashboard-items">
                    <ul>
                        @if(Auth::User()->role == "admin" )
                        <li><i class="fa fa-plus"></i><a class="btn btn-link" data-toggle="modal" data-target="#newdiscusion">{{ __('Add New Topic') }}</a></li>
                        <li><i class="fa fa-plus"></i><a class="btn btn-link" data-toggle="modal" data-target="#addcategory">{{ __('Add Category') }}</a></li>
                        @endif
                        <li><i class="fa fa-bookmark"></i><a href="{{ route('forumsList') }}" title='{{ __("All Discussions") }}'>{{ __('All Topics') }}</a></li>
                        @foreach($formcategories as $formcategory)
                        <li><i class="fa fa-circle-o"></i><a href="{{url('community-forums-fileter/'.$formcategory->id)}}" title='{{ __("Profile Update") }}'>{{ $formcategory->category_name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- forum & discussion menu end -->
            <div class="col-xl-9 col-lg-8">
                <div class="profile-info-block">
                    <div class="profile-heading">{{ __('All Topic') }}</div>
                    <!-- forum & discussion main content start -->
                    <div class="row">
                        @forelse ($forumLists as $forumList)
                        <div class="col-md-6">
                            <div class="card m-b-30">
                                @if($forumList->photo != '' &&
                                file_exists(public_path().'/admin_assets/forum/'.$forumList->photo))
                                <img class="card-img-top" @error('photo') is-invalid @enderror src="{{ url('admin_assets/forum/'.$forumList->photo) }}" />
                                @else
                                <img class="card-img-top" src="{{ url('admin_assets/images/blog/blog-1.jpg') }}" alt='{{ __("image") }}'>
                                @endif
                                <div class="card-body">
                                    <p class="text-center mb-3"><span class="badge badge-success">{{ __("Category :") }}{{ $forumList->forumcategory->category_name ?? '-'}}</span></p>
                                    <h5 class="card-title text-center font-18"><a href="{{url('community-forums/'.$forumList->slug)}}">{{ $forumList->topic_title }}</a></h5>
                                    <p class="card-text text-center mb-0">{!! str_limit(strip_tags($forumList->description), $limit = 40, $end = '...') !!}</p>
                                </div>
                                <div class="card-footer">
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <div class="blog-link">
                                                <a href="{{ url('community-forums/'.$forumList->slug) }}" class="btn btn-primary-rgba">More<i class="fas fa-arrow-right ml-2"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="blog-meta">
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item">
                                                        @php
                                                        $old_date_timestamp = strtotime($forumList->created_at);
                                                        $new_date = date('l, F d Y ', $old_date_timestamp);
                                                        @endphp
                                                        {{ $new_date }}
                                                    </li>
                                                    <li class="list-inline-item">|</li>
                                                    <li class="list-inline-item">{{ __("by:") }} <a href="{{url('community-forums/'.$forumList->slug)}}">{{$forumList->user->fname.' '.$forumList->user->lname}}</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <h3>{{ __("Ooop !! No Data Found...") }}</h3>
                        @endforelse
                    </div>
                    <!-- forum & discussion pagination start -->
                    <div class="pagination">
                        {!! $forumLists->links() !!}
                    </div>
                    <!-- forum & discussion pagination end -->
                    <!-- forum & discussion main content end -->
                    <!-- add category start -->
                    <div class="modal fade" id="addcategory" tabindex="-1" role="dialog"
                        aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleStandardModalLabel">{{ __("Add Category") }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- form start -->
                                    <form action="{{ route('add.forumsCategory') }}" class="form" method="POST" novalidate enctype="multipart/form-data">
                                        @csrf
                                        <!-- row start -->
                                        <div class="row">
                                            <!-- category_name -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="text-dark">{{ __('Category Name:') }} <span class="text-danger">*</span></label>
                                                    <input type="text" value="" autofocus="" class="form-control @error('category_name') is-invalid @enderror" placeholder="{{ __('Enter Category Name') }}" name="category_name" required="">
                                                    @error('category_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- status -->
                                            <div class="form-group col-md-2">
                                                <label class="text-dark" for="exampleInputDetails">{{ __('Status:') }}</label><br>
                                                <label class="switch">
                                                    <input type="checkbox" name="status" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                            <!-- Save and Reset button -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="reset" class="btn btn-danger mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>{{ __("Save")}}</button>
                                                </div>
                                            </div>
                                        </div><!-- row end -->
                                    </form>
                                    <!-- form end -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- add category end -->
                    <!-- add new discusion start -->
                    <div class="modal fade" id="newdiscusion" tabindex="-1" role="dialog"
                        aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleStandardModalLabel">{{ __("Add New Forum") }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- form start -->
                                    <form action="{{ route('add.forumsList') }}" class="form" method="POST" novalidate enctype="multipart/form-data">
                                        @csrf
                                        <!-- row start -->
                                        <div class="row">
                                            <!-- Topic -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="text-dark">{{ __('Topic:') }} <span class="text-danger">*</span></label>
                                                    <input type="text" value="" autofocus="" class="form-control @error('topic_title') is-invalid @enderror" placeholder="{{ __('Enter Topic Title') }}" name="topic_title" required="">
                                                    @error('topic_title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Category -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="text-dark">{{ __('Select Category:') }} <span class="text-danger">*</span></label>
                                                    <select class="select2-single form-control" name="category_id">
                                                        <option>{{ __("Select Category") }}</option>
                                                        @foreach($formcategories as $formcategory)
                                                        <option value="{{ $formcategory->id }}">
                                                            {{ $formcategory->category_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- description -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="text-dark">{{ __('Description') }}: <span class="text-danger">*</span></label>
                                                    <textarea class="form-control" name="description" id="inputTextarea" rows="3" placeholder="{{ __('Please Enter Description') }}"></textarea>
                                                    @error('description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Image -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="text-dark">{{ __('Image') }} <span class="text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroupFileAddon01">
                                                                {{__('Upload')}}
                                                            </span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="photo" aria-describedby="inputGroupFileAddon01">
                                                            <label class="custom-file-label" for="inputGroupFile01">{{ __('Choose file') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Status -->
                                            <div class="form-group col-md-2">
                                                <label class="text-dark" for="exampleInputDetails">{{ __('Status') }}</label><br>
                                                <label class="switch">
                                                    <input type="checkbox" name="status" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                            <!-- Save and Reset button -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="reset" class="btn btn-danger mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> {{ __("Save")}}</button>
                                                </div>
                                            </div>
                                        </div><!-- row end -->
                                    </form>
                                    <!-- form end -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- add new discusion end -->
                </div>
            </div>
        </div>
</section>
<!-- forum & discussion end -->
@endsection