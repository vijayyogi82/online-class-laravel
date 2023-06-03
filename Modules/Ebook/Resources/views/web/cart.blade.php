@extends('theme.master')
@section('title', 'Cart')
@section('content')
@include('admin.message')

<!-- about-home start -->
@php
$gets = App\Breadcum::first();
@endphp
@if(isset($gets))
<section id="business-home" class="business-home-main-block">
    <div class="business-img">
        @if($gets['img'] !== NULL && $gets['img'] !== '')
        <img src="{{ url('/images/breadcum/'.$gets->img) }}" class="img-fluid" alt="" />
        @else
        <img src="{{ Avatar::create($gets->text)->toBase64() }}" alt="course" class="img-fluid">
        @endif
    </div>
    <div class="overlay-bg"></div>
    <div class="container-xl">
        <div class="business-dtl">
            <div class="row">
                <div class="col-lg-6">
                    <div class="bredcrumb-dtl">
                        <h1 class="wishlist-home-heading">{{ __('Shopping Cart') }}</h1>
                    </div>
                </div>
				<div class="col-lg-6">
                    <div class="ebook-back-btn">
                        <a href="{{url('web/ebook')}}" type="button" class="btn btn-primary" title="">Back <i data-feather="chevron-right"></i></a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- about-home end -->
