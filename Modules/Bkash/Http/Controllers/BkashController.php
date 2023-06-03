<?php

namespace Modules\Bkash\Http\Controllers;

use App\FailedTranscations;
use App\Http\Controllers\OrderStoreController;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;


class BkashController extends Controller
{
    /**
     * All global variables which used in this controller only should declared in below function.
     */

    public function __construct()
    {
        $this->url = config('bkash.SANDBOX_ENABLED') == 1 ? config('bkash.SANDBOX_URL') : config('bkash.LIVE_URL');
        $this->username = config('bkash.BKASH_USER_NAME');
        $this->password = config('bkash.BKASH_PASSWORD');
        $this->appkey = config('bkash.BKASH_APP_KEY');
        $this->apppassword = config('bkash.BKASH_APP_SECRET');
    }

    /**
     * @return auth token to proccess the authorize transcation.
     */

    public function getToken()
    {

        $response = Http::withHeaders([
            'username' => $this->username,
            'password' => $this->password,
        ])->post($this->url . '/checkout/token/grant', [
            'app_key' => $this->appkey,
            'app_secret' => $this->apppassword,
        ]);

        if ($response->successful()) {

            $result = $response->json();

            session()->put('bkash_token', $result['id_token']);

            return $result['id_token'];

        } else {

            return response()->json(__('Token can\'t created'), 401);

        }

    }

    /**
     * Create payment and send payment request to bkash api
     */

    public function createPayment()
    {

        $payment = Http::withHeaders([
            'Authorization' => $this->getToken(),
            'X-APP-Key' => $this->appkey,
        ])->post($this->url . '/checkout/payment/create', [
            'amount' => 100,
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => uniqid(),
        ]);

        if ($payment->successful()) {
            return $payment->body();
        }
    }

    /**
     * Execute payment get payment response from bkash api.
     */

    public function executePayment(Request $request)
    {

        $payment = Http::withHeaders([
            'Content-Type:application/json',
            'Authorization' => session()->get('bkash_token'),
            'X-APP-Key' => $this->appkey,
        ])->post($this->url . '/checkout/payment/execute/' . $request->paymentID);

        if ($payment->successful()) {
            return $payment->body();
        }

    }

    /**
     * Get Transcation response on callback and prepare for order placing process.
     */

    public function success(Request $request)
    {

        /* Decoding the response */

        $result = json_decode($request->payment_details, true);

        if ($result['transactionStatus'] == 'Completed') {

            $txn_id = $result['paymentID'];

            $payment_status = __("yes");

            /* Placing new order */

            $payment_method = 'Bkash';

            $checkout = new OrderStoreController;

            return $checkout->orderstore($txn_id, $payment_method);

        } else {

            /** Logging failed transcation */

            \Session::flash('delete', trans('flash.PaymentFailed'));
            return redirect('/');

        }
    }


}
