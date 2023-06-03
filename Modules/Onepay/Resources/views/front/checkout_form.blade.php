<!-- This will append Onepay payment content on checkout page. -->
<!-- Onepay  payment content start -->
@if(config('onepay.ENABLE') == '1')
<div class="card">
    <div class="card-header" id="headingOne">
        <div class="panel-title">
            <label for='onepay'>
                <input type='radio' id='onepay' name='occupation' value='Working' required />
                <a data-toggle="collapse" data-parent="#accordion" href="#onepay_tab"></a>

                <img src="{{ Module::asset('onepay:logo/onepay.png') }}" class="img-fluid"/>
            </label>
        </div>
    </div>
    <div id="onepay_tab" class="panel-collapse collapse in">
        <div class="card-body">
            <div class="payment-proceed-btn">

                    <form action="{{ url('/onepay/dopayment') }}" method="POST">
                        @csrf

                        <input type="hidden" name="actualtotal" value="{{ strip_tags($mainpay) }}">
                        <input type="hidden" name="amount" value="{{ strip_tags($mainpay) }}">
                        <div class="col-md-12">
                            <button class="btn btn-primary" title="checkout" type="submit">{{ __('frontstaticword.Proceed') }}</button>
                        </div>
                        
                    </form>

            </div>
        </div>
    </div>
</div>

@endif
<!-- Onepay payment content end -->
@push('custom-script')
    <script>

        "use Strict";

        $('#onepay').on('click', function(){
            $(this).parent().find('a').trigger('click');
        });

    </script>
@endpush