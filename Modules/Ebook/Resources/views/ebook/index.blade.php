@extends('admin.layouts.master')
@section('title', 'Ebook - Admin')
@section('maincontent')
<?php
$data['heading'] = 'Ebook';
$data['title'] = 'Ebook';
?>
@include('admin.layouts.topbar',$data)
<div class="contentbar">   
  @if ($errors->any())  
  <div class="alert alert-danger" role="alert">
    @foreach($errors->all() as $error)     
      <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true" style="color:red;">&times;</span></button></p>
    @endforeach  
  </div>
  @endif  
  <div class="card dashboard-card m-b-30">
    <div class="card-header">
      <h5 class="box-tittle">{{ __('Ebook Adding Form') }}</h5>
      <div>
        <div class="widgetbar">
            <a href="{{ route('ebook.create') }}" class="btn btn-primary-rgba mr-2"><i class="feather icon-plus mr-2"></i>{{ __("Add new ebook")}}</a>
            <a href="{{ url('web/ebook') }}" target="_blank" class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>{{ __("E-book Web")}}</a>
          </div>
      </div>
    </div>
    <div class="ebook-index-main-block">
      <div class="row">
      @foreach($ebook as $item)
        <div class="col-lg-4 mb-4">
          <div class="card partial-course-img">
            <img class="card-img-top" src="{{ url('images/ebook/'.$item->thumbnali) }}" alt="User Avatar">
            <div class="overlay-bg"></div>
            <div class="card-img-block">
              <h4 class="mt-3 card-title" style="color:white;">{{$item->title}}</h4>
              <p class="card-sub-title" style="color:white;"> {{$item->category_id?$item->category->title:''}} </p>
            </div>
            <div class="card-user-img">
              <img src="{{ url('images/user_img/'.$item->user->user_img) }}" alt="" class="img-fluid">           
            </div>
            <div class="card-body">
              <ul class="partial-course-status">
                <li style="list-style-type: none;" class="mt-4">
                  <a href="#" style="color:black">Type 
                  @if($item->free=='Yes')
                    <span class="button-align">Free</span>
                  @else
                    <span class="button-align">Paid</span>
                  @endif
                  </a>
                </li>
                <li style="list-style-type: none;" class="mt-4">
                  <a href="#" style="color:black">Publication Name
                    <span class="button-align">
                    {{$item->publication}}
                    </span>
                  </a>
                </li>
                <li style="list-style-type: none;" class="mt-3">
                  <a href="#" style="color:black">Status
                    <span class="button-align">
                      @if($item->status=='1')
                      <span class="badge badge-success">Active</span>
                      @else
                      <span class="badge badge-danger">Deactive</span>
                      @endif
                    </span>
                  </a>
                </li>
              </ul>
            </div>
            <div class="card-footer">
              <div class="row mt-3 mb-3">
                <div class="col-4 text-center">
                  <a href="{{url('ebook/edit/'.$item->id)}}">
                    <i title="Edit" class="feather icon-edit"></i>
                  </a>
                </div>
                <div class="col-4 text-center">
                  <a href="" data-toggle="modal" data-target="#delete{{$item->id}}">
                    <i title="Delete" class="text-primary feather icon-trash"></i>
                  </a>
                </div>
                <div class="col-4 text-center">
                  <a href="{{url('web/ebook/detail/'.$item->id)}}" target="_blank" title="Show">
                    <i class="feather icon-eye"></i>
                  </a>
                </div>
                <!-- delete Modal start -->
                <div class="modal fade bd-example-modal-sm" id="delete{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleSmallModalLabel">Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                    <h4>{{ __('Are You Sure ?')}}</h4>
                                    <p>{{ __('Do you really want to delete')}} <b>{{ $item->title }}</b> ? {{ __('This process cannot be undone.')}}</p>
                            </div>
                            <div class="modal-footer">
                                <form method="post" action="{{url('ebook/delete/'.$item->id)}}" class="pull-right">
                                    {{ csrf_field() }}
                                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">{{__('No')}}</button>
                                    <button type="submit" class="btn btn-primary">{{__('Yes')}}</button>
                                </form>
                            </div>
                        </div>
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
</div>
<!-- Code -->
@endsection