<?php

namespace Modules\Smanager\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Order;
use Modules\Smanager\Services\sManagerService;
use Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Http\Controllers\OrderStoreController;

class SmanagerController extends Controller
{
    /* This function will create payment for Smanager and redirect to Smanager payment page url on successfull response*/

    public function index(Request $request)
    {

        $order_id = uniqid();
        $post_data = array();
        $post_data['total_amount'] = $request->amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['transaction_id'] = uniqid('sM_', true); // tran_id must be unique
        $orderId = "orderId_".$order_id;

        $info = [
            'amount'          => $post_data['total_amount'],
            'transaction_id'  => $post_data['transaction_id'],
            'success_url'     => route('smanager.success'),  // success url
            'fail_url'        => route('smanager.fail'),  // failed url
            'customer_name'   => auth()->user()->fname,
            'purpose'         => 'onlinetransaction',
            'payment_details' => $orderId,
        ];
        session()->put('sM_transaction_id', $post_data['transaction_id']);

        return sManagerService::initiatePayment($info);
    }


    /** This function verify the signature and capture the transcation id and create new order */

    public function success(Request $request)
    {

        $transactionId = session()->get('sM_transaction_id');


        $responseJSON = sManagerService::paymentDetails($transactionId);

        if($responseJSON['data']['payment_status'] !== 'completed')
        {
            \Session::flash('delete', trans('flash.PaymentFailed'));
            return redirect('/');
        }

        $txn_id = $transactionId;

        $payment_method = 'Smanager';

        $checkout = new OrderStoreController;

        return $checkout->orderstore($txn_id, $payment_method);


        $request->session()->forget('order_id');
        $request->session()->forget('payment_data');
        $request->session()->forget('sM_transaction_id');
        
    }

    /** This function handle failed transcation form Paytab payment */

    public function fail(Request $request)
    {

        $request->session()->forget('order_id');
        $request->session()->forget('payment_data');
        $request->session()->forget('sM_transaction_id');

        \Session::flash('delete', trans('flash.PaymentFailed'));
            return redirect('/');
    }


    /** This function handle cancelled transcation form Paytab payment */

    public function cancel(Request $request)
    {
        $request->session()->forget('order_id');
        $request->session()->forget('payment_data');
        $request->session()->forget('sM_transaction_id');

        \Session::flash('delete', 'Payment cancelled');
            return redirect('/');
    }
}
