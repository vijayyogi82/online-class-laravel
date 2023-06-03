@extends('admin.layouts.master')
@section('title', 'Ebook Create - Admin')
<?php
$data['heading'] = 'Ebook Create';
$data['title'] = 'Ebook Create';
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
  <div class="ebook-create-block">
    <div class="card m-b-30">
      <div class="card-header">
        <h5 class="box-tittle">Ebook Adding Form</h5>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-5 col-xl-3">
        <div class="card m-b-30">
          <div class="card-header">
            <h5 class="box-tittle">Ebook Form</h5>
          </div>
          <div class="card-body">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link mb-2 show active" data-toggle="pill" href="#v-pills-basic" role="tab" aria-selected="true"><i class="feather icon-anchor mr-2"></i>Basic</a>
              <a class="nav-link mb-2" id="v-pills-pricing-tab" data-toggle="pill" href="#v-pills-pricing" role="tab" aria-controls="v-pills-pricing" aria-selected="false"><i class="feather icon-feather mr-2"></i>Pricing</a>
              <a class="nav-link mb-2" id="v-pills-ebook-file-tab" data-toggle="pill" href="#v-pills-ebook-file" role="tab" aria-controls="v-pills-ebook-file" aria-selected="false"><i class="feather icon-file-text mr-2"></i>Ebook files</a>
              <a class="nav-link mb-2" id="v-pills-finish-tab" data-toggle="pill" href="#v-pills-finish" role="tab" aria-controls="v-pills-finish" aria-selected="false"><i class="feather icon-check-square mr-2"></i>Finish</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-7 col-xl-9">
        <div class="tab-content" id="v-pills-tabContent">
          <div class="tab-pane fade active show" id="v-pills-basic" role="tabpanel">
            <div class="row">
              <div class="col-lg-12">
                <div class="card dashboard-card m-b-30">
                  <div class="card-header">
                    <h5 class="card-box">{{ __('Add a new ebook') }}</h5>
                    <div>
                      <div class="widgetbar">
                          <a href="{{ route('ebook') }}" class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
                        </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <form>
                      <div class="row">
                        <div class="col-lg-6 col-md-6 mb-2">
                          <div class="form-group">
                            <label for="exampleInputTitle">Title <sup class="redstar">*</sup></label>
                            <input type="type" class="form-control" id="exampleInputTitle" aria-describedby="TitleHelp" placeholder="Enter Title">
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-2">
                          <div class="form-group">
                            <label for="exampleFormControlCategory">Category <sup class="redstar">*</sup></label>
                            <select class="form-control" id="exampleFormControlCategory">
                              <option>Education</option>
                              <option>Kids</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-4">
                          <div class="form-group">
                            <label for="exampleInputTit1e">{{ __('Detail') }}: <sup class="redstar">*</sup></label>
                            <textarea id="detail" name="detail" rows="2" class="form-control">{{ (old('detail')) }}</textarea>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-2">
                          <div class="form-group">
                            <label for="exampleInputName">Publication Name <sup class="redstar">*</sup></label>
                            <input type="type" class="form-control" id="exampleInputName" aria-describedby="NameHelp" placeholder="Enter Publication Name">
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-2">
                          <div class="form-group">
                            <label for="exampleInputEdition">Edition <sup class="redstar">*</sup></label>
                            <input type="type" class="form-control" id="exampleInputEdition" aria-describedby="EditionHelp" placeholder="Enter Edition">
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-2">
                          <div class="form-group">
                            <label for="exampleInputBanner">Ebook Banner</label>
                              <div class="input-group mb-3 text-left">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroupFilebanner01">Upload</span>
                                </div>
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="inputGroupFile01" name="contact_image" aria-describedby="inputGroupFilebanner01">
                                  <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                              </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-2">
                          <div class="form-group">
                            <label for="exampleInputThumbnail">Ebook Thumbnail</label>
                              <div class="input-group mb-3 text-left">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroupFileThumbnail01">Upload</span>
                                </div>
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="inputGroupFile02" name="contact_image" aria-describedby="inputGroupFileThumbnail01">
                                  <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="v-pills-pricing" role="tabpanel" aria-labelledby="v-pills-pricing-tab">
            <div class="row">
              <div class="col-lg-12">
                <div class="card m-b-30">
                  <div class="card-header">
                    <h5 class="card-box">Pricing</h5>
                  </div>
                  <div class="card-body">
                    <form>
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="row">
                            <div class="col-lg-4">
                              <label class="paid-title" for="exampleInputDetails">{{ __('Paid') }}:</label>
                            </div>
                            <div class="col-lg-8 text-right">
                              <div>
                                <input type="checkbox" class="custom_toggle" id="paid1" name="type" />
                                <label class="tgl-btn" data-tg-off="{{ __('Free') }}" data-tg-on="{{ __('Paid') }}" for="paid1"></label>
                              </div>
                              <small class="text-info"><i class="fa fa-question-circle"></i> If enabled duration can be in months,</small>
                            </div>
                          </div>
                          <br>
                          <div style="display: none;" id="pricebox1">
                            <div class="row">
                              <div class="col-lg-6">
                                <label for="exampleInputSlug">{{ __('Price') }}: <sup class="redstar">*</sup></label>
                                <input type="number" step="0.01" class="form-control" name="price" id="priceMain" placeholder="{{ __('Enter') }} {{ __('Price') }}" value="{{ (old('price')) }}">
                              </div>
                              <div class="col-lg-6">
                                <label for="exampleInputSlug">{{ __('Discount Price') }}: </label>
                                <input type="number" step="0.01" class="form-control" name="discount_price" id="offerPrice" placeholder="{{ __('Enter') }} {{ __('Discount Price') }}" value="{{ (old('discount_price')) }}">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="v-pills-ebook-file" role="tabpanel" aria-labelledby="v-pills-ebook-file-tab">
            <div class="row">
              <div class="col-lg-12">
                <div class="card m-b-30">
                  <div class="card-header">
                    <h5 class="card-box">Ebook Files</h5>
                  </div>
                  <div class="card-body">
                    <form>
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="exampleInputPreview">Ebook Preview file</label>
                              <div class="input-group mb-3 text-left">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroupFilePreview01">Upload</span>
                                </div>
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="inputGroupFile03" name="contact_image" aria-describedby="inputGroupFilePreview01">
                                  <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                                </div>
                              </div>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="exampleInputComplete">Ebook Complete file</label>
                              <div class="input-group mb-3 text-left">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroupFileComplete01">Upload</span>
                                </div>
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="inputGroupFile04" name="contact_image" aria-describedby="inputGroupFileComplete01">
                                  <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="v-pills-finish" role="tabpanel" aria-labelledby="v-pills-finish-tab">
            <div class="row">
              <div class="col-lg-12">
                <div class="card m-b-30">
                  <div class="card-header">
                    <h5 class="card-box">Finish</h5>
                  </div>
                  <div class="card-body text-center">
                    <img src="{{ url('admin_assets/images/finish.png') }}" class="img-fluid mb-3" alt="">
                    <h2 class="finish-heading">Thank You !</h2>
                    <p class="mb-4">You are just one click away</p>
                    <a href="" type="submit" class="btn btn-primary" title="submit">Submit</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



    <!-- Code -->



@endsection
@section('scripts') 
  <script>
    $('#paid1').on('change', function() {

      if ($('#paid1').is(':checked')) {
        $('#pricebox1').show('fast');

        $('#priceMain').prop('required', 'required');

      } else {
        $('#pricebox1').hide('fast');

        $('#priceMain').removeAttr('required');
      }

    });
  </script>
@endsection