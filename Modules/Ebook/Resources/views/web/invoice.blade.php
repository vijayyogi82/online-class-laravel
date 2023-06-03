@extends('theme.master')
@section('title', 'Ebook-Invoice')
@section('content')
@include('admin.message')
@php
$gets = App\Breadcum::first();
@endphp
@if(isset($gets))
<section id="business-home" class="business-home-main-block">
    <div class="business-img">
        @if($gets['img'] !== NULL && $gets['img'] !== '')
        <img src="{{ url('/images/breadcum/'.$gets->img) }}" class="img-fluid" alt="" />
        @else
        <img src="{{ Avatar::create($gets->text)->toBase64() }}" alt="{{ __('course')}}" class="img-fluid">
        @endif
    </div>
    <div class="overlay-bg"></div>
    <div class="container-xl">
        <div class="business-dtl">
            <div class="row">
                <div class="col-lg-6">
                    <div class="bredcrumb-dtl">
                        <h1 class="wishlist-home-heading">{{ __('Ebooks Invoice') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<section id="my-ebook-invoice" class="my-ebook-invoice-main-block">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div id="printableArea" class="card m-b-30 my-ebook-invoice-block">
                    <div class="card-body">
                        <div class="invoice">
                            <div class="invoice-head">
                                <div class="row">
                                    <div class="col-12 col-md-7 col-lg-7">
                                        <div class="logo-invoice">
                                            <img src="{{url('images/logo/logo.png')}}" style="height:50px">
                                        </div>                    
                                    </div>
                                    <div class="col-12 col-md-5 col-lg-5">
                                        <div class="invoice-name">
                                            <h5 class="text-uppercase mb-3">Invoice</h5>
                                            <small>Date:&nbsp;{{date('d/M/Y', strtotime($order->created_at))}}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-billing">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 col-lg-4">
                                        <div class="invoice-address">
                                            <div class="mb-2">From:</div>
                                            <h5 class="mb-2">{{$order->user?$order->user->fname:''}} {{$order->user?$order->user->lname:''}}</h5>
                                            <ul class="list-unstyled">
                                                <li> {{$order->user?$order->user->address:''}}</li>  
                                                <li>{{$order->user?$order->user->mobile:''}}</li>  
                                                <li>{{$order->user?$order->user->email:''}}</li>  
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-4">
                                        <div class="invoice-address">
                                            <!-- <div class="mb-2">To:</div>
                                            <h5 class="mb-2">User</h5>
                                            <ul class="list-unstyled">
                                                <li>Address: <br></li>
                                                <li></li>
                                                <li></li>                                
                                            </ul> -->
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4 mt-3">
                                        <div class="invoice-order-info">
                                            <ul>
                                                <li><b>OrderID:</b> {{$order->order_id}}<br></li>
                                                @if($order->total_amount>0)
                                                <li><b>TransactionID:</b> {{$order->transaction_id}}<br></li>
                                                <li><b>PaymentMethod:</b> {{$order->payment_method}}<br></li>
                                                @endif                                                
                                                @if($order->total_amount>0)
                                                <li><b>Currency:</b> {{$order->currency}}</li>
                                                @endif
                                                <li><b>PaymentStatus:</b> Recieved<br></li>
                                                <li><b>Enrollon:</b> {{date('d/M/Y', strtotime($order->created_at))}}<br></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-summary">
                            <div class="table-responsive ">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Ebook</th>
                                            <th>Publication</th>
                                            <th>Amount</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$order->ebook->title}}</td>
                                            <td>{{$order->ebook->publication}}</td>
                                            @if($order->orignal_price=='00' && $order->total_amount=='00')
                                            <td>{{ __('Free') }}</td>
                                            <td>{{ __('Free') }}</td>
                                            @else
                                            <td>{{currency($order->orignal_price, $from = $order->currency, $to = $order->currency ? $order->currency : $order->currency, $format = true)}}</td>
                                            <td>{{currency($order->total_amount, $from = $order->currency, $to = $order->currency ? $order->currency : $order->currency, $format = true)}}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td><b>Grand Total</b></td>
                                            <td>
                                                <b>
                                                    @if($order->total_amount=='00')
                                                    {{ __('Free') }}
                                                    @else
                                                    {{currency($order->total_amount, $from = $order->currency, $to = $order->currency ? $order->currency : $order->currency, $format = true)}}
                                                    @endif
                                                </b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="invoice-footer mt-4">
                            <div class="invoice-footer-btn">
                                <a href="" onclick="printDiv('printableArea')" class="btn btn-primary py-2 font-16"><i class="feather icon-printer mr-2"></i>Print</a>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
@section('custom-script')
<script lang='javascript'>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
  }
</script>
@endsection