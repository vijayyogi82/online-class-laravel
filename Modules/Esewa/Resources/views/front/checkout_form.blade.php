<!-- This will append Esewa payment content on checkout page. -->
<!-- Esewa payment content start -->
@if($gsetting->esewa_enable == 1)
<div class="card">
    <div class="card-header" id="headingOne">
        <div class="panel-title">
            <label for='esewa'>
                <input type='radio' id='esewa' name='occupation' value='Working' required />
                <a data-toggle="collapse" data-parent="#accordion" href="#esewa_pay"></a>

                <img src="{{ Module::asset('esewa:images/esewa.png') }}" class="img-fluid"
                    alt="course">
            </label>
        </div>
    </div>
    <div id="esewa_pay" class="panel-collapse collapse in">
        <div class="card-body">

            <div class="payment-proceed-btn">

                @php
                                            
                $pid = rand(1000000000,9999999999);
                
                @endphp


                @if(env('ESEWA_MODE') == 'SANDBOX')
                    @php
                    $esewa_url = 'https://uat.esewa.com.np/epay/main';
                    @endphp
                @else
                    @php
                    $esewa_url = 'https://merchant.esewa.com.np/epay/main';
                    @endphp

                @endif


                <form action="{{ $esewa_url }}" method="POST">
                    <input value="{{ $mainpay }}" name="amt" type="hidden">
                    <input value="{{ $mainpay }}" name="tAmt" type="hidden">
                    <input value="0" name="txAmt" type="hidden">
                    <input value="0" name="psc" type="hidden">
                    <input value="0" name="pdc" type="hidden">
                    <input value="{{ env('ESEWA_MERCHANT_ID') }}" name="scd" type="hidden">
                    <input value="{{ $pid }}" name="pid" type="hidden">
                    <input value="{{    route('esewa.success',[ 'q' => 'su'])   }}" type="hidden" name="su">
                    <input value="{{    route('esewa.fail',['q' => 'fu'])   }}" type="hidden" name="fu">
                    <input class="btn btn-primary" value="{{ __("Pay") }}" type="submit">
                </form>

            </div>
        </div>
    </div>
</div>

@endif
<!-- Esewa payment content end -->