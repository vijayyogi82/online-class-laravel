<?php

namespace Modules\AuthorizeNet\Http\Controllers;

use App\FailedTranscations;
use App\Http\Controllers\OrderStoreController;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class AuthorizeNetController extends Controller
{
    
    public $api_login_id;
    public $transcation_key;

    /** @return payment key settings */

    public function __construct()
    {
        $this->api_login_id = env('API_LOGIN_ID');
        $this->transcation_key = env('TRANSCATION_KEY');
    }


    /** @return check payment */

    public function payment(Request $request)
    {
      
        // Common setup for API credentials
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(config('authorizenet.API_LOGIN_ID'));
        $merchantAuthentication->setTransactionKey(config('authorizenet.TRANSCATION_KEY'));
        $refId = 'ref' . time();
        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber(str_replace(' ','',$request->number));
        // $creditCard->setExpirationDate( "2038-12");
        $expiry = explode('/', $request->expiry);

        $expiry = $expiry[1].'-'.$expiry[0];

        $creditCard->setExpirationDate(str_replace(" ",'',$expiry));
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);
        // Create a transaction
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount(100);
        $transactionRequestType->setPayment($paymentOne);
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);
        $controller = new AnetController\CreateTransactionController($request);


        if(env("AUTHORIZE_NET_MODE") === 'sandbox'){

            $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

        }else{

            $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
            
        }
       
        /** Final payment response and order proccess start */

        

        if ($response != null) {

            $tresponse = $response->getTransactionResponse();
            
            if (($tresponse != null) && ($tresponse->getResponseCode() == "1")) {
                   
                    /* Placing new order */

                    $txn_id = $tresponse->getTransId();

                    $payment_method = 'AUTHORIZE.NET';

                    $checkout = new OrderStoreController;

                    return $checkout->orderstore($txn_id, $payment_method);


            } else {

                \Log::error('Authorize Payment Error: Charge Credit Card ERROR :  Invalid response');

                \Session::flash('delete', trans('flash.PaymentFailed'));
                return redirect('/');

            }
        } else {

            \Session::flash('delete', trans('flash.PaymentFailed'));
            return redirect('/');

        }
        
    }

}
