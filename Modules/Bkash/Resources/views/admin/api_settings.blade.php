<!-- This will append Paytabs payment content on API settings page. -->
<!-- Paytabs payment settings start -->
<div class="tab-pane fade" id="v-pills-Bkash" role="tabpanel" aria-labelledby="v-pills-Bkash-tab">
    <div class="row">
        <div class="col-md-12 form-group">
            <label for="pay_enable">{{ __('BKASH PAYMENT') }}</label> 
        </div>
        <div class="col-md-12 form-group">
            <input type="checkbox" id="bkash_sec1" class="custom_toggle" name="ENABLE_BKASH"
            {{ env('ENABLE_BKASH') == '1' ? "checked" : "" }} />
        </div>
        <div class="form-group col-md-6">
            <label>{{ __("BKASH APP KEY:") }}</label>
            <input name="BKASH_APP_KEY" value="{{ env('BKASH_APP_KEY') }}" type="text"
                class="form-control" placeholder="{{ __("Enter bkash app key") }}">
        </div>
        <div class="form-group col-md-6">
            <div class="eyeCy">
                <label for="BKASH_APP_SECRET">{{ __("BKASH APP SECRET:") }}</label>
                <input type="password" value="{{ env('BKASH_APP_SECRET') }}" name="BKASH_APP_SECRET"
                    placeholder="{{ __("enter bkash app secret") }}" id="BKASH_APP_SECRET" type="password"
                    class="form-control">
                <span toggle="#BKASH_APP_SECRET" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label>{{ __("BKASH USER NAME:") }}</label>
            <input name="BKASH_USER_NAME" value="{{ env('BKASH_USER_NAME') }}" type="text"
                class="form-control" placeholder="{{ __("Enter bkash username") }}">
        </div>
        <div class="form-group col-md-6">
            <div class="eyeCy">
                <label for="BKASH_PASSWORD">{{ __("BKASH APP Password:") }}</label>
                <input type="password" value="{{ env('BKASH_PASSWORD') }}" name="BKASH_PASSWORD"
                    placeholder="{{ __("enter bkash password") }}" id="BKASH_PASSWORD" type="password"
                    class="form-control">
                <span toggle="#BKASH_PASSWORD" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
        </div>
        <div class="form-group col-md-12">
            <label>{{ __("SANDBOX Mode (TEST Mode):") }}</label>
            <input name="BKASH_SANDBOX_MODE" id="BKASH_SANDBOX_MODE"
                {{ config('bkash.SANDBOX_ENABLED') == 1 ? "checked"  :"" }} type="checkbox" class="custom_toggle">
            <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="BKASH_SANDBOX_MODE"></label>
            <br>
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
<!-- Paytabs payment settings end -->
