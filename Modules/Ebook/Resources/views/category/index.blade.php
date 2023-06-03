@extends('admin.layouts.master')
@section('title', 'Ebook Category - Admin')
@section('maincontent')
<?php
$data['heading'] = 'Ebook Category';
$data['title'] = 'Ebook Category';
?>
@include('admin.layouts.topbar',$data)
<style>
    .ebook-category{
        height: 100px;
        width: 100px;
    }
</style>
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
          <a href="{{ route('ebook-category.create') }}" type="button" data-toggle="modal" data-target="#categoryModal" class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>{{ __("Add new category")}}</a>   
          <!-- Modal -->
          <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ebook Category</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body p-4">
                <form action="{{route('ebook-category.store')}}" class="form" method="POST" novalidate enctype="multipart/form-data">
                  @csrf
                    <div class="form-group text-left">
                      <label for="exampleInputTitle">Title</label>
                      <input type="type" class="form-control" id="exampleInputTitle" name="title" aria-describedby="titleHelp" placeholder="Enter Title">
                    </div>
                    <div class="form-group text-left">
                      <label for="exampleInputThumbnail">Thumbnail</label>
                      <div class="input-group mb-3 text-left">
                        
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="image" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                      </div>
                    </div>
                    <div class="category-modal-btn text-left">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <div class="ebook-category-block">
        <div class="row">
          @if(isset($category))
          @foreach($category as $key => $item)
          <div class="col-lg-3 col-md-6">
            <div class="card partial-course-img">
              <img class="img-fluid card-img-top" src="{{ url('images/ebook_category/'.$item->image) }}" alt="">
              <div class="overlay-bg"></div>
              <div class="card-img-block">
                <h2 class="mt-3 card-title" style="color:white;">{{$item->title}}</h2>
              </div>
              <div class="ebook-cat-badge">
                <span class="badge badge-primary">{{count($item->ebooks)}}</span>
              </div>
              <div class="ebook-cat-dropdown">
                <div class="dropdown">
                  <button class="btn btn-round btn-primary" type="button" id="CustomdropdownMenuButton5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                  <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton5">
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#categoryModalEdit{{$item->id}}"><i title="Edit" class="text-primary feather icon-edit mr-2"></i>Edit</a>
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#bulk_delete{{$item->id}}"><i title="Delete" class="text-primary feather icon-trash mr-2"></i>Delete</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          
          <div id="bulk_delete{{$item->id}}" class="delete-modal modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                  <div class="delete-icon"></div>
                </div>
                <div class="modal-body text-center">
                  <h4 class="modal-heading">Are You Sure ?</h4>
                  <p>Do you really want to delete selected item ? This process
                    cannot be undone.</p>
                </div>
                <div class="modal-footer">
                  <form id="bulk_delete_form" method="Post" action="{{url('ebook-category/delete',$item->id)}}">   
                  {{ csrf_field() }}                 
                    <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Yes</button>
                  </form>
                </div>
              </div> 
            </div>
          </div>

          <div class="modal fade" id="categoryModalEdit{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="categoryModalEdit{{$item->id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="categoryModalEdit{{$item->id}}">Edit {{$item->title}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body p-4">
                <form action="{{route('ebook-category.update')}}" class="form" method="POST" novalidate enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" value="{{$item->id}}">
                    <div class="form-group text-left">
                      <label for="exampleInputTitle">Title</label>
                      <input type="type" class="form-control" id="exampleInputTitle" name="title" aria-describedby="titleHelp" value="{{$item->title}}" placeholder="Enter Title">
                    </div>
                    <div class="form-group text-left">
                      <label for="exampleInputThumbnail">Thumbnail</label>
                      <div class="input-group mb-3 text-left">
                        
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="image" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group text-left">
                      <img class="ebook-category" src="{{ url('images/ebook_category/'.$item->image) }}" alt="">
                    </div>
                    <div class="category-modal-btn text-left">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          @endif
        </div>
      </div>
</div>
</div>
<!-- Code -->
 @endsection