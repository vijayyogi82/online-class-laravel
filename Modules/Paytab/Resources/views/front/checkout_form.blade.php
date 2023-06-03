<!-- This will append Paytabs payment content on checkout page. -->
<!-- Paytabs payment content start -->
@if(env('ENABLE_PAYTAB') == 1)
<div class="card">
    <div class="card-header" id="headingOne">
        <div class="panel-title">
            <label for='paytab'>
                <input type='radio' id='paytab' name='occupation' value='Working' required />
                <a data-toggle="collapse" data-parent="#accordion" href="#paytab_pay"></a>

                <img src="{{ Module::asset('paytab:logo/paytab.png') }}" class="img-fluid"
                    alt="course">
            </label>
        </div>
    </div>
    <div id="paytab_pay" class="panel-collapse collapse in">
        <div class="card-body">
            <div class="payment-proceed-btn">
               @if(config('paytab.ENABLE') == 1)

                    <form action="{{ route("paytabs.front.payment") }}" method="POST">
                        @csrf

                        <input type="hidden" name="actualtotal" value="{{ strip_tags($mainpay) }}">
                        <input type="hidden" name="amount" value="{{ strip_tags($mainpay) }}">
                        <div class="col-md-12">
                            <button class="btn btn-primary" title="checkout" type="submit">{{ __('frontstaticword.Proceed') }}</button>
                        </div>
                        
                    </form>

               @endif
            </div>
        </div>
    </div>
</div>

@endif
<!-- Paytabs payment content end -->