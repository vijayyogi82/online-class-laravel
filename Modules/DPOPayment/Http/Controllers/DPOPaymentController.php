<?php

namespace Modules\DPOPayment\Http\Controllers;


use App\FailedTranscations;
use App\Http\Controllers\OrderStoreController;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use SimpleXMLElement;
use Illuminate\Support\Str;
use App\Currency;


class DPOPaymentController extends Controller
{
    /**
     * Declaring public variables.
     */

    public $result;
    public $transToken;
    public $error;

    /**
     * All global variables which used in this controller only should declared in below function.
     */

    public function __construct()
    {
        $this->gatewayUrl = config('dpopayment.enable_sandbox') == 1 ? config('dpopayment.GATEWAY_URL_SANDBOX') : config('dpopayment.GATEWAY_URL_LIVE');
        $this->companyToken = config('dpopayment.COMPANY_TOKEN');
        $this->serviceType = config('dpopayment.SERVICE_TYPE');
    }

    /**
     * @return auth token to proccess the authorize transcation.
     */

    public function createToken(Request $request)
    {
    //return Crypt::decrypt($request->amount);
        define("REDIRECT_URL", url('/dpo/paymentsuccess'));
        define("BACK_URL", url('gotocheckout'));

        //$payout = strip_tags($request->amount);
        $payout = Crypt::decrypt($request->amount);
        $payout = round($payout, 2);

        /** Require price conversion file */

        

    
        /** Verifying the payment again in-case cart amount changed */

        
        
  
       
        $currency = Currency::where('default','1')->first();


        try {
            $type = '1';
            $email = auth()->user()->email;
            $firstName = auth()->user()->fname;
            $lastName = auth()->user()->lname;
            $amount = $payout;
            $phone = auth()->user()->mobile;
            $currency = $currency->code;
            $serviceDesc = trans('Payment for order ');

            if ($type == "1") {
                $CompanyRef = "<CompanyRef>" . uniqid() . "</CompanyRef>";
            } else if ($type == "2") {
                $CompanyRef = "<CompanyRef>" . uniqid() . "</CompanyRef>";
            }

            $input_xml = "<?xml version='1.0' encoding='utf-8'?>
                        <API3G>
                        <CompanyToken>" . $this->companyToken . "</CompanyToken>
                        <Request>createToken</Request>
                        <Transaction>
                        <customerEmail>" . $email . "</customerEmail>
                        <customerFirstName>" . $firstName . "</customerFirstName>
                        <customerLastName>" . $lastName . "</customerLastName>
                        <customerCity>Abidjan</customerCity>
                        <customerCountry>CI</customerCountry>
                        <customerPhone>" . $phone . "</customerPhone>
                        <EmailTransaction>1</EmailTransaction>
                        <PaymentAmount>" . $amount . "</PaymentAmount>
                        <PaymentCurrency>" . $currency . "</PaymentCurrency>
                        " . $CompanyRef . "
                        <RedirectURL>" . REDIRECT_URL . "</RedirectURL>
                        <BackURL>" . BACK_URL . "</BackURL>
                        <CompanyRefUnique>0</CompanyRefUnique>
                        <PTL>5</PTL>
                        </Transaction>
                        <Services>
                        <Service>
                            <ServiceType>" . $this->serviceType . "</ServiceType>
                            <ServiceDescription>" . $serviceDesc . "</ServiceDescription>
                            <ServiceDate>" . date("Y/m/d H:i") . "</ServiceDate>
                        </Service>
                        </Services>
                        </API3G>";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->gatewayUrl);
            curl_setopt($ch, CURLOPT_POSTFIELDS,
                $input_xml);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
            $data = curl_exec($ch);

            
            curl_close($ch);

            $oXML = new SimpleXMLElement($data);

            foreach ($oXML as $key => $value) {

                if (trim($key) == "Result") {
                    $this->result = $value;
                }

                if (trim($key) == "TransToken") {
                    $this->transToken = $value;
                }

                if(trim($key) == 'ResultExplanation'){
                    $this->error = $value;
                }

            }

            if(config('dpopayment.enable_sandbox') == 1){
               $url = secure_url('https://secure1.sandbox.directpay.online/');
            }else{
               $url = secure_url('https://secure.3gdirectpay.com/');
            }

            if (trim($this->result) == "000") {
                return redirect($url.'payv2.php?ID=' . $this->transToken, 301);
            } else {
                \Session::flash('delete', trans('flash.PaymentFailed'));
                return redirect('/');
            }
        } catch (\Exception $e) {
            \Session::flash('delete', trans('flash.PaymentFailed'));
            return redirect('/');
        }

    }

    /**
     * Payment capture and order placing process.
     */

    public function success(Request $request)
    {

        $txntoken = strip_tags($request->TransactionToken);
        $CompanyRef = strip_tags($request->CompanyRef);

        $input_xml = "<?xml version='1.0' encoding='utf-8'?>
		<API3G>
		<CompanyToken>" . $this->companyToken . "</CompanyToken>
		<Request>verifyToken</Request>
		<TransactionToken>" . $txntoken . "</TransactionToken>
		<CompanyRef>" . $CompanyRef . "</CompanyRef>
		</API3G>";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->gatewayUrl);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            $input_xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        $data = curl_exec($ch);
        curl_close($ch);

        $oXML = new SimpleXMLElement($data);

        foreach ($oXML as $key => $value) {

            if (trim($key) == "Result") {
                $this->result = $value;
            }

            if (trim($key) == "ResultExplanation") {
                $this->transToken = $value;
            }

        }

        if ($this->result == '000') {

            /* If payment success and paid */

            $txn_id = $request->TransID;

            $payment_method = 'DPOPAYMENT';

            $checkout = new OrderStoreController;

            return $checkout->orderstore($txn_id, $payment_method);


        } else {

            /** Logging the failed payment */

            \Session::flash('delete', trans('flash.PaymentFailed'));
            return redirect('/');
        }

    }

    

}
