<!-- This will append Authorize.Net payment content on checkout page. -->
<!-- Authorize.Net payment content start -->
@if(env('AUTHORIZE_NET_ENABLE') == 1)
<div class="card">
    <div class="card-header" id="headingOne">
        <div class="panel-title">
            <label for='authorize'>
                <input type='radio' id='authorize' name='occupation' value='Working' required />
                <a data-toggle="collapse" data-parent="#accordion" href="#authorize_pay"></a>

                <img src="{{ Module::asset('authorizenet:logo/authorizenet.png') }}" class="img-fluid" alt="course">
            </label>
        </div>
    </div>
    <div id="authorize_pay" class="panel-collapse collapse in">
        <div class="card-body">
            <div class="payment-proceed-btn">

            <form method="POST" action="{{ route('auth.front.payment') }}" id="authnet-credit-card">
                @csrf
                
                <div class="form-group">
                  <input maxlength="19" class="form-control" placeholder="Card number" type="tel" name="number">
                  @if ($errors->has('number'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('number') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="form-group">
                  <input class="form-control" placeholder="Full name" type="text" name="name">
                  @if ($errors->has('name'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="form-group">
                  <input class="form-control" placeholder="MM/YYYY" type="tel" name="expiry">
                  @if ($errors->has('expiry'))
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('expiry') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group">
                  <input class="form-control" placeholder="CVC" type="password" name="cvc">
                  @if ($errors->has('cvc'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('cvc') }}</strong>
                  </span>
                  @endif
                </div>



                <input id="amount" type="hidden" class="form-control" name="amount"
                  value="{{ $secureamount }}">

                <button class='form-control btn btn-default' type='submit'>{{ __('frontstaticword.Proceed') }}</button>


            </form>
               
            </div>
        </div>
    </div>
</div>

@endif
<!-- Authorize.Net payment content end -->