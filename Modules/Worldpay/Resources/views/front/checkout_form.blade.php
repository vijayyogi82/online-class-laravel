<!-- This will append WORLDPAY payment content on checkout page. -->
<!-- WORLDPAY payment content start -->
@if(env('WORLDPAY_ENABLE') == 1)
<div class="card">
    <div class="card-header" id="headingOne">
        <div class="panel-title">
            <label for='worldpay'>
                <input type='radio' id='worldpay' name='occupation' value='Working' required />
                <a data-toggle="collapse" data-parent="#accordion" href="#worldpay_pay"></a>

                <img src="{{ Module::asset('worldpay:logo/worldpay.png') }}" class="img-fluid"
                    alt="course">
            </label>
        </div>
    </div>
    <div id="worldpay_pay" class="panel-collapse collapse in">
        <div class="card-body">

            <div class="payment-proceed-btn">



                <form action="{{ route("worldpay.front.payment")  }}" id="worldpaypaymentForm" method="post">
                    @csrf
                    <span class="h5 text-red" id="paymentErrors"></span>
                    <div class="form-group">
                        <label>
                            {{__("Name on Card:")}}
                        </label>
                        <input class="form-control" data-worldpay="name" name="name" type="text" required />
                    </div>
                    <div class="form-group">
                        <label>
                            {{__("Card Number:")}}
                        </label>
                        <input pattern="[0-9]+" maxlength="16" class="form-control" data-worldpay="number" size="20" type="text" required />
                    </div>
                    <div class="form-group">
                        <label>
                            {{__("Expiration (MM):")}}
                        </label>
                        <input class="form-control" maxlength="2" data-worldpay="exp-month" size="2" type="text" required />
                        <label>
                            {{__("Expiration (YYYY):")}}
                        </label>
                        <input class="form-control" maxlength="4" data-worldpay="exp-year" size="4" type="text" required />
                    </div>
                    <div class="form-group">
                        <label>
                            {{__("CVC:")}}
                        </label>
                        <input pattern="[0-9]+" maxlength="4" class="form-control" data-worldpay="cvc" size="4" type="text" required />
                    </div>
                    <input type="hidden" name="actualtotal" value="{{ strip_tags($secureamount) }}">
                    <input type="hidden" name="amount" value="{{ strip_tags($secureamount) }}">
                    <hr>
                    <div class="form-group">

                        <button class="btn btn-primary" title="checkout" type="submit">{{ __('frontstaticword.Proceed') }}</button>
                    </div>
                </form>

                

            </div>
        </div>
    </div>
</div>

@endif

<script src="https://cdn.worldpay.com/v1/worldpay.js"></script>
<script>

    "use strict";

    var form = document.getElementById('worldpaypaymentForm');
    Worldpay.useOwnForm({
        'clientKey': @json(config('worldpay.WORLDPAY_CLIENT_KEY')),
        'form': form,
        'reusable': false,
        'callback': function(status, response) {
        document.getElementById('paymentErrors').innerHTML = '';
        if (response.error) {               
            Worldpay.handleError(form, document.getElementById('paymentErrors'), response.error); 
        } else {
            var token = response.token;
            Worldpay.formBuilder(form, 'input', 'hidden', 'token', token);
            form.submit();
        }
        }
    });
</script>
<!-- WORLDPAY payment content end -->
