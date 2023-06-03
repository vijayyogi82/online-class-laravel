<?php

namespace Modules\Midtrains\Http\Controllers;

use App\Address;
use App\FailedTranscations;
use App\Http\Controllers\OrderStoreController;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Modules\Midtrains\Veritrans\Midtrans;
use Illuminate\Support\Str;

class MidtrainsController extends Controller
{

    public function __construct()
    {
        Midtrans::$serverKey = config('midtrains.MID_TRANS_SERVER_KEY');

        Midtrans::$isProduction = config('midtrains.MID_TRANS_MODE') == 'sandbox' ? false : true;

    }

    /** This function holds proccess of token*/

    public function token(Request $request)
    {
        $midtrans = new Midtrans;
        
        $transaction_details = array(
            'order_id' => uniqid(),
            'gross_amount' => strip_tags(round(Crypt::decrypt($request->amount))),
        );

        // Populate items
        $items = [
            array(
                'id' => 'item1',
                'price' => strip_tags(round(Crypt::decrypt($request->amount))),
                'quantity' => 1,
                'name' => auth()->user()->fname,
            ),
        ];

       

        // Populate customer's Info
        $customer_details = array(
            'first_name' => auth()->user()->fname,
            'last_name' => auth()->user()->lname,
            'email' => auth()->user()->email,
            'phone' => auth()->user()->mobile,
            'billing_address' => '',
            'shipping_address' => '',
        );

        // Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O", $time),
            'unit' => 'hour',
            'duration' => 2,
        );

        $transaction_data = array(
            'transaction_details' => $transaction_details,
            'item_details' => $items,
            'customer_details' => $customer_details,
            'credit_card' => $credit_card,
            'expiry' => $custom_expiry,
        );

        try
        {
            $snap_token = $midtrans->getSnapToken($transaction_data);
            //return redirect($vtweb_url);
            return $snap_token;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /** This function holds the payment success and create order proccess */
    public function payment(Request $request)
    {
        $result = $request->input('result_data');

        $result = json_decode($result);
       
        if($result->status_code == 200){

            /** Capture the success transcation and place order */
            $txn_id = $result->transaction_id;

            $payment_method = 'Midtrans';

            $checkout = new OrderStoreController;

            return $checkout->orderstore($txn_id, $payment_method);


        }else{

            /** Logging the failed transcation */
            \Session::flash('delete', trans('flash.PaymentFailed'));
            return redirect('/');

        }
    }

   
}
