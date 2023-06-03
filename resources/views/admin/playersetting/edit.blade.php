
@extends('admin.layouts.master')
@section('title','Player Customization  - Admin')
@section('maincontent')
<?php
$data['heading'] = 'Player Customization';
$data['title'] = 'Player Customization';
$data['title1'] = 'Setting';
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
  <div class="row">
    <div class="col-lg-12">
      <div class="card dashboard-card m-b-30">
        <div class="card-header">
          <h5 class="card-title">{{ __("Player Customization")}} </h5>
        </div>
        <div class="card-body">
          
          <form action="{{ route('player.update') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
          
          <div class="row">
             <div class="form-group col-md-12">
              <label for="exampleInputDetails">{{ __('LogoEnable') }}:</label><br>
              <input  class="custom_toggle"   type="checkbox" name="logo_enable"  {{ optional($ps)->logo_enable == '1' ? 'checked' : '' }} />
               <input type="hidden" name="free" value="0" for="cb4" id="cb4"> 
                 </div>
                 <div class="form-group col-md-6">
                  <label class="text-dark" for="exampleInputSlug">{{ __('Image') }}: </label>
                  <small class="text-muted"><i class="fa fa-question-circle"></i>
                    {{ __('Recommended size') }} (104 x 36px)</small>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div>
                    <div class="custom-file">
                      <input type="file" name="logo"  class="custom-file-input" id="user_img_one" value="{{ optional($ps)['logo'] }}" id="logo" class="{{ $errors->has('logo') ? ' is-invalid' : '' }} aria-describedby="inputGroupFileAddon01" onchange="readURL(this);">
                      <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                  </div>
                  <div class="thumbnail-img-block mb-3">
                    @if(optional($ps)['logo'] !="")
              
                    <div class="logo-settings">
                      <img src="{{ url('/content/minimal_skin_dark/'.$ps['logo']) }}" alt="{{ optional($ps)['logo'] }}" id="logo" class="img-responsive image_size">
                    </div>
                  @else
                    <div class="alert alert-danger">
                      {{ __('Nologofound') }}
                    </div> 
                    @endif          
                     </div>   
                </div>
            <div class="form-group col-md-4">
              <label for="exampleInputDetails">{{ __('ShareEnable') }}:</label><br>
              <input  class="custom_toggle"   type="checkbox" name="share_enable" {{ optional($ps)['share_enable'] == '1' ? 'checked' : '' }}/>
              <input type="hidden"  name="free" value="0" for="cb3" id="cb3"> 
            </div>
            <div class="form-group col-md-4">
              <label for="exampleInputDetails">{{ __('AutoPlay') }}:</label><br>
              <input  class="custom_toggle"   type="checkbox" name="autoplay"  {{ optional($ps)['autoplay'] == '1' ? 'checked' : '' }}/>
              <input type="hidden"  name="free" value="0" for="cb6" id="cb6"> 
              <br>
              <small class="text-info"><i class="fa fa-question-circle"></i> {{ __('If autoplay is enable audio is automatically mute') }}.</small>
            </div>
            <div class="form-group col-md-4">
              <label for="exampleInputDetails">{{ __("Video Downlaod Enable:")}}</label><br>
              <input  class="custom_toggle"   type="checkbox" name="download" {{ optional($ps)['download'] == '1' ? 'checked' : '' }}/>
              <input type="hidden"  name="free" value="0" for="cb7" id="cb7"> 
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-6">
              <div class="form-group">
                  <label class="text-dark" >{{ __('Subtitle Font Size') }} : </label>
                  <input min="1" name="subtitle_font_size" class="form-control" type="number" value="{{ optional($ps)['subtitle_font_size'] }}"/>
              </div>
            </div>

            <div class="form-group col-md-6">
            
              <div class="form-group">
                <label class="text-dark" for="subtitle_color">{{ __('Subtitle Color') }}:</label>
                <input name="subtitle_color" class="form-control" type="color" value="{{ optional($ps)['subtitle_color'] }}"/>
                
              </div>

            </div>
          </div>
         
          <div class="form-group">
            <button type="reset" class="btn btn-danger-rgba mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
            <button type="submit" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
            {{ __("Update")}}</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
                      
                       
              
            

@endsection


@section('script')
  <script>
    $(function() {
        $('#logo_chk').change(function() {
          $('#status').val(+ $(this).prop('checked'))
          var st = $('#status').val();
          if(st==1)
          {
            $('#logo_upl').show();
            $('#logo_pre').show();
          }
          else
          {
            $('#logo_upl').hide();
            $('#logo_pre').hide();
          }
        })
      })

      $(function() {
        $('#share_chk').change(function() {
          $('#share_opt').val(+ $(this).prop('checked'))
        })
      })
</script>
@endsection