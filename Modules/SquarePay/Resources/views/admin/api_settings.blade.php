<!-- This will append SQUAREPAY payment content on API settings page. -->
<!-- SQUAREPAY payment settings start -->
<div class="tab-pane fade" id="v-pills-SquarePay" role="tabpanel" aria-labelledby="v-pills-SquarePay-tab">
    <div class="row">
        <div class="col-md-12 form-grou">
            <label for="pay_enable">{{ __('Squarepay Payment') }}</label> 
        </div>

        <div class="col-md-12 form-group">
            <input type="checkbox" id="squarepay_sec1" class="custom_toggle" name="SQUARE_PAY_ENABLE"
            {{ env('SQUARE_PAY_ENABLE') == '1' ? "checked" : "" }} />
        </div>
        
        <div class="form-group col-md-6">
            <label>{{ __("SQUARE PAY LOCATION ID:") }}</label>
            <input name="SQUARE_PAY_LOCATION_ID" value="{{ env('SQUARE_PAY_LOCATION_ID') }}" type="text" class="form-control" placeholder="{{ __("Enter SQUARE PAY LOCATION ID") }}">
        </div>
        
        <div class="form-group col-md-6">
            <div class="eyeCy">

                <label for="SQUARE_ACCESS_TOKEN">{{ __("SQUARE PAY APP SECRET:") }}</label>
                <input type="password" value="{{ env('SQUARE_ACCESS_TOKEN') }}" name="SQUARE_ACCESS_TOKEN"
                    placeholder="{{ __("Enter SQUARE PAY ACCESS TOKEN") }}" id="SQUARE_ACCESS_TOKEN" type="password"
                    class="form-control">
                <span toggle="#SQUARE_ACCESS_TOKEN" class="fa fa-fw fa-eye field-icon toggle-password"></span>

            </div>
        </div>

        <div class="form-group col-md-6">
            <label>{{ __("SQUARE APPLICATION ID:") }}</label>
            <input name="SQUARE_APPLICATION_ID" value="{{ env('SQUARE_APPLICATION_ID') }}" type="text" class="form-control" placeholder="{{ __("Enter SQUARE PAY APPLICATION ID") }}">
        </div>

        <div class="form-group col-md-12">
            <button type="reset" class="btn btn-danger-rgba mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
            <button type="submit" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
            {{ __("Update")}}</button>
        </div>
    </div>
</div>
<!-- SQUAREPAY payment settings end -->
