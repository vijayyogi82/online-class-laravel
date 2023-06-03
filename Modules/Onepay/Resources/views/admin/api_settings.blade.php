<div class="tab-pane fade" id="v-pills-onepay" role="tabpanel" aria-labelledby="v-pills-onepay-tab">
    <div class="panel-heading">
        <label class="text-dark">{{ __("OnePay Payment Settings:") }}</label>
        <a target="__blank" href="https://mtf.onepay.vn/" class="text-blue pull-right">
            <i class="fa fa-key"></i>{{ __("Get your keys from here") }}</a>
    </div>

    <form action="{{ route('onepay.payment.settings') }}" method="POST">
        @csrf
        <div class="row">
            <div class="form-group col-md-6">
                <div class="eyeCy">

                    <label class="text-dark"> {{ __("ONEPAY ACCESS CODE:") }}</label>
                    <!-- --------------- -->
                    <input type="password" class="form-control" id="ONEPAY_ACCESS_CODE"
                        name="ONEPAY_ACCESS_CODE" id="ONEPAY_ACCESS_CODE" value="{{ config('onepay.ONEPAY_ACCESS_CODE') }}"
                        placeholder='{{ __("Enter your ONEPAY ACCESS CODE") }}'>
                    <span toggle="#ONEPAY_ACCESS_CODE" class="fa fa-fw fa-eye field_icon toggle-password"></span>

                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="eyeCy">

                    <label class="text-dark"> {{ __("ONEPAY SECURE CODE:") }}</label>
                    <!-- --------------- -->
                    <input type="password" class="form-control" name="ONEPAY_SECURE_CODE" id="ONEPAY_SECURE_CODE" value="{{ config('onepay.ONEPAY_SECURE_CODE') }}" placeholder='{{ __("Enter your ONEPAY SECURE CODE") }}'>
                    <span toggle="#ONEPAY_SECURE_CODE" class="fa fa-fw fa-eye field_icon toggle-password"></span>

                </div>
            </div>

            <div class="form-group col-md-6">
                    <label class="text-dark" for="ONEPAY_MERCHANT_ID">{{ __("ONEPAY MERCHANT ID:") }}</label>
                    <!-- --------------- -->
                    <input type="text" class="form-control" id="ONEPAY_MERCHANT_ID" name="ONEPAY_MERCHANT_ID" value="{{ config('onepay.ONEPAY_MERCHANT_ID') }}" placeholder='{{ __("enter your ONEPAY MERCHANT ID.") }}'>
            </div>

            <div class="form-group col-md-6">
                <label class="text-dark" for="">{{ __("Status:") }}</label><br>
                <label class="switch">
                    <input class="slider" type="checkbox" id="ONEPAY_ENABLE" name="ONEPAY_ENABLE"
                        {{ config('onepay.ENABLE') == 1 ? "checked"  :"" }} />
                    <span class="knob"></span>
                </label><br>

                <small class="txt-desc">{{ __("(Active or deactive payment gateway by toggling it.)") }}</small>
            </div>
        </div>

        <div class="form-group">
            <button type="reset" class="btn btn-danger mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
            <button type="submit" class="btn btn-md btn-primary">
                <i class="fa fa-check-circle"></i> {{__("Save Settings")}}
            </button>
        </div>



    </form>
</div>