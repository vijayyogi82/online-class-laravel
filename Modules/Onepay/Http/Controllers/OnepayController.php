<?php

namespace Modules\Onepay\Http\Controllers;

use App\Currency;
use App\FailedTranscations;
use App\Http\Controllers\OrderStoreController;
use App\Http\Controllers\PlaceOrderController;
use App\Http\Controllers\PreorderController;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class OnepayController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | OnepayController
    |--------------------------------------------------------------------------
    |
    | OnepayController all payment operation eg: Create Payment,
    | Fetch payment is done using this controller.
    |
     */

    /** This function is used to create payment.
     *
     * @param $order_id
     * @param $amount
     * @param $name
     * @param $email
     * @param $phone
     * @param $purpose
     * @param $error
     * 
     * @return RedirectResponse
     */

    public function dopayment(Request $request)
    {
        $default_currency = Currency::where('default','1')->first();

        $orderid = uniqid();

        session()->put('order_id', $orderid);

        session()->save();

        $appendAmp = 0;

       

        $vpcURL = config('onepay.payurl');

        $amount = $request->amount * 100;

        $amount = $amount . '00';

        $SECURE_SECRET = config('onepay.ONEPAY_SECURE_CODE'); //'6D0870CDE5F24F34F3915FB0045120D6';

        $stringHashData = "";

        $data = array(

            'Title'             => config('app.name'),
            'vpc_AccessCode'    => config('onepay.ONEPAY_ACCESS_CODE'), //'6BEB2566',
            'vpc_Amount'        => $amount,
            'vpc_Command'       => 'pay',
            'vpc_Currency'      => $default_currency->code,
            'vpc_Locale'        => app()->getLocale(),
            'vpc_MerchTxnRef'   => date('YmdHis') . rand(),
            'vpc_Merchant'      => config('onepay.ONEPAY_MERCHANT_ID'), //'TESTONEPAY23',
            'vpc_OrderInfo'     => __('Payment for order :order',['order' => $orderid]),
            'vpc_ReturnURL'     => url('/onepay/callback'),
            'vpc_TicketNo'      => request()->ip(),
            'vpc_Version'       => config('onepay.vpc_Version'),

        );

        foreach ($data as $key => $value) {

            // create the md5 input and URL leaving out any fields that have no value
            // tạo chuỗi đầu dữ liệu những tham số có dữ liệu
            if (strlen($value) > 0) {
                // this ensures the first paramter of the URL is preceded by the '?' char
                if ($appendAmp == 0) {
                    $vpcURL .= urlencode($key) . '=' . urlencode($value);
                    $appendAmp = 1;
                } else {
                    $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
                }
                //$stringHashData .= $value; *****************************sử dụng cả tên và giá trị tham số để mã hóa*****************************
                if ((strlen($value) > 0) && ((substr($key, 0, 4) == "vpc_") || (substr($key, 0, 5) == "user_"))) {
                    $stringHashData .= $key . "=" . $value . "&";
                }
            }
        }

        $stringHashData = rtrim($stringHashData, "&");

        if (strlen($SECURE_SECRET) > 0) {
            $vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*', $SECURE_SECRET)));
        }

        return redirect($vpcURL);
    }

    /** This function is used to capture payment and create order if payment success.
     *
     * @param $request
     * @return RedirectResponse
     */

    public function callback(Request $request)
    {

        
        if($_GET["vpc_TxnResponseCode"] !== '0'){
            return redirect('/gotocheckout')->with('delete',__("Payment failed or cancelled !"));
        }

        // Define Constants
        // ----------------
        // This is secret for encoding the MD5 hash
        // This secret will vary from merchant to merchant
        // To not create a secure hash, let SECURE_SECRET be an empty string - ""
        // $SECURE_SECRET = "secure-hash-secret";

        $SECURE_SECRET = config('onepay.ONEPAY_SECURE_CODE');

        // If there has been a merchant secret set then sort and loop through all the
        // data in the Virtual Payment Client response. While we have the data, we can
        // append all the fields that contain values (except the secure hash) so that
        // we can create a hash and validate it against the secure hash in the Virtual
        // Payment Client response.

        // NOTE: If the vpc_TxnResponseCode in not a single character then
        // there was a Virtual Payment Client error and we cannot accurately validate
        // the incoming data from the secure hash. */

        // get and remove the vpc_TxnResponseCode code from the response fields as we
        // do not want to include this field in the hash calculation
        $vpc_Txn_Secure_Hash = $_GET["vpc_SecureHash"];
        unset($_GET["vpc_SecureHash"]);

        // set a flag to indicate if hash has been validated
        $errorExists = false;

        ksort($_GET);

        if (strlen($SECURE_SECRET) > 0 && $_GET["vpc_TxnResponseCode"] != "7" && $_GET["vpc_TxnResponseCode"] != "No Value Returned") {

            //$stringHashData = $SECURE_SECRET;
            //*****************************khởi tạo chuỗi mã hóa rỗng*****************************
            $stringHashData = "";

            // sort all the incoming vpc response fields and leave out any with no value
            foreach ($_GET as $key => $value) {
                //        if ($key != "vpc_SecureHash" or strlen($value) > 0) {
                //            $stringHashData .= $value;
                //        }
                //      *****************************chỉ lấy các tham số bắt đầu bằng "vpc_" hoặc "user_" và khác trống và không phải chuỗi hash code trả về*****************************
                if ($key != "vpc_SecureHash" && (strlen($value) > 0) && ((substr($key, 0, 4) == "vpc_") || (substr($key, 0, 5) == "user_"))) {
                    $stringHashData .= $key . "=" . $value . "&";
                }
            }
            //  *****************************Xóa dấu & thừa cuối chuỗi dữ liệu*****************************
            $stringHashData = rtrim($stringHashData, "&");

            //    if (strtoupper ( $vpc_Txn_Secure_Hash ) == strtoupper ( md5 ( $stringHashData ) )) {
            //    *****************************Thay hàm tạo chuỗi mã hóa*****************************
            if (strtoupper($vpc_Txn_Secure_Hash) == strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*', $SECURE_SECRET)))) {
                // Secure Hash validation succeeded, add a data field to be displayed
                // later.
                $hashValidated = "CORRECT";
            } else {
                // Secure Hash validation failed, add a data field to be displayed
                // later.
                $hashValidated = "INVALID HASH";
            }
        } else {
            // Secure Hash was not validated, add a data field to be displayed later.
            $hashValidated = "INVALID HASH";
        }

        // Define Variables
        // ----------------
        // Extract the available receipt fields from the VPC Response
        // If not present then let the value be equal to 'No Value Returned'
        // Standard Receipt Data
        $amount = $this->null2unknown($_GET["vpc_Amount"]);
        $locale = $this->null2unknown($_GET["vpc_Locale"]);
        //$batchNo = null2unknown ( $_GET ["vpc_BatchNo"] );
        $command = $this->null2unknown($_GET["vpc_Command"]);
        //$message = null2unknown ( $_GET ["vpc_Message"] );
        $version = $this->null2unknown($_GET["vpc_Version"]);
        //$cardType = null2unknown ( $_GET ["vpc_Card"] );
        $orderInfo = $this->null2unknown($_GET["vpc_OrderInfo"]);
        //$receiptNo = null2unknown ( $_GET ["vpc_ReceiptNo"] );
        $merchantID = $this->null2unknown($_GET["vpc_Merchant"]);
        //$authorizeID = null2unknown ( $_GET ["vpc_AuthorizeId"] );
        $merchTxnRef = $this->null2unknown($_GET["vpc_MerchTxnRef"]);
        $transactionNo = $this->null2unknown($_GET["vpc_TransactionNo"]);
        //$acqResponseCode = null2unknown ( $_GET ["vpc_AcqResponseCode"] );
        $txnResponseCode = $this->null2unknown($_GET["vpc_TxnResponseCode"]);

        //  ----------------------------------------------------------------------------

        $transStatus = "";

        if ($hashValidated == "CORRECT" && $txnResponseCode == "0") {
            $transStatus = "Giao dịch thành công";
        } elseif ($hashValidated == "INVALID HASH" && $txnResponseCode == "0") {
            $transStatus = "Giao dịch Pendding";
        } else {
            $transStatus = "Giao dịch thất bại";
        }

        if ($transStatus == 'Giao dịch thành công') { // payment success

            $txn_id = $_GET["vpc_TransactionNo"];

            $payment_method = 'OnePay';

            $checkout = new OrderStoreController;

            return $checkout->orderstore($txn_id, $payment_method);

        } else {

            // Payment fail

            $message = $this->getResponseDescription($_GET["vpc_TxnResponseCode"]);

            return redirect('/gotocheckout')->with('delete',$message);
            

        }
    }

    
    /** This method uses the QSI Response code retrieved from the Digital
     * Receipt and returns an appropriate description for the QSI Response Code
     *
     * @param $responseCode String containing the QSI Response Code
     *
     * @return String containing the appropriate description
    */

    public function getResponseDescription($responseCode)
    {

        switch ($responseCode) {
            case "0":
                $result = "Giao dịch thành công - Approved";
                break;
            case "1":
                $result = "Ngân hàng từ chối giao dịch - Bank Declined";
                break;
            case "3":
                $result = "Mã đơn vị không tồn tại - Merchant not exist";
                break;
            case "4":
                $result = "Không đúng access code - Invalid access code";
                break;
            case "5":
                $result = "Số tiền không hợp lệ - Invalid amount";
                break;
            case "6":
                $result = "Mã tiền tệ không tồn tại - Invalid currency code";
                break;
            case "7":
                $result = "Lỗi không xác định - Unspecified Failure ";
                break;
            case "8":
                $result = "Số thẻ không đúng - Invalid card Number";
                break;
            case "9":
                $result = "Tên chủ thẻ không đúng - Invalid card name";
                break;
            case "10":
                $result = "Thẻ hết hạn/Thẻ bị khóa - Expired Card";
                break;
            case "11":
                $result = "Thẻ chưa đăng ký sử dụng dịch vụ - Card Not Registed Service(internet banking)";
                break;
            case "12":
                $result = "Ngày phát hành/Hết hạn không đúng - Invalid card date";
                break;
            case "13":
                $result = "Vượt quá hạn mức thanh toán - Exist Amount";
                break;
            case "21":
                $result = "Số tiền không đủ để thanh toán - Insufficient fund";
                break;
            case "99":
                $result = "Người sủ dụng hủy giao dịch - User cancel";
                break;
            default:
                $result = "Giao dịch thất bại - Failured";
        }
        return $result;
    }

    

    /** If input is null, returns string "No Value Returned", else returns input */

    public function null2unknown($data)
    {
        if ($data == "") {
            return "No Value Returned";
        } else {
            return $data;
        }
    }

    /** This function is used to update onepay payment settings in .env file
     *
     * @param $request
     * @return Response Boolean
     */

    public function updatesettings(Request $request)
    {

        $save = DotenvEditor::setKeys([
            'ONEPAY_ENABLE' => isset($request->ONEPAY_ENABLE) ? 1 : 0,
            'ONEPAY_ACCESS_CODE' => strip_tags($request->ONEPAY_ACCESS_CODE),
            'ONEPAY_SECURE_CODE' => strip_tags($request->ONEPAY_SECURE_CODE),
            'ONEPAY_MERCHANT_ID' => strip_tags($request->ONEPAY_MERCHANT_ID),

        ]);

        $save->save();

        
        return back()->with('success',trans('Payment settings updated'));

    }

}
