<!-- This will append smanager payment content on checkout page. -->
<!-- smanager payment content start -->
@if($gsetting->smanager_enable == 1)

<div class="card">
    <div class="card-header" id="headingFour">
        <div class="panel-title">
            <label for='smanagerlabel'>
              <input type='radio' id='smanagerlabel' name='occupation' value='Working' required />
              <a data-toggle="collapse" data-parent="#accordion" href="#smanager"></a>
              <img src="{{ Module::asset('smanager:logo/smanager.png') }}"  class="img-fluid" alt="smanager"> 
            </label>
        </div>
	</div>
    <div id="smanager" class="panel-collapse collapse in">
        <div class="card-body">
        	<div class="payment-proceed-btn">
        		<form method="POST" action="{{ route('smanager.index') }}" class="form-horizontal" role="form">
        			@csrf
			            

			            <div class="form-group">
			            	<input type="hidden" name="user_id" value="{{Auth::User()->id}}"/>
			                <input type="hidden" name="amount" value="{{ strip_tags($mainpay) }}">
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
<!-- Smanager payment content end -->