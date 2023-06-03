<!-- This will append Paytabs payment content on API settings page. -->
<!-- Paytabs payment settings start -->
<div class="tab-pane fade" id="v-pills-DPOPayment" role="tabpanel" aria-labelledby="v-pills-DPOPayment-tab">
    <div class="row">
        <div class="col-md-12 form-group">
            <label for="pay_enable">{{ __('DPOPAYMENT PAYMENT') }}</label> 
        </div>
       
       <div class="col-md-12 form-group">
            <input type="checkbox" id="dpopay_sec1" class="custom_toggle" name="ENABLE_DPOPAYMENT"
            {{ env('ENABLE_DPOPAYMENT') == '1' ? "checked" : "" }} />
       </div>
      
       <div class="form-group col-md-6">
           <div class="eyeCy">

               <label for="COMPANY_TOKEN">{{ __("COMPANY TOKEN:") }}</label>
               <input type="password" value="{{ env('COMPANY_TOKEN') }}" name="COMPANY_TOKEN"
                   placeholder="{{ __("enter your company token") }}" id="COMPANY_TOKEN" type="password"
                   class="form-control payment-setting-input">
               <span toggle="#COMPANY_TOKEN" class="fa fa-fw fa-eye field-icon toggle-password"></span>

           </div>
       </div>
        
       <div class="form-group col-md-6">
           <label>{{ __("SERVICE TYPE:") }}</label>
           <input name="SERVICE_TYPE" value="{{ env('SERVICE_TYPE') }}" type="text"
               class="form-control" placeholder="{{ __("Enter SERVICE TYPE") }}">
       </div>
       <div class="form-group col-md-12">
           <label>{{ __("Sandbox (TEST MODE):") }}</label><br>
           <input type="checkbox" id="DPO_SANDBOX" class="custom_toggle" name="DPO_SANDBOX" {{ config('dpopayment.enable_sandbox') == 1 ? "checked"  :"" }} />

           <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="DPO_SANDBOX"></label><br>
           <small class="text-info">{{ __("(Active or deactive test mode in payment gateway by toggling it.)") }}</small>
       </div>

       <div class="form-group col-md-12">
            <button type="reset" class="btn btn-danger-rgba mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
            <button type="submit" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
            {{ __("Update")}}</button>
        </div>
    </div>
</div>
<!-- Paytabs payment settings end -->