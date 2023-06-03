<!-- This will append DPO payment content on checkout page. -->
<!-- DPO payment content start -->
@if(env('ENABLE_DPOPAYMENT') == 1)
<div class="card">
    <div class="card-header" id="headingOne">
        <div class="panel-title">
            <label for='dpopay'>
                <input type='radio' id='dpopay' name='occupation' value='Working' required />
                <a data-toggle="collapse" data-parent="#accordion" href="#dpopay_pay"></a>

                <img src="{{ Module::asset('dpopayment:logo/dpopayment.png') }}" class="img-fluid"
                    alt="course">
            </label>
        </div>
    </div>
    <div id="dpopay_pay" class="panel-collapse collapse in">
        <div class="card-body">

            <div class="payment-proceed-btn">


                <form action="{{ route('dpo.payment.process') }}" method="POST" autocomplete="off">
                    @csrf


                    <input type="hidden" name="amount" value="{{ strip_tags($secureamount) }}">
                    <button class="btn btn-primary" title="checkout" type="submit">{{ __('frontstaticword.Proceed') }}</button>
                    
                </form>

                

            </div>
        </div>
    </div>
</div>

@endif
<!-- DPO payment content end -->