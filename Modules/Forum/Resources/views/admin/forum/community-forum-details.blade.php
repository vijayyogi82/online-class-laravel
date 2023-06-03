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
    <section id="profile-item" class="profile-item-block forum-test">
        <div class="container">
                <div class="row">
                    <!-- forum & discussion menu start -->
                    <div class="col-xl-3 col-lg-4">
                        <div class="dashboard-items">
                            <ul>
                                <li><i class="fa fa-bookmark"></i><a href="{{ route('forumsList') }}" title="All Discussions">{{ __('All Topics') }}</a></li>
                                @foreach($formcategories as $formcategory)
                                <li><i class="fa fa-circle-o"></i><a href="{{url('community-forums-fileter/'.$formcategory->id)}}" title="Profile Update">{{ $formcategory->category_name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- forum & discussion menu end -->
                    <div class="col-xl-9 col-lg-8">
                        <div class="profile-info-block">
                            <div class="profile-heading">{{ $forumLists->topic_title }}</div>
                        <!-- -------------------------------------------------------- -->
                        <div class="row">
                            <div class="col-md-12">       
                                        <div class="chat-detail">
                                            <!-- forum & discussion  main title start -->
                                            <div class="chat-head">
                                                <ul class="list-unstyled mb-0">
                                                    <li class="media">
                                                        @if($image = @file_get_contents('../public/images/user_img/'.$forumLists['user']->user_img))
                                                        <img class="mr-3 img-circle1" @error('user_img') is-invalid @enderror src="{{ url('images/user_img/'.$forumLists['user']->user_img) }}" alt="Generic placeholder image" >
                                                        @else
                                                        <img class="mr-3 img-circle1" src="{{ Avatar::create($forumLists['user']->fname)->toBase64() }}" alt="Generic placeholder image">
                                                        @endif  
                                                        @php
                                                            $old_date_timestamp = strtotime($forumLists->created_at);
                                                            $new_date = date('l, F d Y - h:m', $old_date_timestamp);
                                                        @endphp
                                                        <div class="media-body">
                                                            <h5 class="font-18">{{$forumLists->topic_title}}</h5>
                                                            <p class="mb-0">{{ $forumLists->description }}</p>
                                                            <p class="mb-0">By <a title="View user profile." href="{{url('userDetails/'.$forumLists->user->slug)}}" class="username">{{$forumLists->user->fname.' '.$forumLists->user->lname}}</a> on {{$new_date}}</p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- ---- forum & discussion  main title end ---- -->
                                                <div class="slimScrollDiv chat-body">
                                                    <!-- forum & discussion comment start -->
                                                    @forelse ($comments as $comment )
                                                    <div class="chat-head1">
                                                        <ul class="list-unstyled mb-0">
                                                            <li class="media">
                                                                @if($image = @file_get_contents('../public/images/user_img/'.$comment['user']->user_img))
                                                                <img class="mr-3 img-circle1" @error('user_img') is-invalid @enderror src="{{ url('images/user_img/'.$comment['user']->user_img) }}" alt="Generic placeholder image" >
                                                                @else 
                                                                <img class="mr-3 img-circle1" src="{{ Avatar::create($comment['user']->fname)->toBase64() }}" alt="Generic placeholder image">
                                                                @endif   
                                                                @php
                                                                    $old_date_timestamp = strtotime($forumLists->created_at);
                                                                    $new_date = date('l, F d Y - h:m', $old_date_timestamp);
                                                                @endphp
                                                                <div class="media-body">
                                                                    <h5 class="font-18">{!! $comment->description !!}</h5>
                                                                    <!-- <p class="mb-0">{!! $comment->description !!}</p> -->
                                                                    <p class="mb-0">By <a title="View user profile." href="{{url('userDetails/'.$forumLists->user->slug)}}" class="username">{{$comment->user->fname}}</a> on {{$new_date}}</p>
                                                                    @auth
                                                                    <a title="Reply" data-toggle="modal" data-target="#reply{{ $comment->id }}" class="btn btn-link"> <span class="badge badge-success">{{ __('Reply') }}</span></a>
                                                                        <!-- reply modal start -->
                                                                        <div class="modal fade" id="reply{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleStandardModalLabel">Reply On <b>{{$comment->comment_title}}</b></h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                    <!-- form start -->
                                                                                        <form action="{{ route('reply.forumsList') }}" class="form" method="POST" enctype="multipart/form-data">
                                                                                        @csrf
                                                                                        <input type="hidden" value="{{ $comment->id }}" autofocus="" class="form-control" name="parent_comment_id">
                                                                                        <input type="hidden" value="{{$forumLists->id}}" autofocus="" class="form-control" name="topic_id">
                                                                                        <!-- row start -->
                                                                                        <div class="row">
                                                                                            <!-- Comment -->
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group">
                                                                                                    <label class="text-dark">{{ __('Comment') }}: <span class="text-danger">*</span></label>
                                                                                                    <textarea class="form-control" name="comment" id="inputTextarea" rows="3" placeholder="Please Enter Comment"></textarea>
                                                                                                    @error('comment')
                                                                                                        <span class="invalid-feedback" role="alert">
                                                                                                            <strong>{{ $message }}</strong>
                                                                                                        </span>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </div>
                                                                                            <!-- Reply and Reset button -->
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group">
                                                                                                    <button type="reset" class="btn btn-danger mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
                                                                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>{{ __("Reply")}}</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div><!-- row end -->
                                                                                    </form>
                                                                                    <!-- form end -->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- reply modal end -->
                                                                    @endauth
                                                                    @guest
                                                                        <a href="{{url('login')}}">{{ __('Log in') }}</a>
                                                                    @endguest
                                                                </div>
                                                                <!-- -------------- -->
                                                                <!-- edit & delete button start -->
                                                                <div class="dropdown" style="{{ Auth::user()->id == $comment->posted_by_user_id  ? '' : 'display:none' }}">
                                                                    <button class="btn btn-link p-0 font-18 float-right" type="button" id="upcomingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>
                                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="upcomingTask">
                                                                        <a class="dropdown-item btn btn-link" data-toggle="modal" data-target="#edit{{ $comment->id }}" ><i class="far fa-edit mr-3"></i>{{ __("Edit") }}</a>
                                                                        <a class="dropdown-item btn btn-link" data-toggle="modal" data-target="#delete{{ $comment->id }}" ><i class="fas fa-backspace mr-3"></i>{{ __("Delete") }}</a>
                                                                    </div>
                                                                </div>
                                                                <!-- edit & delete button end -->
                                                                <!-- delete Modal start -->
                                                                <div class="modal fade bd-example-modal-sm" id="delete{{ $comment->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                    <div class="modal-dialog modal-sm">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleSmallModalLabel">{{ __('Delete') }}</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <h4>{{ __('Are You Sure ?')}}</h4>
                                                                                <p>{{ __('Do you really want to delete')}} <b>{{ $comment->comment_title }}</b> ? {{ __('This process cannot be undone.')}}</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <form method="post" action="{{url('community-forums/delete/'.$comment->id)}}" class="pull-right">
                                                                                    {{csrf_field()}}
                                                                                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">{{ __('No') }}</button>
                                                                                    <button type="submit" class="btn btn-primary">{{ __('Yes') }}</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- delete Model ended -->
                                                                <!-- Edit modal start -->
                                                                <div class="modal fade" id="edit{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleStandardModalLabel">{{ __('Edit') }} <b>{{ $comment->comment_title }}</b></h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                            <!-- form start -->
                                                                                <form action="{{url('community-forums/edit/'.$comment->id)}}" class="form" method="POST" novalidate enctype="multipart/form-data">
                                                                                @csrf
                                                                                <!-- row start -->
                                                                                <div class="row">
                                                                                    <!-- Comment -->
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label class="text-dark">{{ __('Comment') }}: <span class="text-danger">*</span></label>
                                                                                            <textarea class="form-control @error('comment') is-invalid @enderror" name="comment" id="inputTextarea" rows="3" placeholder="Please Enter Comment" required="">{{ $comment->description }}</textarea>
                                                                                            @error('comment')
                                                                                                <span class="invalid-feedback" role="alert">
                                                                                                    <strong>{{ $message }}</strong>
                                                                                                </span>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div> 
                                                                                    <!-- Update and reset button -->
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <button type="reset" class="btn btn-danger mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
                                                                                            <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>
                                                                                            {{ __("Update")}}</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div><!-- row end -->
                                                                            </form>
                                                                            <!-- form end -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Edit modal end -->
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- forum & discussion comment end -->
                                                    <!-- forum & discussion reply start -->
                                                    @forelse ($comment->childrenCat as $subComment )
                                                        <div class="chat-head2">
                                                            <ul class="list-unstyled mb-0">
                                                                <li class="media">
                                                                    @if($image = @file_get_contents('../public/images/user_img/'.$subComment['user']->user_img))
                                                                    <img class="align-self-center mr-3 img-circle1" @error('user_img') is-invalid @enderror src="{{ url('images/user_img/'.$subComment['user']->user_img) }}" alt="Generic placeholder image" >
                                                                    @else
                                                                    <img class="align-self-center mr-3 img-circle1" src="{{ Avatar::create($subComment['user']->fname)->toBase64() }}" alt="Generic placeholder image">
                                                                    @endif  
                                                                    @php
                                                                        $old_date_timestamp = strtotime($subComment->created_at);
                                                                        $new_date = date('l, F d Y  - h:m', $old_date_timestamp);
                                                                    @endphp
                                                                    <div class="media-body">
                                                                        <h5 class="font-18">{{$subComment->description}}</h5>
                                                                        <p class="mb-0">By <a title="View user profile." href="{{url('userDetails/'.$forumLists->user->slug)}}" class="username">{{$subComment->user->fname}}</a> on {{$new_date}}</p>
                                                                        <!-- =============== -->
                                                                        @auth
                                                                        <!-- reply modal start -->
                                                                        <div class="modal fade" id="reply{{ $subComment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleStandardModalLabel">Reply On <b>{{$subComment->comment_title}}</b></h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                    <!-- form start -->
                                                                                        <form action="{{ route('reply.forumsList') }}" class="form" method="POST" enctype="multipart/form-data">
                                                                                        @csrf
                                                                                        <input type="hidden" value="{{ $subComment->id }}" autofocus="" class="form-control" name="parent_comment_id">
                                                                                        <input type="hidden" value="{{$subComment->id}}" autofocus="" class="form-control" name="topic_id">
                                                                                        <!-- row start -->
                                                                                        <div class="row">
                                                                                            <!-- Comment -->
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group">
                                                                                                    <label class="text-dark">{{ __('Comment') }}: <span class="text-danger">*</span></label>
                                                                                                    <textarea class="form-control" name="comment" id="inputTextarea" rows="3" placeholder="Please Enter Comment"></textarea>
                                                        
                                                                                                    @error('comment')
                                                                                                        <span class="invalid-feedback" role="alert">
                                                                                                            <strong>{{ $message }}</strong>
                                                                                                        </span>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </div>  
                                                                                            <!-- reply and reset button -->
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group">
                                                                                                    <button type="reset" class="btn btn-danger mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
                                                                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>
                                                                                                    {{ __("Reply")}}</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div><!-- row end -->
                                                                                    </form>
                                                                                    <!-- form end -->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- reply modal end -->
                                                                    @endauth
                                                                    @guest
                                                                        <a href="{{url('login')}}">Log in</a>
                                                                    @endguest
                                                                    <!-- ==================== -->
                                                                    <!-- edit & delete button start --> 
                                                                    <div class="dropdown" style="{{ Auth::user()->id == $subComment->posted_by_user_id  ? '' : 'display:none' }}">
                                                                        <button class="btn btn-link p-0 font-18 float-right btn-link-one" type="button" id="upcomingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>
                                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="upcomingTask">
                                                                            <a class="dropdown-item btn btn-link" data-toggle="modal" data-target="#edit{{ $subComment->id }}" ><i class="far fa-edit mr-3"></i>{{ __("Edit") }}</a>
                                                                            <a class="dropdown-item btn btn-link" data-toggle="modal" data-target="#delete{{ $subComment->id }}" ><i class="fas fa-backspace mr-3"></i>{{ __("Delete") }}</a>
                                                                        </div>
                                                                    </div>
                                                                    <!-- edit & delete button end -->
                                                                    </div>
                                                                <!-- delete Modal start -->
                                                                <div class="modal fade bd-example-modal-sm" id="delete{{ $subComment->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                    <div class="modal-dialog modal-sm">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleSmallModalLabel">{{ __('Delete') }}</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                    <h4>{{ __('Are You Sure ?')}}</h4>
                                                                                    <p>{{ __('Do you really want to delete')}} <b>{{ $subComment->description }}</b> ? {{ __('This process cannot be undone.')}}</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <form method="post" action="{{url('community-forums/delete/'.$subComment->id)}}" class="pull-right">
                                                                                    {{csrf_field()}}
                                                                                
                                                                                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">{{ __('No') }}</button>
                                                                                    <button type="submit" class="btn btn-primary">{{ __('Yes') }}</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- delete Model ended -->
                                                                <!-- Edit modal start -->
                                                                <div class="modal fade" id="edit{{ $subComment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleStandardModalLabel">{{ ('Edit') }} <b>{{ $subComment->comment_title }}</b></h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                            <!-- form start -->
                                                                                <form action="{{url('community-forums/edit/'.$subComment->id)}}" class="form" method="POST" novalidate enctype="multipart/form-data">
                                                                                @csrf
                                                                                <!-- row start -->
                                                                                <div class="row">
                                                                                    <!-- Comment -->
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label class="text-dark">{{ __('Comment') }}: <span class="text-danger">*</span></label>
                                                                                            <textarea class="form-control @error('comment') is-invalid @enderror" name="comment" id="inputTextarea" rows="3" placeholder={{ __("Please Enter Comment") }} required="">{{ $subComment->description }}</textarea>
                                                                                            @error('comment')
                                                                                                <span class="invalid-feedback" role="alert">
                                                                                                    <strong>{{ $message }}</strong>
                                                                                                </span>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- create and close button -->
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <button type="reset" class="btn btn-danger mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
                                                                                            <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>
                                                                                            {{ __("Update")}}</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div><!-- row end -->
                                                                            </form>
                                                                            <!-- form end -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Edit modal end -->
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @empty
                                                        @endforelse
                                                    @empty
                                                    @endforelse
                                                    <!-- forum & discussion reply end  -->
                                                    <!-- forum & discussion add new comment start -->
                                                    <div class="chat-message">
                                                        <form method="get" action="{{url('community-forums/save/0')}}">
                                                            @csrf                       
                                                            <!-- row start -->
                                                            <div class="row">
                                                            <input type="hidden" name="topic_id" value="{{$forumLists->id}}" />
                                                                <!-- Comment -->
                                                                <div class="col-md-12">
                                                                    <div class="form-group comment-form">
                                                                        <label class="text-dark">{{ __('Comment') }}: <span class="text-danger">*</span></label>
                                                                        <textarea class="form-control" name="comment" id="inputTextarea" rows="3" placeholder={{ __("Please Enter Comment") }}></textarea>
                                                                        @error('comment')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <!-- create and close button -->
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <button type="reset" class="btn btn-danger mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
                                                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>
                                                                        {{ __("Comment")}}</button>
                                                                    </div>
                                                                </div>
                                                            </div><!-- row end -->
                                                        </form>
                                                        <!-- form end -->
                                                    </div>
                                                    <!-- ==================== Add new comment end =============================== -->
                                                </div>
                                        </div>
                                    </div>
                            <!-- End col -->
                        </div>	                
                    </div>
                </div>
        </div> 
    </section>
<!-- forum & discussion detail end -->
@endsection