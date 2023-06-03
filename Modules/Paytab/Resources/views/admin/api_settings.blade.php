<!-- This will append Paytabs payment content on API settings page. -->
<!-- Paytabs payment settings start -->
<div class="tab-pane fade" id="v-pills-Paytab" role="tabpanel" aria-labelledby="v-pills-Paytab-tab">
  <div class="row">
    <div class="col-md-12 form-group">
        <label for="pay_enable">{{ __('PAYTABS PAYMENT') }}</label> 
      </div>
        
      <div class="col-md-12 form-group">
        <input type="checkbox" id="paytab_sec1" class="custom_toggle" name="ENABLE_PAYTAB"
        {{ env('ENABLE_PAYTAB') == '1' ? "checked" : "" }} />
      </div>
     
      <div class="col-md-12">
          <label>
              {{__("Paytabs Payment Settings")}}
          </label>
          <div class="form-group">
          <a target="__blank" href="https://site.paytabs.com/en/">  <i class="fa fa-key"></i>
              {{ __("Get your keys from here") }}</a>
            </div>
      </div>
      
      <div class="col-md-6">
        <div class="form-group">
              <label>{{ __("PAYTAB PROFILE ID:") }} <span class="text-red">*</span></label>
              <input name="PAYTAB_PROFILE_ID" value="{{ config('paytab.PAYTAB_PROFILE_ID') }}" type="text"
                  class="form-control" placeholder="{{ __("Enter PAYTAB PROFILE ID") }}">
          </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
              <div class="eyeCy">
                <label>{{ __("PAYTAB SERVER KEY:") }} <span class="text-red">*</span></label>
                  <input type="password" value="{{ config('paytab.PAYTAB_SERVER_KEY') }}" name="PAYTAB_SERVER_KEY" placeholder="{{ __("enter PAYTAB SERVER KEY") }}" id="PAYTAB_SERVER_KEY" type="password"
                      class="form-control">
              </div>
          </div>
      </div>
      <div class="form-group col-md-12">
        <button type="reset" class="btn btn-danger-rgba mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
        <button type="submit" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
        {{ __("Update")}}</button>
      </div>
  </div>
</div>

<!-- Paytabs payment settings end -->
