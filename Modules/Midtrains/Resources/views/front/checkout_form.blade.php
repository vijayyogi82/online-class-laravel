<!-- This will append Midtrains payment content on checkout page. -->
<!-- Midtrains payment content start -->
@if(env('MID_TRANS_ENABLE') == 1)
<div class="card">
    <div class="card-header" id="headingOne">
        <div class="panel-title">
            <label for='midtrains'>
                <input type='radio' id='midtrains' name='occupation' value='Working' required />
                <a data-toggle="collapse" data-parent="#accordion" href="#midtrains_pay"></a>

                <img src="{{ Module::asset('midtrains:logo/midtrains.png') }}" class="img-fluid"
                    alt="course">
            </label>
        </div>
    </div>
    <div id="midtrains_pay" class="panel-collapse collapse in">
        <div class="card-body">

            <div class="payment-proceed-btn">



                <div class="form-container active">
                <form id="midtrans-payment-form" method="post" action="{{ route("midtrains.front.payment") }}">
                    @csrf
                    <input type="hidden" name="actualtotal" value="{{ strip_tags($secureamount) }}">
                    <input type="hidden" name="amount" value="{{ strip_tags($secureamount) }}">
                    <input type="hidden" name="result_type" id="result-type" value="">
            </div>
            <input type="hidden" name="result_data" id="result-data" value="">
       
        </form>
        <button type="submit" class="btn btn-md btn-primary" id="pay-button-midtrans">
            {{ __("Pay") }} {{ strip_tags(round(Crypt::decrypt($secureamount))) }}
        </button>
        <br>
        <p class="text-muted"><i class="fa fa-lock"></i>
            {{ __('Secured Transcations Powered By Midtrans Payments') }}</p>

                

            </div>
        </div>
    </div>
</div>

@endif

<!-- Midtrains payment content end -->