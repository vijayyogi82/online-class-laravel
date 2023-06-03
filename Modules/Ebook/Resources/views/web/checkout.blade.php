@extends('theme.master')
@section('title', 'Checkout')
@section('content')

@include('admin.message')

<!-- about-home start -->
<section id="wishlist-home" class="wishlist-home-main-block">
    <div class="container-xl">
        <h1 class="wishlist-home-heading text-white">{{ __('Checkout') }}</h1>
    </div>
</section> 
<!-- about-home end -->
<section id="checkout-block" class="checkout-main-block">
	<div class="container-xl">
		<div class="cart-items btm-30">
	        <div class="row">
	        	<div class="col-lg-4 col-sm-4">
	        		<h4 class="cart-heading bg-white">{{ __('Your Items') }} ({{count($carts)}})
            		@php
                        if(auth::check())
	        			{
	        				$item = Modules\Ebook\Models\EbookCart::where('user_id', Auth::user()->id)->get();
	        			}
	                	else
	                	{
	                		$item = session()->get('cart.add_to_cart');
	                		$item = array_unique($item);
	                	}
						$ebook_id = '';
                    @endphp
	            	</h4>
	            	<hr>
	            	<div class="checkout-items">
                        @if(isset($carts))
	            		@foreach($carts as $cart)
			            	<div class="row btm-10">
			            		<div class="col-lg-3 col-4">
			            			<div class="checkout-course-img">
                                        @if($cart->ebook->thumbnali !== NULL && $cart->ebook->thumbnali !== '')
                                            <a href="{{ url('web/ebook/detail/'.$cart->ebook->id) }}"><img src="{{ asset('images/ebook/'.$cart->ebook->thumbnali) }}" class="img-fluid" alt="course"></a>
			            				@else
                                            <img src="{{ Avatar::create($cart->ebook->title)->toBase64() }}" class="img-fluid" alt="blog">
		                                @endif
			            			</div>
			            		</div>
			            		<div class="col-lg-9 col-8">
			            			<ul>
			            				@if($cart->course_id != NULL)
			            					<li class="checkout-course-title"><a href="{{ url('web/ebook/detail/'.$cart->ebook->id) }}">{{ str_limit($cart->ebook->title, $limit =35 , $end = '...') }}</a></li>
			            				@else
			            					<li class="checkout-course-title"><a href="{{ url('web/ebook/detail/'.$cart->ebook->id) }}">{{ str_limit($cart->ebook->title, $limit =35 , $end = '...') }}</a></li>
			            				@endif
			            				<li class="checkout-course-user">{{ __('By')}} {{$cart->ebook->user_id?$cart->ebook->user->fname:''}} {{$cart->ebook->user_id?$cart->ebook->user->lname:''}}</li>
			            				
                                        @if($cart->ebook->discount_price > 0)
			            					<li class="checkout-course-price">
												<b>{{ currency($cart->ebook->discount_price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = true) }}</b>  
												<s>{{ currency($cart->ebook->price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = true) }}</s>
											</li>
			            				@else			            					
			            					<li class="checkout-course-price"><b>Free</b></li>
			            				@endif
			            			</ul>
			            		</div>
			            	</div>
							<?php
								$ebook_id = $cart->ebook_id;
							?>
	            		@endforeach
                        @endif

	            	</div>
                </div>
	            <div class="col-lg-8 col-sm-8">
	            	<div class="checkout-pricelist">
		            	<ul>
		            		@php
		            		$currency = App\Currency::where('default', '=', '1')->first();
							$orignal_price = currency($price_total, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = true);
		            		@endphp
		            		
		            		<li><h1 class="checkout-total">{{ __('Total') }}: {{ currency($offer_total, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = true) }}</h1></li>

		            		<li><div class="checkout-price"><s>{{ currency($price_total, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = true) }}</s></div></li>
		            		
		            		@php
		            			if($offer_total != '' || $offer_total != 0){
		            				$mainpay = round($offer_total,2);
		            			}else{
		            				$mainpay = round($offer_total,2);
		            			}
		            		@endphp
		            		
		            	</ul>
	            	</div>
					@if(session()->has('changed_currency'))
					@if(session()->get('changed_currency') !== $currency->code)
	            	<div class="h6 checkout-pricelist">

	            		({{ __('Equivalent to your currency')}} {{ currency($offer_total, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = true) }})
	            		
	            	</div>
					<hr>
					@endif
					@endif
	            	@php  		
						$secureamount = Crypt::encrypt($mainpay);
        				$secureamount = currency($offer_total, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = true);
        			@endphp
        			<div class="payment-gateways">
	            		<div id="accordion" class="second-accordion">
	            		 							
	            			@if(isset($cart->bundle->is_subscription_enabled) && $cart->bundle->is_subscription_enabled == '1')

	            			@if($gsetting->stripe_enable == 1)
							<div class="card">
	                            <div class="card-header" id="headingThree">
							        <div class="panel-title">
							            <label for='r13'>
							              <input type='radio' id='r13' name='occupation' value='Working' required />
							              <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"></a>
							              <img src="{{ url('images/payment/stripe.png') }}" class="img-fluid" alt="course">
							            </label>
							        </div>
						    	</div>
							    <div id="collapseThree" class="panel-collapse collapse in">
							        <div class="card-body">
								      
									    <div class="creditCardForm">
										  
										    <div class="payment">
										        <form accept-charset="UTF-8" action="{{route('stripe.pay')}}" method="POST"autocomplete="off">
										    		{{ csrf_field() }}
										            <div class="form-group owner">
										                <label for="owner">{{ __('Owner')}}</label>
										                <input type="text" class="form-control" id="owner" required>
										            </div>
										            <div class="form-group CVV">
										                <label for="cvv">CVV</label>
										                <input type="text" class="form-control" id="cvv" name="ccv" required>
										            </div>
										            <div class="form-group" id="card-number-field">
										                <label for="cardNumber">{{ __('Card Number')}}</label>
										                <input type="text" class="form-control" id="cardNumber" name="card_no" required>
										            </div>
										            <div class="form-group" id="expiration-date">
										                <label>Expiration Date</label>
										                <select name="expiry_month" required> 
															<option value="01">{{__('January')}}</option>
															<option value="02">{{__('February')}} </option>
															<option value="03">{{__('March')}}</option>
															<option value="04">{{__('April')}}</option>
															<option value="05">{{__('May')}}</option>
															<option value="06">{{__('June')}}</option>
															<option value="07">{{__('July')}}</option>
															<option value="08">{{__('August')}}</option>
															<option value="09">{{__('September')}}</option>
															<option value="10">{{__('October')}}</option>
															<option value="11">{{__('November')}}</option>
															<option value="12">{{__('December')}}</option>
										                </select>
										                <select name="expiry_year" required>
															<option value="19">{{__('2019')}}</option>
															<option value="20">{{__('2020')}}</option>
															<option value="21">{{__('2021')}}</option>
															<option value="22">{{__('2022')}}</option>
															<option value="23">{{__('2023')}}</option>
															<option value="24">{{__('2024')}}</option>
															<option value="25">{{__('2025')}}</option>
															<option value="26">{{__('2026')}}</option>
															<option value="27">{{__('2027')}}</option>
															<option value="28">{{__('2028')}}</option>
															<option value="29">{{__('2029')}}</option>
															<option value="30">{{__('2030')}}</option>
															<option value="31">{{__('2031')}}</option>
															<option value="32">{{__('2032')}}</option>
										                </select>
										            </div>
										            <div class="form-group" id="credit_cards">
										                <img src="{{ url('images/payment/visa.jpg') }}" id="visa">
										                <img src="{{ url('images/payment/mastercard.jpg') }}" id="mastercard">
										                <img src="{{ url('images/payment/amex.jpg') }}" id="amex">
										            </div>

										            <input type="hidden" name="amount"  value="{{ $mainpay }}" />

										            <button class='form-control btn btn-default' type='submit'>{{ __('Proceed') }}</button>
										        </form>
										    </div>
										</div>
							        </div>
							    </div>
							</div>
							@endif
						

							@else


							@if($gsetting->stripe_enable == 1)
							<div class="card">
	                            <div class="card-header" id="headingThree">
							        <div class="panel-title">
							            <label for='r13'>
							              <input type='radio' id='r13' name='occupation' value='Working' required />
							              <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"></a>
							              <img src="{{ url('images/payment/stripe.png') }}" class="img-fluid" alt="course">
							            </label>
							        </div>
						    	</div>
							    <div id="collapseThree" class="panel-collapse collapse in">
							        <div class="card-body">
								      
									    <div class="creditCardForm">
										  
										    <div class="payment">
										        <form accept-charset="UTF-8" action="{{route('stripe.pay')}}" method="POST"autocomplete="off">
										    		{{ csrf_field() }}
										            <div class="form-group owner">
										                <label for="owner">{{ __('Owner')}}</label>
										                <input type="text" class="form-control" id="owner" required>
										            </div>
										            <div class="form-group CVV">
										                <label for="cvv">{{__('CVV')}}</label>
										                <input type="text" class="form-control" id="cvv" name="ccv" required>
										            </div>
										            <div class="form-group" id="card-number-field">
										                <label for="cardNumber">{{ __('Card Number')}}</label>
										                <input type="text" class="form-control" id="cardNumber" name="card_no" required>
										            </div>
										            <div class="form-group" id="expiration-date">
										                <label>{{ __('Expiration Date')}}</label>
										                <select name="expiry_month" required> 
															<option value="01">{{__('January')}}</option>
															<option value="02">{{__('February')}} </option>
															<option value="03">{{__('March')}}</option>
															<option value="04">{{__('April')}}</option>
															<option value="05">{{__('May')}}</option>
															<option value="06">{{__('June')}}</option>
															<option value="07">{{__('July')}}</option>
															<option value="08">{{__('August')}}</option>
															<option value="09">{{__('September')}}</option>
															<option value="10">{{__('October')}}</option>
															<option value="11">{{__('November')}}</option>
															<option value="12">{{__('December')}}</option>
										                </select>
										                <select name="expiry_year" required>
															<option value="19">{{__('2019')}}</option>
															<option value="20">{{__('2020')}}</option>
															<option value="21">{{__('2021')}}</option>
															<option value="22">{{__('2022')}}</option>
															<option value="23">{{__('2023')}}</option>
															<option value="24">{{__('2024')}}</option>
															<option value="25">{{__('2025')}}</option>
															<option value="26">{{__('2026')}}</option>
															<option value="27">{{__('2027')}}</option>
															<option value="28">{{__('2028')}}</option>
															<option value="29">{{__('2029')}}</option>
															<option value="30">{{__('2030')}}</option>
															<option value="31">{{__('2031')}}</option>
															<option value="32">{{__('2032')}}</option>
										                </select>
										            </div>
										            <div class="form-group" id="credit_cards">
										                <img src="{{ url('images/payment/visa.jpg') }}" id="visa">
										                <img src="{{ url('images/payment/mastercard.jpg') }}" id="mastercard">
										                <img src="{{ url('images/payment/amex.jpg') }}" id="amex">
										            </div>

										            <input type="text" name="amount"  value="{{ $mainpay }}" />

										            <button class='form-control btn btn-default' type='submit'>{{ __('Proceed') }}</button>
										        </form>
										    </div>
										</div>
							        </div>
							    </div>
							</div>
							@endif


	            			@if($gsetting->paypal_enable == 1)
						    <div class="card">
	                            <div class="card-header" id="headingOne">
							        <div class="panel-title">
							            <label for='r11'>
								            <input type='radio' id='r11' name='occupation' value='Working' required />
								            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"></a>
								              
								            <img src="{{ url('images/payment/paypal2.png') }}" class="img-fluid" alt="course">
							            </label>
							        </div>
						    	</div>
							    <div id="collapseOne" class="panel-collapse collapse in">
							        <div class="card-body">
		                            
		                            	<div class="payment-proceed-btn">
		                            		<form action="{{ route('payWithpaypal') }}" method="POST" autocomplete="off">
		                            			@csrf
		                            			
		                         				<input type="hidden" name="amount" value="{{ $secureamount  }}"/>
		                            			<button class="btn btn-primary" title="checkout" type="submit">{{ __('Proceed') }}</button>
		                            		</form>
		                            		
		                            	</div>
							        </div>
							    </div>
							</div>
							@endif

							

							@if($gsetting->enable_omise == 1 && $currency->code == 'THB')

							<div class="card">
								<div class="card-header" id="headingOne">
									<div class="panel-title">
										<label for='omise'>
											<input type='radio' id='omise' name='occupation' value='Working' required />
											<a data-toggle="collapse" data-parent="#accordion" href="#omise_panel"></a>

											<img src="{{ url('images/payment/omise.svg') }}" class="img-fluid"
												alt="course">
										</label>
									</div>
								</div>
								<div id="omise_panel" class="panel-collapse collapse in">
									<div class="card-body">

										<div class="payment-proceed-btn">

											<form id="checkoutForm" method="POST" action="{{ route('pay.via.omise') }}">
												@csrf
												<input type="hidden" name="amount" value="{{ $mainpay }}" />
												<script type="text/javascript" src="https://cdn.omise.co/omise.js"
													data-key="{{ env('OMISE_PUBLIC_KEY') }}"
													data-amount="{{ $mainpay*100 }}"
													data-frame-label="{{ config('app.name') }}"
													data-image="{{ url('images/logo/'.$gsetting->logo) }}"
													data-currency="{{ $currency->code }}"
													data-default-payment-method="credit_card">
												</script>
											</form>


										</div>
									</div>
								</div>
							</div>
							@endif


							@if($gsetting->razorpay_enable == 1)
							<div class="card">
	                            <div class="card-header" id="headingSix">
							        <div class="panel-title">
							            <label for='r16'>
							              <input type='radio' id='r16' name='occupation' value='Working' required />
							              <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix"></a>
							              <img src="{{ url('images/payment/razorpay.png') }}"  class="img-fluid" alt="course"> 
							            </label>
							            
							        </div>
						    	</div>
							    <div id="collapseSix" class="panel-collapse collapse in">
							        <div class="card-body">
		                            	<div class="payment-proceed-btn">
		                            		<form action="{{ route('ebook-dopayment') }}" method="POST">
		                            			@csrf
												<?php
													if(Session::get('changed_currency')=='INR'){
														$pay = str_replace("₹","",$secureamount);
														$orignal_price = str_replace("₹","",$orignal_price);
														$mainpay = str_replace(",","",$pay);
													} else {
														$mainpay = $mainpay;
														$orignal_price = $orignal_price;
													}
												?>
		                            			<input type="hidden" name="from" value="ebook">
		                         				<input type="hidden" name="amount" value="{{ $mainpay  }}"/>
		                         				<input type="hidden" name="orignal_price" value="{{$orignal_price}}">
												<input type="hidden" name="ebook_id" value="{{$ebook_id}}">
		                         				<script
												    src="https://checkout.razorpay.com/v1/checkout.js"
												    data-key="{{ env('RAZORPAY_KEY') }}"
												    data-amount= "{{ $mainpay*100 }}"
												    data-currency="{{ Session::get('changed_currency') }}"
												    data-order_id=""
												    data-buttontext="Proceed"
												    data-name="{{ $gsetting->project_title }}"
												    data-description=""
												    data-image="{{ asset('images/logo/'.$gsetting->logo) }}"
												    data-prefill.name="XYZ"
												    data-prefill.email="info@example.com"
												    data-theme.color="#F44A4A"
												></script>
		                            		</form>
		                            	</div>
							        </div>
							    </div>
							</div>
							@endif


							@if($gsetting->paytm_enable == 1)
							<div class="card">
	                            <div class="card-header" id="headingFour">
							        <div class="panel-title">
							            <label for='r17'>
							              <input type='radio' id='r17' name='occupation' value='Working' required />
							              <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"></a>
							              <img src="{{ url('images/payment/paytm.png') }}"  class="img-fluid" alt="course"> 
							            </label>
							        </div>
						    	</div>
							    <div id="collapseFour" class="panel-collapse collapse in">
							        <div class="card-body">
		                            	<div class="payment-proceed-btn">
		                            		<form method="post" action="{{ url('/paywithpayment') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
		                            			@csrf

										            <input type="hidden" name="user_id" value="{{Auth::User()->id}}"/>

										          
												    <div class="row">
											        <div class="col-md-12">
											            <div class="form-group">
											                <strong>{{ __('Name')}}</strong>
											                <input type="text" name="name" class="form-control" placeholder="{{ __('Enter Name')}}" value="{{Auth::User()->fname}}" required>
											            </div>
											        </div>
											        <div class="col-md-12">
											            <div class="form-group">
											                <strong>{{ __('Mobile Number')}}</strong>
											                <input type="text" name="mobile" class="form-control" placeholder="{{ __('Enter Mobile Number')}}" value="{{Auth::User()->mobile}}" required autocomplete="off">
											            </div>
											        </div>
											        <div class="col-md-12">
											            <div class="form-group">
											                <strong>{{ __('Email Id')}}</strong>
											                <input type="email" name="email" class="form-control" value="{{Auth::User()->email}}" placeholder="{{ __('Enter Email id')}}" required>
											            </div>
											        </div>
											        <div class="col-md-12">
											            <div class="form-group">
											                <input type="hidden" name="amount" class="form-control" placeholder="" value="{{ $mainpay }}" readonly="">
											            </div>
											        </div>
											        <div class="col-md-12">
											            <button class="btn btn-primary" title="checkout" type="submit">{{ __('Proceed') }}</button>
											        </div>
											    </div>
										          
											</form>
		                            	</div>
							        </div>
							    </div>
							</div>
							@endif

							@endif

                        </div>
	            	</div>
	            	
	            </div>
	        </div>
	    </div>
	</div>
</section>

@endsection

@section('custom-script')

<script src="{{ url('js/jquery.payform.min.js')}}" charset="utf-8"></script>
<script src="{{ url('js/script.js') }}"></script>

{{-- <script src="{{ url('js/jquery.min.js') }}"></script>   --}}

@stack('custom-script')

@if(config('bkash.ENABLE') == 1 && Module::has('Bkash') && Module::find('Bkash')->isEnabled())
  
    @include("bkash::front.bkashscript")
 
@endif

@if(env('MID_TRANS_ENABLE') == 1 && Module::has('Midtrains') && Module::find('Midtrains')->isEnabled())
  
    @include("midtrains::front.midtrans_script")
 
@endif



@endsection
