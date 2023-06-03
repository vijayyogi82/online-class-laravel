<!-- This will append MIDTRAINS payment content on API settings page. -->
<!-- MIDTRAINS payment settings start -->
<div class="tab-pane fade" id="v-pills-Midtrains" role="tabpanel" aria-labelledby="v-pills-Midtrains-tab">
    <div class="row">
        <div class="col-md-12 form-group">
            <label for="pay_enable">{{ __('MIDTRAINS PAYMENT') }}</label> 
        </div>

        <div class="col-md-12 form-group">
            <input type="checkbox" id="midtrains_sec1" class="custom_toggle" name="MID_TRANS_ENABLE"
            {{ env('MID_TRANS_ENABLE') == '1' ? "checked" : "" }} />
        </div>
        
        <div class="form-group col-md-12">
        <a target="__blank" href="https://midtrans.com/" class="">
            <i class="fa fa-key"></i>
            {{ __("Get your keys from here") }}</a>
        </div>
       
        <div class="form-group col-md-6">
                <label>{{ __("MID TRANS CLIENT KEY:") }} <span class="text-red">*</span></label>
                <input name="MID_TRANS_CLIENT_KEY" value="{{ config('midtrains.MID_TRANS_CLIENT_KEY') }}" type="text"
                    class="form-control" placeholder="{{ __("Enter midtrains client id") }}">
        </div>
        
        <div class="form-group col-md-6">
            <div class="eyeCy">

                <label>{{ __("MID TRANS SERVER KEY:") }} <span class="text-red">*</span></label>
                <input type="password" value="{{ config('midtrains.MID_TRANS_SERVER_KEY') }}" name="MID_TRANS_SERVER_KEY" placeholder="{{ __("enter worldpay secret key") }}" id="MID_TRANS_SERVER_KEY" type="password"
                    class="form-control">
                <span toggle="#MID_TRANS_SERVER_KEY" class="fa fa-fw fa-eye field-icon toggle-password"></span>

            </div>
        </div>

        <div class="form-group col-md-6">
            <label>
                {{ __("Live Mode:") }}
            </label>
            <br>
            <label class="switch">
                <input id="MID_TRANS_MODE" type="checkbox" name="MID_TRANS_MODE"
                {{ env('MID_TRANS_MODE') == 'live' ? "checked" : "" }} >
                <span class="knob"></span>
            </label>
        </div>

        <div class="form-group col-md-12">
            <button type="reset" class="btn btn-danger-rgba mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
            <button type="submit" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
            {{ __("Update")}}</button>
        </div>
    </div>
</div>    
<!-- MIDTRAINS payment settings end -->
