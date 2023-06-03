<!-- This will append Mpesa payment content on checkout page. -->
<!-- Mpesa payment content start -->
@if(config('mpesa.ENABLE') == 1)

@if($currency->currency == 'KES' || $currency->currency == 'KSH')
<div class="card">
    <div class="card-header" id="headingFour">
        <div class="panel-title">
            <label for='mpesalabel'>
              <input type='radio' id='mpesalabel' name='occupation' value='Working' required />
              <a data-toggle="collapse" data-parent="#accordion" href="#mpesa"></a>
              <img src="{{ Module::asset('mpesa:logo/mpesa.png') }}"  class="img-fluid" alt="course"> 
            </label>
        </div>
	</div>
    <div id="mpesa" class="panel-collapse collapse in">
        <div class="card-body">
        	<div class="payment-proceed-btn">
        		<form method="POST" action="{{ route('payvia.mpesa') }}" class="form-horizontal" role="form">
        			@csrf
			            

			            <div class="form-group">
			            	<input type="hidden" name="user_id" value="{{Auth::User()->id}}"/>
			                <input class="form-control" minlength="12" maxlength="12" required type="text" name="phoneno" value="{{ old('phoneno') }}" placeholder="{{ __("Enter your mpesa phone no starts with 254") }}">
			                <input type="hidden" name="amount" value="{{ strip_tags($secureamount) }}">
			            </div>

			          
				        
				        <div class="col-md-12">
				            <button class="btn btn-primary" title="checkout" type="submit">{{ __('frontstaticword.Proceed') }}</button>
				        </div>
				    </div>
			          
				</form>
        	</div>
        </div>
    </div>
</div>

@endif
@endif
<!-- Mpesa payment content end -->