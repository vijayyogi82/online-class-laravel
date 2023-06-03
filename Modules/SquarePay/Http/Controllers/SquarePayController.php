<?php

namespace Modules\SquarePay\Http\Controllers;

use App\Http\Controllers\OrderStoreController;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Crypt;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Illuminate\Support\Str;
use Square\Environment;
use Square\SquareClient;
use Square\Exceptions\ApiException;
use Square\Http\ApiResponse;

class SquarePayController extends Controller
{
    /* This function save the api keys to .env file */

    public function saveKeys(Request $request){

        $env = DotenvEditor::setKeys([
            'SQUARE_PAY_ENABLE' => $request->SQUARE_PAY_ENABLE ? 1 : 0,
            'SQUARE_PAY_LOCATION_ID' => $request->SQUARE_PAY_LOCATION_ID,
            'SQUARE_ACCESS_TOKEN' => $request->SQUARE_ACCESS_TOKEN,
            'SQUARE_APPLICATION_ID' => $request->SQUARE_APPLICATION_ID
        ]);

        $env->save();

        notify()->success(__("SquarePay Keys has been updated successfully !"),'Success');

        return back();

    }

    public function payment(Request $request){
        
     

        $client = new SquareClient([
            'accessToken' => env('SQUARE_ACCESS_TOKEN'),
            'environment' => Environment::SANDBOX,
        ]);
          

        $amount_money = new \Square\Models\Money();
        $amount_money->setAmount(Crypt::decrypt(@$request->amount));
        
        $amount_money->setCurrency("USD");
        //  dd($amount_money);
        // $billing_address = new \Square\Models\Address();
        
        $body = new \Square\Models\CreatePaymentRequest(
            $request->sourceId,
            Str::uuid(),
            $amount_money
        );

        $body->setAutocomplete(false);
        $body->setAcceptPartialAuthorization(true);
        // $body->setBillingAddress($billing_address);
        
        $api_response = $client->getPaymentsApi()->createPayment($body);
        
        if ($api_response->isSuccess()) {
            return $result = $api_response->getResult();
        } else {
            return $errors = $api_response->getErrors();
        }

    }

    public function storepayment(Request $request){

        $txn_id = $request->txn_id;

        $payment_method = 'SQUAREPAY';

        $checkout = new OrderStoreController;

        return $checkout->orderstore($txn_id, $payment_method);

    }
}
