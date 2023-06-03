@extends('admin.layouts.master')
 <!--section start --> 
@section('title',__('Homework - Admin'))
@section('maincontent')
<?php
$data['heading'] = 'Homework';
$data['title'] = 'Homework';
?>
@include('admin.layouts.topbar',$data)
 <!--back and add homework button start--> 
 <!--contentbar start--> 
<div class="contentbar">
     <!--row start--> 
    <div class="row">
        <div class="col-lg-12">
              <!--card start--> 
            <div class="card dashboard-card m-b-30">
                  <!--card header start--> 
                <div class="card-header">
                    <h5 class="card-box">{{ __('Homework') }} <span class="text-muted">({{ filter_var($course->title) }})</span></h5>
                    <div>
                        <a href="{{ url('homework_create/'.$course->id) }}" class="float-right btn btn-primary-rgba "><i
                           class="feather icon-plus mr-2"></i>{{ __("Add Homework") }}</a>
                         <a href="{{url('course')}}" class="btn btn-primary-rgba mr-2"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
                                    
                     </div>
                </div> 
               <!--card header end--> 
            
                 <!--card body start--> 
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                                <th>{{ __('Id') }}</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Submitted homwork') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Compulsory') }}</th>
                                <th>{{ __('Out of marks') }}</th>
                                <th>{{ __('Submission Date') }}</th>
                                <th>{{ __('Action') }}</th>
                            </thead>
                            @if(Auth::User()->role == "admin")
                            <tbody>
                                @foreach($homework as $key => $homework)
                                <tr>
                                    <td>{{ filter_var($key+1) }}</td>
                                    <td>{{ filter_var($homework->title) }}</td>
                                    <td>{{ filter_var($homework->description) }}</td>
                                    <td><a title="submitted homework" href="{{route('homework.view',["id" =>$homework->id,"cat" => $course->id])}}"><i class="feather icon-check-circle mr-2"></i></a></td>
                                    <td>
                                        <label class="switch">
                                            <input class="status" type="checkbox" data-id="{{ filter_var($homework->id)}}" name="status" {{ filter_var($homework->status) == '1' ? 'checked' : '' }}>
                                            <span class="knob"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input class="compulsory" type="checkbox" data-id="{{ filter_var($homework->id)}}" name="compulsory" {{ filter_var($homework->compulsory) == '1' ? 'checked' : '' }}>
                                            <span class="knob"></span>
                                        </label>
                                    </td>
                                    <td>{{ filter_var($homework->marks) }}</td>
                                    <td>{{ filter_var($homework->endtime) }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-round btn-outline-primary" type="button" id="CustomdropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">
                                                <a class="dropdown-item" href="{{route('homework.download',["id" =>$homework->id])}}"><i class="feather icon-eye mr-2"></i>{{ __("View Homework") }}</a>
                                                <a class="dropdown-item" href="{{route('homework.edit',["id" =>$homework->id,"cat" => $course->id])}}"><i class="feather icon-edit mr-2"></i>{{ __("Edit") }}</a>
                                                <a class="dropdown-item" href="{{route('homework.view',["id" =>$homework->id,"cat" => $course->id])}}"><i class="feather icon-check-circle  mr-2"></i>{{ __("Submitted Homework") }}</a>
                                                <a class="dropdown-item btn btn-link" data-toggle="modal" data-target="#delete{{ filter_var($homework->id) }}" >
                                                    <i class="feather icon-delete mr-2"></i>{{ __("Delete") }}</a>
                                                </a>
                                            </div>
                                        </div>
    
                                        <!-- delete Modal start -->
                                        <div class="modal fade bd-example-modal-sm" id="delete{{ filter_var($homework->id) }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleSmallModalLabel">{{ __("Delete") }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <h4>{{ __('Are You Sure ?')}}</h4>
                                                            <p>{{ __('Do you really want to delete')}} <b>{{filter_var($homework->title)}}</b>  {{ __(' ? This process cannot be undone.')}}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="post" action="{{ route('homework.delete',['id' => $homework->id])}}" >
                                                            @csrf
                                                            {{method_field("DELETE")}}
                                                            <button type="reset" class="btn btn-secondary" data-dismiss="modal">{{ __("No") }}</button>
                                                            <button type="submit" class="btn btn-danger">{{ __("Yes") }}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- delete Model end -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            @endif

                            @php
                            $homework = Modules\Homework\Models\Homework::where('course_id',$course->id)
                                                                        ->where('user_id',Auth::User()->id)
                                                                        ->get();
                                                          
                            @endphp
                            @if(Auth::User()->role == "instructor")
                            <tbody>
                                @foreach($homework as $key => $homework)
                                <tr>
                                    
                                    <td>{{ filter_var($key+1) }}</td>
                                    <td><a href="{{route('homework.download',["id" =>$homework->id])}}"> <i class="fa fa-download"></i></a></td>
                                    <td>{{ filter_var($homework->title) }}</td>
                                    <td>{{ filter_var($homework->description) }}</td>
                                    <td><a href="{{route('homework.view',["id" =>$homework->id,"cat" => $course->id])}}"><i class="feather icon-check-circle mr-2"></i></a></td>
                                    <td>
                                        <label class="switch">
                                            <input class="status" type="checkbox" data-id="{{$homework->id}}" name="status" {{ filter_var($homework->status) == '1' ? 'checked' : '' }}>
                                            <span class="knob"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input class="compulsory" type="checkbox" data-id="{{$homework->id}}" name="compulsory" {{ filter_var($homework->compulsory) == '1' ? 'checked' : '' }}>
                                            <span class="knob"></span>
                                        </label>
                                    </td>
                                    <td>{{ filter_var($homework->endtime)}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-round btn-outline-primary" type="button" id="CustomdropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">
                                                <a class="dropdown-item" href="{{route('homework.edit',["id" =>$homework->id,"cat" => $course->id])}}"><i class="feather icon-edit mr-2"></i>{{ __("Edit") }}</a>
                                                <a class="dropdown-item" href="{{route('homework.view',["id" =>$homework->id,"cat" => $course->id])}}"><i class="feather icon-check-circle mr-2"></i>{{ __("Submit Homework") }}</a>
                                                <a class="dropdown-item btn btn-link" data-toggle="modal" data-target="#delete{{ $homework->id }}" >
                                                    <i class="feather icon-delete mr-2"></i>{{ __("Delete") }}</a>
                                                </a>
                                            </div>
                                        </div>
    
                                        <!-- delete Modal start -->
                                        <div class="modal fade bd-example-modal-sm" id="delete{{ $homework->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleSmallModalLabel">{{ __("Delete") }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <h4>{{ __('Are You Sure ?')}}</h4>
                                                            <p>{{ __('Do you really want to delete')}} <b>{{ filter_var($homework->title)}}</b>  {{ __(' ? This process cannot be undone.')}}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="post" action="{{ route('homework.delete',['id' => $homework->id])}}" >
                                                            @csrf
                                                            {{method_field("DELETE")}}
                                                            <button type="reset" class="btn btn-secondary" data-dismiss="modal">{{ __("M0") }}</button>
                                                            <button type="submit" class="btn btn-danger">{{ __("Yes") }}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- delete Model end -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            @endif
                            
                        </table>                  
                    </div>
                   
                </div>
                <!--card body end--> 
            </div>
              <!--card end--> 
        </div>
    </div>
     <!--row end--> 
</div>
 <!--contentbar end --> 
 
@endsection
<!--section end --> 
<!-- This section will contain javacsript start -->
@section('script')
    <script>var url = @json(url('/'));</script>
    <script src="{{ Module::asset('homework:js/status.js') }}"></script>
@endsection
<!-- This section will contain javacsript end -->
