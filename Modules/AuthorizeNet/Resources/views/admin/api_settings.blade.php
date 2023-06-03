<!-- This will append Authorize.net payment content on API settings page. -->
<!-- Authorize.net payment settings start -->
<div class="tab-pane fade" id="v-pills-AuthorizeNet" role="tabpanel" aria-labelledby="v-pills-AuthorizeNet-tab">
    <div class="row">
        <div class="col-md-12 form-group">
        <label for="pay_enable">{{ __('Authorize Net Payment') }}</label> 
        </div>
        <div class="col-md-12 form-group">
            <input type="checkbox" id="authorizenet_sec1" class="custom_toggle" name="AUTHORIZE_NET_ENABLE"
            {{ env('AUTHORIZE_NET_ENABLE') == '1' ? "checked" : "" }} />
        </div>
        
        <div class="form-group col-md-6">
            <label>{{ __("API LOGIN ID:") }} <span class="text-red">*</span></label>
            <input name="API_LOGIN_ID" value="{{ config('authorizenet.API_LOGIN_ID') }}" type="text"
                class="form-control" placeholder="{{ __("Enter authorizenet login id") }}">
        </div>


        <div class="form-group col-md-6">
            <div class="eyeCy">

                <label>{{ __("TRANSCATION KEY:") }} <span class="text-red">*</span></label>
                <input type="password" value="{{ config('authorizenet.TRANSCATION_KEY') }}" name="TRANSCATION_KEY"
                    placeholder="{{ __("enter TRANSCATION KEY") }}" id="TRANSCATION_KEY" type="password"
                    class="form-control">
                <span toggle="#TRANSCATION_KEY" class="fa fa-fw fa-eye field-icon toggle-password"></span>

            </div>
        </div>

    

        <div class="form-group col-md-12">
            <label>{{ __("SANDBOX Mode (TEST Mode):") }}</label> <br>
            <input type="checkbox" id="AUTHORIZE_NET_MODE" class="custom_toggle" name="AUTHORIZE_NET_MODE" {{ env('AUTHORIZE_NET_MODE') == '1' ? "checked" : "" }} />

            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="AUTHORIZE_NET_MODE"></label> <br>
            <small class="text-info">
                {{__("(Active or deactive test mode in payment gateway by toggling it.)")}}
            </small>
        </div>
        <div class="form-group col-md-12">
            <button type="reset" class="btn btn-danger-rgba mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
            <button type="submit" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
            {{ __("Update")}}</button>
        </div>
    </div>
</div>
<!-- Authorize.net payment settings end -->
