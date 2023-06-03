@extends('admin.layouts.master')
 <!--section start--> 
@section('title',__('Submit Homework - Admin'))
@section('maincontent')
<?php
$data['heading'] = 'Submit Homework';
$data['title'] = 'Homework';
$data['title1'] = 'Submit Homework';
?>
@include('admin.layouts.topbar',$data)
 <!--contenbar start--> 
<div class="contentbar">
     <!--row start--> 
    <div class="row">
        <div class="col-lg-12">
            <!--card start--> 
            <div class="card dashboard-card m-b-30">
                <!--card header start --> 
                <div class="card-header">
                    <h5 class="card-box">{{ __('Submit Homework') }} <span class="text-muted">({{ filter_var($course->title) }})</span></h5>
                    <div>
                        <div class="widgetbar">
                          <a href="{{ route('homework.index',["id" => $course->id])}}" class="btn btn-primary-rgba mr-2"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
                         </div>
                      </div>
                </div> 
                  <!--card header end  --> 

                <!--card body start --> 
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                                <th>{{ __('Id') }}</th>
                                <th>{{ __('Student Name') }}</th>
                                <th>{{ __('Detail') }}</th>
                                <th>{{ __('Download') }}</th>
                                <th>{{ __('Remark') }}</th>
                                <th>{{ __('Marks') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Action') }}</th>
                            </thead>
                            <tbody>
                                @foreach($subhomework as $key => $subhomework)
                                <tr>
                                    
                                    <td>{{ filter_var($key+1) }}</td>
                                    @php
                                        $studentname = App\User::where('id',$subhomework->user_id)->value('fname');
                                    @endphp
                                    <td>{{ filter_var($studentname) }}</td>
                                    <td>{{ filter_var($subhomework->detail) }}</td>
                                    <td>  <a  href="{{route('submithomework.download',["id" =>$subhomework->id])}}" > <i class="fa fa-download"></i></a></td>
                                    <td>{{ filter_var($subhomework->remark) }}</td>
                                    <td>{{ filter_var($subhomework->marks) }}</td>
                                    <td>{{ filter_var($subhomework->created_at) }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-round btn-outline-primary" type="button" id="CustomdropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">
                                               
                                                <a class="dropdown-item btn btn-link" data-toggle="modal" data-target="#edit{{ filter_var($subhomework->id) }}" >
                                                    <i class="feather icon-edit mr-2"></i>{{ __("Edit") }}</a>
                                                </a>
                                            </div>
                                        </div>
                                        <!-- delete Modal start -->
                                        <div class="modal fade bd-example-modal-lg" id="edit{{ filter_var($subhomework->id) }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleSmallModalLabel">{{ __("Give Marks and Remark") }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" enctype="multipart/form-data" action="{{ route('marks.update',["id" => $subhomework->id])}}" >
                                                        @csrf
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <label>{{ __("Marks")}}<sup class="redstar">*</sup><span class="text-muted"></span></label>
                                                                    <input  class="form-control" name="marks" value="{{ filter_var($subhomework->marks) }}" placeholder="Please Enter Marks">
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label>{{ __("Remark")}}<sup class="redstar">*</sup></label>
                                                                    <textarea name="remark" rows="3" class="col-md-12 form-control" placeholder="Please Enter Remark">{{ filter_var($subhomework->remark) }}</textarea>
                                                                
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="modal-footer">
                                                                <button type="reset" class="btn btn-danger mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
                                                                <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>
                                                                {{ __("Update")}}</button>
                                                            </div>
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
                        </table>                  
                    </div>
                </div>
                  <!--card body end --> 
            </div>
        </div>
    </div>
    <!--row end--> 
</div>
 <!--contenbar end--> 
@endsection
 <!--section end-->
 