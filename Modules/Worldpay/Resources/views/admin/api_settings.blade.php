<!-- This will append SQUAREPAY payment content on API settings page. -->
<!-- SQUAREPAY payment settings start -->
<div class="tab-pane fade" id="v-pills-Worldpay" role="tabpanel" aria-labelledby="v-pills-Worldpay-tab">
  <div class="row">
    <div class="col-md-12 form-group">
        <label for="pay_enable">{{ __('Worldpay Payment') }}</label> 
    </div>

    <div class="col-md-12 form-group">
      <input type="checkbox" id="worldpay_sec1" class="custom_toggle" name="WORLDPAY_ENABLE" {{ env('WORLDPAY_ENABLE') == '1' ? "checked" : "" }} />
    </div>
      
    <div class="form-group col-md-12">
      <a target="__blank" href="https://www.fisglobal.com/en/merchant-solutions-worldpay" class="">
        <i class="fa fa-key"></i>
        {{ __("Get your keys from here") }}
      </a>
    </div>
      
    <div class="form-group col-md-6">
        <label>{{ __("WORLDPAY CLIENT KEY:") }} <span class="text-red">*</span></label>
        <input name="WORLDPAY_CLIENT_KEY" value="{{ config('worldpay.WORLDPAY_CLIENT_KEY') }}" type="text" class="form-control" placeholder="{{ __("Enter worldpay client id") }}">
    </div>
    
    <div class="form-group col-md-6">
      
        <div class="eyeCy">

            <label>{{ __("WORLDPAY SECRET KEY:") }} <span class="text-red">*</span></label>
            <input type="password" value="{{ config('worldpay.WORLDPAY_SECRET_KEY') }}" name="WORLDPAY_SECRET_KEY" placeholder="{{ __("enter worldpay secret key") }}" id="WORLDPAY_SECRET_KEY" type="password"  class="form-control payment-setting-input">
            <span toggle="#WORLDPAY_SECRET_KEY" class="fa fa-fw fa-eye field-icon toggle-password"></span>

        </div>
    </div>

    <div class="form-group col-md-12">
      <button type="reset" class="btn btn-danger-rgba mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
      <button type="submit" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
      {{ __("Update")}}</button>
    </div>

  </div>
</div>
<!-- SQUAREPAY payment settings end -->