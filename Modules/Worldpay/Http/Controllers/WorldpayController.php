<?php

namespace Modules\Worldpay\Http\Controllers;

use App\FailedTranscations;
use App\Http\Controllers\OrderStoreController;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use \Worldpay\Worldpay;
use Illuminate\Support\Str;
use \Worldpay\WorldpayException;

class WorldpayController extends Controller
{
    

    /** This function holds the payment proccess and create order after successful payment */

    public function payment(Request $request){

       

        // $address = Address::find(session()->get('address'));
        
        $worldpay = new Worldpay(config('worldpay.WORLDPAY_SECRET_KEY'));

        $billing_address = array(
            "address1"=> clean(auth::user()->address),
            "address2"=> '',
            "address3"=> '',
            "postalCode"=> auth::user()->pin_code,
            "city"=> auth::user()->city->name,
            "state"=> auth::user()->name,
            "countryCode"=>auth::user()->Country->iso,
        );

        try {
            
            $response = $worldpay->createOrder(array(
                'token' => $request->token,
                'amount' => clean($request->actualtotal * 100),
                'currencyCode' => session()->get('currency')['id'],
                'name' => auth()->user()->fname,
                'billingAddress' => $billing_address,
                'orderDescription' => 'Payment for order '.uniqid(),
                'customerOrderCode' => uniqid()
            ));

            if ($response['paymentStatus'] === 'SUCCESS') {

                // Create order if payment is successful

                $txn_id = $response['orderCode'];

                $payment_method = 'Worldpay';

                $checkout = new OrderStoreController;

                return $checkout->orderstore($txn_id, $payment_method);

            } else {

                // Logging the error if payment status comes different.

                \Session::flash('delete', trans('flash.PaymentFailed'));
                return redirect('/');
            }

        } catch (WorldpayException $e) {

            // Logging the exception if payment failed from worldpay status comes different.
            \Session::flash('delete', trans('flash.PaymentFailed'));
            return redirect('/');

        } catch (\Exception $e) {

            // Logging the exception if payment failed from logic side status comes different.

            \Session::flash('delete', trans('flash.PaymentFailed'));
            return redirect('/');
        }
            

    }
}
