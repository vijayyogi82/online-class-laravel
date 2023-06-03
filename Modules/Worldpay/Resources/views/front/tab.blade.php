<div class="tab-pane" id="worldpay_payment_tab">
    @if($checkoutsetting_check->checkout_currency == 1)
    @if(isset($listcheckOutCurrency->payment_method) && strstr($listcheckOutCurrency->payment_method,'worldpay'))
    <h3>{{__('staticwords.Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
        {{ sprintf("%.2f",Crypt::decrypt($secure_amount),2) }}</h3>
    <div class="row">

        <div class="col-md-6">
            <div class="form-container active">
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
                    <input type="hidden" name="actualtotal" value="{{ strip_tags($un_sec) }}">
                    <input type="hidden" name="amount" value="{{ strip_tags($secure_amount) }}">
                    <hr>
                    <div class="form-group">
                        <button class="btn btn-primary btn-md" type="submit">
                            {{__('staticwords.Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i> {{ Crypt::decrypt(strip_tags($secure_amount)) }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @else

    <h4>{{ __('Worldpay') }} {{__('staticwords.chknotavbl')}}
        <b>{{ session()->get('currency')['id'] }}</b>.</h4>


    @endif
    @else
    <div class="row">
        <div class="col-md-6">
            <h3>{{__('staticwords.Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i>
            {{ sprintf("%.2f",Crypt::decrypt($secure_amount),2) }}</h3>
            <div class="form-container active">
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
                    <input type="hidden" name="actualtotal" value="{{ strip_tags($un_sec) }}">
                    <input type="hidden" name="amount" value="{{ strip_tags($secure_amount) }}">
                    <hr>
                    <div class="form-group">
                        <button class="btn btn-primary btn-md" type="submit">
                            {{__('staticwords.Pay')}} <i class="{{ session()->get('currency')['value'] }}"></i> {{ Crypt::decrypt(strip_tags($secure_amount)) }}
                        </button>
                    </div>
                </form>
            </div>
            <br>
            <p class="text-muted"><i class="fa fa-lock"></i>
                {{ __('Secured Card Transcations Powered By Worldpay Payments') }}</p>
        </div>
    </div>



    @endif
</div>
@push('module-script')
    
    <script src="//cdn.worldpay.com/v1/worldpay.js"></script>
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
    
@endpush