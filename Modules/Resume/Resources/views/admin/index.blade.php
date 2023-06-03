@extends('admin.layouts.master')
@section('title', __('Resume - Admin'))
<!-- section start -->
@section('maincontent')
<?php
$data['heading'] = 'Resume';
$data['title'] = 'Resume';
?>
@include('admin.layouts.topbar',$data)
<!-- component end -->
<!-- Start contentbar -->
<div class="contentbar">
    <!-- Start row -->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-12">
            <!-- Start card -->
            <div class="card dashboard-card m-b-30">
                <!-- Start card header -->
                <div class="card-header">
                    <h5 class="card-title">{{ __('Resume')}}</h5>
                </div>
                <!-- end card header -->
                <!-- Start card body -->
                <div class="card-body">
                    <!-- Start table div -->
                    <div class="table-responsive">
                        <!-- Start table-->
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('Id') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Profession') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Phone no.') }}</th>
                                    <th>{{ __('Verified') }}</th>
                                    <th>{{ __('Approved') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($personals as $key => $personal)
                                <tr>
                                    <td>
                                        {{ filter_var($key+1)}}
                                    </td>
                                    <td>
                                        {{ filter_var($personal->fname)}}
                                    </td>
                                    <td>
                                        {{ filter_var($personal->profession)}}
                                    </td>
                                    <td>
                                        {{ filter_var($personal->email)}}
                                    </td>

                                    <td>
                                        {{ filter_var($personal->phone)}}
                                    </td>
                                    <!-- varified button -->
                                    <td>
                                        <label class="switch">
                                            <input class="verified" type="checkbox"
                                                data-id="{{filter_var($personal->id)}}" name="verified"
                                                {{ filter_var($personal->verified) == '1' ? 'checked' : '' }}>
                                            <span class="knob"></span>
                                        </label>
                                    </td>
                                    <!-- status button -->
                                    <td>
                                        <label class="switch">
                                            <input class="status" type="checkbox"
                                                data-id="{{filter_var($personal->id)}}" name="status"
                                                {{ filter_var($personal->status) == '1' ? 'checked' : '' }}>
                                            <span class="knob"></span>
                                        </label>
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-round btn-outline-primary" type="button"
                                                id="CustomdropdownMenuButton1" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"><i
                                                    class="feather icon-more-vertical-"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">
                                                <!-- view button -->
                                                <a class="dropdown-item"
                                                    href="{{route('resume.view',["id" => filter_var($personal->user_id)])}}"><i
                                                        class="feather icon-eye mr-2"></i>{{ __("View") }}</a>
                                                <!-- delete button -->
                                                <a class="dropdown-item btn btn-link" data-toggle="modal"
                                                    data-target="#delete_{{ filter_var($personal->id) }}">
                                                    <i class="feather icon-delete mr-2"></i>{{ __("Delete") }}</a>
                                                </a>
                                            </div>
                                        </div>
                                        <!-- delete Modal start -->
                                        <div class="modal fade bd-example-modal-sm"
                                            id="delete_{{ filter_var($personal->id)}}" tabindex="-1" role="dialog"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleSmallModalLabel">
                                                            {{ __("Delete") }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4>{{ __('Are You Sure ?')}}</h4>
                                                        <p>{{ __('Do you really want to delete ? ')}}
                                                            {{ __('This process cannot be undone.')}}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="post"
                                                            action="{{ route('resume.destroy',['id' => filter_var($personal->user_id)])}}"
                                                            class="pull-right">
                                                            {{csrf_field()}}
                                                            {{method_field("DELETE")}}
                                                            <button type="reset" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ __("No") }}</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">{{ __("Yes") }}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- delete Model ended -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- end table -->
                    </div>
                    <!-- end table div -->
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</div>
<!-- end contentbar -->
@endsection
<!--section end -->
<!-- This section will contain javacsript start -->
@section('script')
<script>
    var url = @json(route('resume.resumestatus'));
    var verify = @json(route('resume.resumeverified'));
</script>
<script src="{{ Module::asset('resume:js/status.js') }}"></script>
@endsection
<!-- This section will contain javacsript end -->