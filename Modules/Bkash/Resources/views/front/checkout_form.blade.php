<!-- This will append Bkash payment content on checkout page. -->
<!-- Bkash payment content start -->
@if(env('ENABLE_BKASH') == 1)
<div class="card">
    <div class="card-header" id="headingOne">
        <div class="panel-title">
            <label for='bkash'>
                <input type='radio' id='bkash' name='occupation' value='Working' required />
                <a data-toggle="collapse" data-parent="#accordion" href="#bkash_pay"></a>

                <img src="{{ Module::asset('bkash:logo/bkash.png') }}" class="img-fluid"
                    alt="course">
            </label>
        </div>
    </div>
    <div id="bkash_pay" class="panel-collapse collapse in">
        <div class="card-body">

            <div class="payment-proceed-btn">


                <form>
                    @csrf

                    <input type="hidden" name="amount" value="{{ strip_tags($secureamount) }}">
                    <button  id="bKash_button" class="btn btn-primary" title="checkout" type="button">
                        {{ __('frontstaticword.Proceed') }}
                    </button>

                    
                    
                </form>

                

            </div>
        </div>
    </div>
</div>

@endif

<!-- Bkash payment content end -->