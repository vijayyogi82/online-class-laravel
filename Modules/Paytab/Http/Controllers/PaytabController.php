<?php

namespace Modules\Paytab\Http\Controllers;

use App\Address;
use App\FailedTranscations;
use App\Http\Controllers\OrderStoreController;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Illuminate\Support\Str;
use App\Currency;

class PaytabController extends Controller
{

    /* This function will create payment for paytab and redirect to paytab payment page url on successfull response*/

    public function payment(Request $request){


        $currency = Currency::where('default','1')->first();

        $response = Http::withHeaders([
            'Authorization' => config('paytab.PAYTAB_SERVER_KEY')
        ])->post('https://secure-global.paytabs.com/payment/request', [

            'profile_id' => config('paytab.PAYTAB_PROFILE_ID'),
            'tran_type' => 'sale',
            'tran_class' => 'ecom',
            'cart_id' => uniqid(),
            'cart_description' => __("Payment for order"),
            'cart_currency' => $currency->code,
            'cart_amount' => strip_tags($request->amount),
            'return' => route("paytabs.callback"),
            'callback' => route("paytabs.callback"),
            "customer_details" => 
            [
                "name"      => auth()->user()->fname,
                "email"     => auth()->user()->email,
                "phone"     => auth()->user()->mobile,
                "street1"   => strip_tags(auth()->user()->address) ?? '',
                "city"      => auth()->user()->state['name'] ?? '',
                "state"     => auth()->user()->state['name'] ?? '',
                "country"   => auth()->user()->country['name'] ?? '',
                "ip"        => $request->ip()
            ],
            "shipping_details" => 
            [
                "name"      =>  auth()->user()->fname,
                "email"     => auth()->user()->email,
                "phone"     => auth()->user()->mobile,
                "street1"   => strip_tags(auth()->user()->address),
                "city"      => auth()->user()->state['name'] ?? '',
                "state"     => auth()->user()->state['name'] ?? '',
                "country"   => auth()->user()->country['name'] ?? '',
                "ip"        => $request->ip()
            ]
        ]);

        if($response->successful()){
            
            $result =  $response->json();

            return  redirect($result['redirect_url']);

        }else{
            $result = $response->json();
            
            \Session::flash('delete', $result['message'],'Payment fail');
            return redirect('/');
        }
    }

    /** This function verify the signature and capture the transcation id and create new order */

    public function callback(Request $request){
      
        if ($request->respMessage == 'Authorised') {

            // Create order if payment is successful

            $txn_id = $request->tranRef;

            $payment_method = 'Paytabs';

            $checkout = new OrderStoreController;

            return $checkout->orderstore($txn_id, $payment_method);


        }else{
            
            \Session::flash('delete', trans('flash.PaymentFailed'));
            return redirect('/');
        }

    }
}
