@extends('theme.master')
@section('title', 'Show Job')
@section('content')
<!-- css section start-->
@section('custom-head')
<link rel="stylesheet" href="{{ Module::asset('resume:css/resume.css') }}">
<link rel="stylesheet" href="{{ Module::asset('resume:css/style.css') }}">
<link rel="stylesheet" href="{{ Module::asset('resume:css/show.css') }}">
@endsection
<!-- css section end-->
@include('admin.message')
<!-- section start-->
<section class="blog-home-main-block">
    <p class="ml-md-5">{{ __('Show') }} <span class="name">[{{ filter_var($job->companyname) }}]</span></p>
</section>
<!-- section end-->

<!-- section start-->
<section id="blog" class="back">
    <!-- container start-->
    <div class="container">
        <!-- row start-->
        <div class="row justify-content-center">
            <div class="col-md-12 bord mt-5  mb-5 ">
                <!-- card start-->
                <div class="  mb-3 ">
                    <div class="row ml-2 mr-2 mt-3 mb-3">
                        <div class="col-md-10">
                            <h5 class="title"> {{ filter_var($job->title) }} @if( filter_var($job->varified) == 1) <img
                                    src="{{ Module::asset('resume:image/verified.png') }}" class="img-fluid verfied"
                                    alt="image"> @endif</h5>
                            <p>{{ filter_var($job->companyname) }}</p>
                            <p class="p-color"> <i class="fa fa-suitcase mr-2"></i>
                                {{ filter_var($job->min_experience) }} - {{ filter_var($job->max_experience) }}
                                {{ filter_var($job->experience) }} &nbsp; &nbsp; <i
                                    class="fa fa-map-marker mr-2"></i>{{ filter_var($job->location) }}</p>
                            <p class="p-color"><i class="fa fa-file-text-o mr-2"
                                    aria-hidden="true"></i>{{ substr($job->description,0,100) }}...</p>
                            <p class="p-color mt-3">{{ str_replace(',', '   .   ', ucfirst(trans($job->skills)) )}}</p>

                            <p class="p-color mt-3"><span class="date-color"><i class="fa fa-clock-o mr-1 ml-2"
                                        aria-hidden="true"></i>{{ filter_var($job->created_at->diffForHumans()) }}</span>
                                <span class="date-color">{{ __("Job Applicants") }} &nbsp;
                                    {{ filter_var($job->postjob->count()) }}</span></p>
                        </div>
                        <div class="col-md-2">
                            @if(filter_var($job->image))
                            <img src="{{ asset('files/job/'.filter_var($job->image)) }}" class="img-fluid job1-image "
                                alt="image">
                            @else
                            <img src="{{ Module::asset('resume:image/noimage.jpg') }}" class="img-fluid search1-image"
                                alt="image">
                            @endif
                        </div>

                    </div>
                </div>
                <!-- card end-->

            </div>
            <!-- card start-->
            <div class="card col-md-12 mb-5">
                <!-- table start-->
                <div class="table-responsive mt-3 mb-3">
                    <!-- Start table-->
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('Id') }}</th>
                                <th>{{ __('Skills') }}</th>
                                <th>{{ __('Experience') }}</th>
                                <th>{{ __('Resume') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applyjobs as $key => $job)
                            <tr>
                                <td>
                                    {{ filter_var($key+1)}}
                                </td>
                                <td>
                                    {{ filter_var($job->skills)}}
                                </td>
                                <td>
                                    @if(filter_var($job->experiense))
                                    {{ filter_var($job->experiense)}} {{ filter_var($job->years)}}
                                    @else
                                    <p>{{ __("Fresher") }}</p>
                                    @endif
                                </td>
                                <td>
                                    @if(filter_var($job->pdf))
                                    <a href="{{ route('resume.download',['id'=> filter_var($job->id)]) }}"
                                        title="download resume" class="btn btn-outline-info btn-sm"><i
                                            class="fa fa-arrow-circle-o-down" aria-hidden="true"></i></a>
                                    @else
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-info btn-sm" title="view resume"
                                        data-toggle="modal" data-target="#view_{{ filter_var($job->id) }}">
                                        <i class="fa fa-eye"></i>
                                    </button>


                                    @endif
                                </td>

                            </tr>
                            <!-- Modal -->


                            @endforeach
                        </tbody>
                    </table>
                    <!-- end table -->
                    <div class="mx-auto mb-3 paginate-resume">
                        {!! $applyjobs->links() !!}
                    </div>
                </div>
                <!-- table end-->
            </div>
            <!-- card end-->
        </div>
        <!-- row end-->
    </div>
    <!-- container end-->
</section>
<!-- section end-->

@foreach ($applyjobs as $key => $job)

<?php
    $persoanl       =  Modules\Resume\Models\Personalinfo::where('user_id',$job->user_id)->first();
    $educationview  =  Modules\Resume\Models\Acedemic::where('user_id',$job->user_id)->get();
    $projectview    =  Modules\Resume\Models\Project::where('user_id',$job->user_id)->get();
    $worksview      =  Modules\Resume\Models\Workexp::where('user_id',$job->user_id)->get();
?>
@if($job->pdf)
@else
<div class="modal fade" id="view_{{ filter_var($job->id) }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <!-- model content start-->
        <div class="modal-content">
            <!-- row start -->
            <div class="row">
                <div class="col-md-4 bg-info ">
                    @if(filter_var($persoanl->image))
                    <img src="{{ asset('files/resume/'.filter_var($persoanl->image)) }}"
                        class="img-fluid resume-image d-block mt-4 mb-4 " alt="image">
                    @else
                    <img src="{{ Module::asset('resume:image/noimage.jpg') }}"
                        class="img-fluid resume-image1 d-block mt-4 mb-4 " alt="image">
                    @endif
                    <div class="invoice-info">
                        <p class=text-white mt-4"> <i
                                class="fa fa-map-marker mr-2 "></i>{{ filter_var($persoanl->address)}}</p>
                        <p class="text-white mt-4"><i class="fa fa-phone  mr-2"></i>{{ filter_var($persoanl->phone)}}
                        </p>
                        <p class="text-white mt-4"><i class="fa fa-envelope  mr-2"></i>{{ filter_var($persoanl->email)}}
                        </p>
                        <p class="text-white mt-4">
                            <b>{{ __("Profession :") }}</b><br>{{ filter_var($persoanl->profession)}}</p>
                        <p class="text-white mt-4"><b>{{ __("Skills :") }}</b><br>{{ filter_var($persoanl->skill)}}</p>
                        <p class="text-white mt-4"><b>{{ __("Strength :") }}</b><br>{{ filter_var($persoanl->strength)}}
                        </p>
                        <p class="text-white mt-4"><b>{{ __("Interest :") }}</b><br>{{ filter_var($persoanl->interest)}}
                        </p>
                        <p class="text-white mt-4"><b>{{ __("Language :") }}</b><br>{{ filter_var($persoanl->language)}}
                        </p>
                    </div>
                </div>

                <div class="col-md-8 bg-white">
                    <h3 class="text-primary  mt-3">{{ filter_var($persoanl->fname)}} {{ filter_var($persoanl->lname)}}
                    </h3>
                    <h5 class="mt-3 text-info">{{ __("OBJECTIVE :") }}</h5>
                    <p>{{ filter_var($persoanl->objective) }}</p>
                    <h5 class="mt-3 text-info">{{ __("EDUCATION :") }}</h5>
                    <div class="row">
                        @foreach($educationview as $persoanl)
                        <div class="col-md-4 form-group">
                            <p>{{ filter_var($persoanl->course)}}</p>
                        </div>
                        <div class="col-md-8">
                            <p><span class="text-font">{{ filter_var($persoanl->school)}}</span> <br>
                                {{ filter_var($persoanl->marks)}} - {{ filter_var($persoanl->yearofpassing)}}</p>
                        </div>
                        @endforeach
                    </div>
                    <h5 class="mt-3 text-info">{{ __("EXPERIENCE :") }}</h5>
                    <div class="row">
                        @foreach($worksview as $work)
                        <div class="col-md-4 form-group">
                            <p> {{ date('d-m-Y', strtotime(filter_var($work->startdate)))}} -
                                {{ date('d-m-Y', strtotime(filter_var($work->enddate)))}}</p>
                        </div>
                        <div class="col-md-8">
                            <p><span class="text-font">{{ filter_var($work->jobtitle)}}</span><br>
                                {{ filter_var($work->employer)}} <br>
                                {{ filter_var($work->city)}},{{ filter_var($work->state)}}</p>
                        </div>
                        @endforeach
                    </div>
                    <h5 class="mt-3 text-info">{{ __("PROJECT :") }}</h5>
                    <div class="row">
                        @foreach($projectview as $persoanl)
                        <div class="col-md-12">
                            <ul>
                                <li>
                                    <p><span class="text-font">{{ filter_var($persoanl->projecttitle)}}
                                            [{{ filter_var($persoanl->role)}}] </span><br>
                                        {{ filter_var($persoanl->description)}}</p>
                                </li>
                            </ul>
                        </div>
                        @endforeach
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endif
@endforeach
@endsection
<!-- This section will contain javacsript start -->
@section('custom-script')
<script src="{{ Module::asset('resume:js/resume.js') }}"></script>
<script src="{{ Module::asset('resume:js/job.js') }}"></script>
<script src="{{ Module::asset('resume:js/append.js') }}"></script>
@endsection
<!-- This section will contain javacsript end -->