<section id="cart-block" class="cart-main-block">
	<div class="container-xl">
		<div class="cart-items btm-30">
			<h4 class="cart-heading">
        		@php       			

                    if(count($carts)>0){

                        echo count($carts);
                    }
                    $price_total = 0;
                    $offer_total = 0;
                @endphp
            	@if(count($carts)>0)
            	{{ __('Ebooks in Cart') }}
				@endif
            </h4>
            @if(count($carts)>0)
		        <div class="row">
		            <div class="col-lg-9 col-md-9">
	        			@foreach($carts as $cart)
		    				<div class="cart-add-block">
			                    <div class="row">
			                        <div class="col-lg-3 col-sm-6 col-5">
			                            <div class="cart-img">
                                            @if($cart->ebook->thumbnali !== NULL && $cart->ebook->thumbnali !== '')
                                                <a href="{{ url('web/ebook/detail/'.$cart->ebook->id) }}"><img src="{{ asset('images/ebook/'.$cart->ebook->thumbnali) }}" class="img-fluid" alt="blog"></a>
                                            @else
                                                <a href="{{ url('web/ebook/detail/'.$cart->ebook->id) }}"><img src="{{ Avatar::create($cart->ebook->title)->toBase64() }}" class="img-fluid" alt="blog"></a>
                                            @endif
			                            </div>
			                        </div>
			                        <div class="col-lg-5 col-sm-6 col-6">
			                        	<div class="cart-course-detail">
                                            <div class="cart-course-name"><a href="{{ url('web/ebook/detail/'.$cart->ebook->id) }}">{{$cart->ebook->title}}</a></div>
                                            <div class="cart-course-update">{{$cart->ebook->user_id?$cart->ebook->user->fname:''}} {{$cart->ebook->user_id?$cart->ebook->user->lname:''}}</div>
				                        </div>
			                        </div>
			                        <div class="col-lg-2 col-sm-6 col-6">
			                        	<div class="row float-right">
			                        		<div class="col-lg-10 col-10">
					                            <div class="cart-course-amount">
					                                <ul>
					                                	
			                                            @if($cart->ebook->discount_price > 0)
			                                            	<li>{{ activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :'' }}{{ price_format(  currency($cart->ebook->discount_price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false) )}}{{ activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :'' }}</li>
					                                    	<li><s>{{ activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :'' }}{{ price_format(   currency($cart->ebook->price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false)) }}{{ activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :'' }}</s></li>
					                                    <?php
                                                            $price_total += $cart->ebook->price;
                                                            $offer_total += $cart->ebook->discount_price;
                                                        ?>
                                                        @else					                                    	
					                                    	<li>{{ __('Free') }}</li>
					                                    @endif
					                                    
					                                </ul>
					                            </div>
					                        </div>
					                        <div class="col-lg-2 col-2">
					                        	@if($cart->coupon == !NULL)
						                        	@if(Session::has('coupanapplied'))
						                            <div class="cart-coupon">
				                    					<a href="" class="btn btn-link top" data-toggle="tooltip" data-placement="top" title="{{Session::get('coupanapplied')['msg']}}"><i class="fa fa-tag"></i></a>
				                    				</div>
				                    				@endif
				                    			@endif
			                    			</div>
	                    				</div>
			                        </div>
                                    <div class="col-lg-2 col-sm-6 col-6">
			                            <div class="cart-actions float-right">
											<!-- <a href="{{ url('remove/cart/item/'.$cart->id) }}">
												<span>
												<i title="Delete" class="text-primary feather icon-trash"></i>
												</span>	
											</a>										 -->
			                            </div>
			                        </div>
			                    </div>
		                	</div>
	                    @endforeach
		            </div>
	                <div class="col-lg-3 col-md-3">
	                	@if(count($carts)>0)
		                	<div class="cart-total">

			                    <div class="cart-price-detail">
			                		<h4 class="cart-heading">{{ __('Total') }}:</h4>
			                		<ul>
			                			
			                            <li>{{ __('Total Price') }}<span class="categories-count">{{ activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :'' }} {{ price_format(  currency($price_total, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false)) }}{{ activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :'' }}</span></li>

			                            <li>{{ __('Offer Price') }}<span class="categories-count">&nbsp;{{ activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :'' }} {{ price_format(  currency($offer_total, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false)) }}{{ activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :'' }}</span></li>
			                            
			                            

			                            <li>{{ __('Coupon Discount') }}
			                            	@if( $coupon == !NULL)
			                            		<span class="categories-count">-&nbsp;{{ currency($cpn_discount, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = true) }}  </span>
			                            	@else
			                            		<span class="categories-count"><a href="#" data-toggle="modal" data-target="#myModalCoupon" title="report">{{ __('ApplyCoupon') }}</a></span>
			                            	@endif
			                            </li>
			                            
			                            <hr>
			                            
			                            <li class="cart-total-two"><b>{{ __('Total') }}:<span class="categories-count">{{ activeCurrency()->getData()->position == 'l'  ? activeCurrency()->getData()->symbol :'' }} {{ price_format( currency($offer_total, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false)) }}{{ activeCurrency()->getData()->position == 'r'  ? activeCurrency()->getData()->symbol :'' }}</b></span></li>
			                            
			                		</ul>
			                	</div>


			                    <div class="course-rate">
			                        
			                        
			                        <div class="checkout-btn">

			                        	@if(round($offer_total) == 0)

			                        		<a href="{{url('web/ebook/free/enroll',$carts[0]->ebook_id)}}" class="btn btn-primary" title="Enroll Now">{{ __('Enroll Now') }}</a>

			                     		@else


				                     		@if(auth::check())
				    	                      
                                                <form method="Post" action="{{url('web/ebook/checkout')}}" class="form-horizontal form-label-left">
                                                    @csrf
                                                    <input type="hidden" name="price_total" value="{{$price_total}}">
                                                    <input type="hidden" name="offer_total" value="{{$offer_total}}">
                                                    <button class="btn btn-primary" title="checkout" type="submit">{{ __('Checkout') }}</button>
                                                </form>
				    	                    @else
				                        		
				                        		<a href="{{url('guest/register')}}" class="btn btn-primary" title="checkout" type="submit">{{ __('Checkout') }}</a>
				                        	@endif



			                     		@endif

			                        	
			    	                    
			                    	</div>
			                    </div>
								<hr>
								@auth
								<div class="coupon-apply">
									<form id="cart-form" method="post" action="{{url('apply/coupon')}}" 
										data-parsley-validate class="form-horizontal form-label-left">
										{{ csrf_field() }}

										<div class="row no-gutters">
											<div class="col-lg-9 col-9">
												<input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
												<input type="text" name="coupon" value="" placeholder="Enter Coupon" />
											</div>
											<div class="col-lg-3 col-3">
												<button data-purpose="coupon-submit" type="submit" class="btn btn-primary"><span>{{ __('Apply') }}</span></button>
											</div>
										</div>
									</form>
								</div>
								@endauth

								@if(Session::has('fail'))
									<div class="alert alert-danger alert-dismissible fade show">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										{{ Session::get('fail') }}
									</div>
								@endif
								@if(Session::has('coupanapplied'))
									<form id="demo-form2" method="post" action="{{ route('remove.coupon', Session::get('coupanapplied')['cpnid']) }}">
										{{ csrf_field() }}
											
										<div class="remove-coupon">
										<button type="submit" class="btn btn-primary" title="Remove Coupon"><i class="fa fa-times icon-4x" aria-hidden="true"></i></button>
										</div>
									</form>
									<div class="coupon-code">   
										{{Session::get('coupanapplied')['msg']}}
									</div>
								@endif
								
							</div>
		                @endif
	                </div>
		        </div>
		    @else
		    	<div class="cart-no-result">
		    		<i class="fa fa-shopping-cart"></i>
			    	<div class="no-result-courses btm-10">{{ __('cart empty') }}</div>
			    	<div class="recommendation-btn text-white text-center">
		                <a href="{{ url('web/ebook') }}" class="btn btn-primary" title="Keep Shopping"><b>{{ __('Keep Shopping') }}</b></a>
		            </div> 
				</div>
		    @endif
	    </div>
	</div>

	<!--Model start-->
	@auth
	<div class="modal fade" id="myModalCoupon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	    <div class="modal-dialog modal-md" role="document">
	      <div class="modal-content">
	        <div class="modal-header">
	          <h4 class="modal-title" id="myModalLabel">{{ __('Coupon Code') }}</h4>
	          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        </div>
	        <div class="box box-primary">
	          <div class="panel panel-sum">
	            <div class="modal-body">
	            	<div class="coupon-apply">
						<form id="cart-form" method="post" action="{{url('apply/coupon')}}" 
	                    	data-parsley-validate class="form-horizontal form-label-left">
	                        {{ csrf_field() }}
	                        
		                	<div class="row no-gutters">
		                		<div class="col-lg-9 col-9">
		                			<input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />
	                    			<input type="text" name="coupon" value="" placeholder="Enter Coupon" />
	                    		</div>
	                    		<div class="col-lg-3 col-3">
	                    			<button data-purpose="coupon-submit" type="submit" class="btn btn-primary"><span>{{ __('Apply') }}</span></button>
	                    		</div>
	                    	</div>
	                    </form>
	                </div>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div> 
	</div>
	@endauth
	<!--Model close -->
</section>


@endsection