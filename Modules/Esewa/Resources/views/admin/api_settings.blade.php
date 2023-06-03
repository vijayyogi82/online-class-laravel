<!-- This will append Esewa payment content on API settings page. -->
<!-- Esewa payment settings start -->
<div class="tab-pane fade" id="v-pills-Esewa" role="tabpanel" aria-labelledby="v-pills-Esewa-tab">
  <div class="row">
    <div class="col-md-12 form-group">
      <label for="pay_enable">{{ __('Esewa Payment') }}</label> 
    </div>

    <div class="col-md-12 form-group">
      <input type="checkbox" id="esewa_sec1" class="custom_toggle" name="esewa_check"
      {{ $gsetting->esewa_enable==1 ? 'checked' : '' }} />
    </div>
      
    <div class="col-md-6">
        <label for="pay_cid">{{ __('ESEWA MERCHANT ID') }}<sup class="redstar">*</sup></label>
        <input value="{{ $env_files['ESEWA_MERCHANT_ID'] }}" autofocus name="ESEWA_MERCHANT_ID" type="text" class="form-control" placeholder="Enter MERCHANT ID"/>
    </div>

    <div class="col-md-6">
      <label for="pay_mode">{{ __('ESEVA Mode') }}<sup class="redstar">*</sup></label>
      <input value="{{ $env_files['ESEWA_MODE'] }}" autofocus name="ESEWA_MODE" type="text" class="form-control" placeholder="Enter Esewa Mode"/>
      <small class="text-info"><i class="fa fa-question-circle"></i> {{ __('For Test use') }} <b>{{ __('"SANDBOX"') }}</b> {{ __('and for Live use') }} <b>{{ __('"LIVE"') }}</b></small>
    </div>

    <div class="form-group col-md-12">
      <button type="reset" class="btn btn-danger-rgba mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
      <button type="submit" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
      {{ __("Update")}}</button>
    </div>
  </div>
  
</div>
<!-- Esewa payment settings end -->
