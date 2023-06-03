@extends('admin.layouts.master')
@section('title', 'Review - Admin')
@section('maincontent')
<?php
$data['heading'] = 'Review';
$data['title'] = 'Review';
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
    <!-- Start row -->
    <div class="row">
    
        <div class="col-lg-12">
            <div class="card dashboard-card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">{{ __('Ebook Review')}}</h5>
                </div>
                <div class="card-body">                 
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('User') }}</th>
                                    <th>{{ __('Ebook') }}</th>
                                    <th>{{ __('Rating') }}</th>
                                    <th>{{ __('Commnet') }}</th>
                                    <th>{{ __('Action') }}</th>                           
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($reviews as $item)
                                <tr>
                                    <td>{{$item->user->fname ?? ''}} {{$item->user->lname ?? ''}}</td>
                                    <td>{{$item->ebook_id?$item->ebook->title:''}}</td>
                                    <td>{{$item->rating}}</td>
                                    <td>{{$item->comment}}</td>    
                                    <td>
                                    <a href="#" data-toggle="modal" data-target="#bulk_delete{{$item->id}}"><i title="Delete" class="text-primary feather icon-trash mr-2"></i></a>
                                    </td>
                                </tr>

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
                                        <form id="bulk_delete_form" method="Post" action="{{url('ebook-review/delete',$item->id)}}">   
                                        {{ csrf_field() }}                 
                                            <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                                            <button type="submit" class="btn btn-danger">Yes</button>
                                        </form>
                                        </div>
                                    </div> 
                                    </div>
                                </div>
                            @endforeach                             
                            </tbody>
                         </table>
                  </div>
              </div>
          </div>
      </div>
      <!-- End col -->
  </div>
  <!-- End row -->
</div>        
@endsection

                                      
                                    
                                     
                                      
                                    
                                   
                              
                               
                                
    
              
                               
                              
                
                               
                              
