@extends('admin.layouts.master')
@section('title','All User')
@section('maincontent')
<?php
$data['heading'] = 'All User';
$data['title'] = 'All User';
?>
@include('admin.layouts.topbar',$data)
<div class="contentbar">
    <div class="row">
        <div class="col-lg-12">
            <div class="card dashboard-card m-b-30">
                <div class="card-header all-user-card-header">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="false">{{ __('Users') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">{{ __('Students') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="true">{{ __('Instructors') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-admin-tab" data-toggle="pill" href="#pills-admin" role="tab" aria-controls="pills-admin" aria-selected="true">{{ __('Admins') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="mt-4">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="all-user-menu">
                                <div class="row">
                                    <div class="col-lg-4 col-md-12 col-12">
                                        <h5 class="box-title"> {{ __('All Users') }}</h5>
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-12 text-right menus-button">
                                            @can('users.create')
                                        <a href="{{route('user.add')}}" class="btn btn-primary-rgba mr-2"><i
                                                class="feather icon-plus mr-2"></i>{{ __('Add User') }} </a>
                                                @endcan
                                                @can('users.delete')
                                        <button type="button" class="btn btn-danger-rgba mr-2 " data-toggle="modal"
                                            data-target="#bulk_delete"><i class="feather icon-trash mr-2"></i> {{ __('Delete Selected') }} </button>
                                            @endcan
                                                <a href="{{ route('user.import') }}" class="btn btn-success-rgba"><i class="feather icon-plus mr-2"></i>{{ __("Import")}}</a>
                                    </div>
                                </div>
                            </div>
                            <div style="display:none" id="msg" class="alert alert-success">
                                <span id="res_message"></span>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="userstabl" class="table table-bordered data-table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]"
                                                        value="all" />
                                                    <label for="checkboxAll" class="material-checkbox"></label> #
                                                </th>
                                                <th>#</th>
                                                <th>{{ __('Profile Picture') }}</th>
                                                <th>{{ __('Users Details') }}</th>
                                                <th>{{ __('Role') }}</th>
                                                <th>{{ __('Login as User') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                         <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
                                            <div class="modal-dialog modal-sm">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                        <div class="delete-icon"></div>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <h4 class="modal-heading">{{__('Are You Sure ?')}}</h4>
                                                        <p>{{__('Do you really want to delete selected item names here? This
                                                            process
                                                            cannot be undone.')}}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form id="bulk_delete_form" method="post"
                                                            action="{{ route('user.bulk_delete') }}">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="reset" class="btn btn-gray translate-y-3"
                                                                data-dismiss="modal">{{__('No')}}</button>
                                                            <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="all-user-menu">
                                <div class="row">

                                    <div class="col-lg-4 col-md-12">
                                        <h5 class="box-title">{{ __('All Students') }}</h5>
                                    </div>
                                    
                                    <div class="col-lg-8 col-md-12 text-right menus-button">
                                        @can('Alluser.delete')
                                        <button type="button" class="btn btn-danger-rgba mr-2 " data-toggle="modal"
                                            data-target="#bulk_delete"><i class="feather icon-trash mr-2"></i> {{ __('Delete Selected') }}</button>
                                            @endcan
                                            @can('Alluser.delete')
                                            <a href="{{route('alluser.add')}}" class="btn btn-primary-rgba mr-2"><i
                                                class="feather icon-plus mr-2"></i>{{ __('Add Student') }}</a>
                                                @endcan
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
            
                                <div class="table-responsive">
                                    <table id="allusertable" class="table table-striped table-bordered" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]"
                                                        value="all" />
                                                    <label for="checkboxAll" class="material-checkbox"></label> 
                                                </th>
                                                <th>#</th>
                                                <th>{{ __('Profile Picture') }}</th>
                                                <th>{{ __('User Detail') }}</th>
                                                <th>{{ __('Login As User') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
                                            <div class="modal-dialog modal-sm">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                        <div class="delete-icon"></div>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <h4 class="modal-heading">{{ __('Are You Sure') }} ?</h4>
                                                        <p>{{ __('Do you really want to delete selected item names here? This process
                                                                    cannot be undone') }}.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form id="bulk_delete_form" method="post"
                                                            action="{{ route('user.bulk_delete') }}">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="reset" class="btn btn-gray translate-y-3"
                                                                data-dismiss="modal">{{ __('No') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">{{ __('Yes') }}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="all-user-menu">
                                <div class="row">
                                    <div class="col-lg-4 col-md-12">
                                        <h5 class="box-title">{{ __('All Instructors') }}</h5>
                                    </div>
                                    <div class="col-lg-8 col-md-12 text-right menus-button">
                                        @can('Allinstructor.delete')
                                        <button type="button" class="btn btn-danger-rgba mr-2 " data-toggle="modal"
                                        data-target="#bulk_delete"><i class="feather icon-trash mr-2"></i> {{ __('Delete Selected') }}</button>
                                        @endcan
                                        @can('Allinstructor.create')
                                        <a href="{{route('allinstructor.add')}}" class="btn btn-primary-rgba mr-2"><i
                                            class="feather icon-plus mr-2"></i>{{ __('Add Instructor') }}</a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="allinstructor" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>
                                                    <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]"
                                                        value="all" />
                                                    <label for="checkboxAll" class="material-checkbox"></label> 
                                                </th>
                                                <th>{{ __('Profile Picture') }}</th>
                                                <th>{{ __('Instructor Detail') }}</th>
                                                <th>{{ __('Login As User') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
                                            <div class="modal-dialog modal-sm">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                        <div class="delete-icon"></div>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <h4 class="modal-heading">{{ __('Are You Sure') }} ?</h4>
                                                        <p>{{ __('Do you really want to delete selected item names here? This process
                                                                    cannot be undone') }}.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form id="bulk_delete_form" method="post"
                                                            action="{{ route('user.bulk_delete') }}">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="reset" class="btn btn-gray translate-y-3"
                                                                data-dismiss="modal">{{ __('No') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">{{ __('Yes') }}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-admin" role="tabpanel" aria-labelledby="pills-admin-tab">
                            <div class="all-user-menu">
                                <div class="row">

                                    <div class="col-lg-4 col-md-12">
                                        <h5 class="box-title">{{ __('All Admins') }}</h5>
                                    </div>
                                    <div class="col-lg-8 col-md-12 text-right menus-button">
                                                <a href="{{route('alladmin.add')}}" class="btn btn-primary-rgba mr-2"><i
                                                    class="feather icon-plus mr-2"></i>{{ __('Add Admin') }}</a> 
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="alladmin" class="table table-striped table-bordered" style="width: 100%";>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('Profile Picture') }}</th>
                                                <th>{{ __('Admin Detail') }}</th>
                                                <th>{{ __('Login As User') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



             
           
        <!-- End col -->
    </div>
    <!-- End row -->
</div>

@endsection
@section('script')


<!-- script for datatable end -->
<script type="text/javascript">
    $(function () {
      
      var table = $('#userstabl').DataTable({
          processing: true,
          serverSide: true,
          searchDelay : 1000,
          stateSave : true,
          ajax: "{{ route('user.index') }}",
          columns: [
              {data: 'checkbox', name: 'checkbox'},
              {data: 'DT_RowIndex', name: 'users.id'},
              {data: 'image', name: 'image' , orderable: false, searchable: false},
              {data: 'name',name: 'users.fname'},
              {data: 'role', name: 'roles.name'},
              {data: 'loginasuser', name: 'loginasuser' , orderable: false, searchable: false},
              {data: 'status', name: 'status', orderable: false, searchable: false},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
</script>

<script>

    $(document).on("change", ".user", function () {

        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'user/status',
            data: {
                'status': $(this).is(':checked') ? 1 : 0,
                'id': $(this).data('id')
            },
            success: function(data){
                var warning = new PNotify( {
                title: 'success', text:'Status Update Successfully', type: 'success', desktop: {
                desktop: true, icon: 'feather icon-thumbs-down'
                }
            });
                warning.get().click(function() {
                    warning.remove();
                });
            }
        });
    });

    $("#checkboxAll").on('click', function () {
        $('input.check').not(this).prop('checked', this.checked);
    });
</script>
<script type="text/javascript">
    $(function () {
      
      var table = $('#allusertable').DataTable({
          processing: true,
          serverSide: true,
          searchDelay : 1000,
          stateSave : true,
          ajax: "{{ route('allusers.index') }}",
          columns: [
              {data: 'checkbox', name: 'checkbox'},
              {data: 'DT_RowIndex', name: 'users.id'},
              {data: 'image', name: 'image', orderable: false, searchable: false},
              {data: 'name', name: 'users.fname'},
              {data: 'loginasuser', name: 'loginasuser' , orderable: false, searchable: false},
              {data: 'status', name: 'status', orderable: false, searchable: false},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
</script>
<!-- script for datatable start -->
<script>
    $(document).on("change", ".user", function () {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'user/status',
            data: {
                'status': $(this).is(':checked') ? 1 : 0,
                'id': $(this).data('id')
            },
            success: function(data){
                var warning = new PNotify( {
                title: 'success', text:'Status Update Successfully', type: 'primary', desktop: {
                desktop: true, icon: 'feather icon-thumbs-down'
                }
            });
                warning.get().click(function() {
                    warning.remove();
                });
            }
        });
    })
</script>
<script>
    $("#checkboxAll").on('click', function () {
        $('input.check').not(this).prop('checked', this.checked);
    });
</script>
<script type="text/javascript">
    $(function () {
      
      var table = $('#allinstructor').DataTable({
          processing: true,
          serverSide: true,
          responsive:true,
          searchDelay : 1000,
          stateSave : true,
          ajax: '{{ route('allinstructor.index') }}',
          columns: [
              {data: 'DT_RowIndex', name: 'users.id'},
              {data: 'checkbox', name: 'checkbox' , orderable: false ,searchable: false},
              {data: 'image', name: 'image', orderable: false ,searchable: false},
              {data: 'name' ,name: 'users.fname'},
              {data: 'loginasuser', name: 'loginasuser' , orderable: false, searchable: false},
              {data: 'status', name: 'status', orderable: false ,searchable: false},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
</script>
<script>
    $(document).on("change", ".user", function () {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'user/status',
            data: {
                'status': $(this).is(':checked') ? 1 : 0,
                'id': $(this).data('id')
            },
            success: function(data){
            var warning = new PNotify( {
                title: 'success', text:'Status Update Successfully', type: 'success', desktop: {
                desktop: true, icon: 'feather icon-thumbs-down'
                }
              });
              warning.get().click(function() {
                warning.remove();
              });
          }
        });
    })
</script>
<script>
    $("#checkboxAll").on('click', function () {
        $('input.check').not(this).prop('checked', this.checked);
    });
</script>
<script type="text/javascript">
    $(function () {
      
      var table = $('#alladmin').DataTable({
          processing: true,
          serverSide: true,
          responsive:true,
          searchDelay : 1000,
          stateSave : true,
          ajax: '{{ route('alladmin.index') }}',
          columns: [
              {data: 'DT_RowIndex', name: 'users.id'},
              {data: 'image', name: 'image', orderable: false ,searchable: false},
              {data: 'name' ,name: 'users.fname'},
              {data: 'loginasuser', name: 'loginasuser' , orderable: false, searchable: false},
              {data: 'status', name: 'status', orderable: false ,searchable: false},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
</script>
<script>
    $(document).on("change", ".user", function () {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'user/status',
            data: {
                'status': $(this).is(':checked') ? 1 : 0,
                'id': $(this).data('id')
            },
            success: function(data){
            var warning = new PNotify( {
                title: 'success', text:'Status Update Successfully', type: 'success', desktop: {
                desktop: true, icon: 'feather icon-thumbs-down'
                }
              });
              warning.get().click(function() {
                warning.remove();
              });
          }
        });
    })
</script>
<script>
    $("#checkboxAll").on('click', function () {
        $('input.check').not(this).prop('checked', this.checked);
    });
</script>
@endsection