<?php

namespace Modules\MPesa\Http\Controllers;

use App\FailedTranscations;
use App\Http\Controllers\PlaceOrderController;
use Crypt;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Modules\MPesa\Models\MPesa;
use Illuminate\Http\Response;
use Log;
use Session;
use DB;
use Auth;
use App\Cart;
use App\Wishlist;
use App\Order;
use App\Currency;
use App\Mail\SendOrderMail;
use App\Notifications\UserEnroll;
use App\Course;
use App\User;
use Notification;
use Carbon\Carbon;
use App\InstructorSetting;
use App\PendingPayout;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Mail as FacadesMail;
use App\Mail\AdminMailOnOrder;
use TwilioMsg;
use App\Setting;

class MPesaController extends Controller
{

    /**
     * Update the mpesa keys in .env file using this function.
     */

    public function updatesettings(Request $request)
    {

        $save = DotenvEditor::setKeys([
            'MPESA_CONSUMER_SECRET' => strip_tags($request->MPESA_CONSUMER_SECRET),
            'MPESA_COSUMER_KEY' => strip_tags($request->MPESA_COSUMER_KEY),
            'MPESA_ENABLE' => isset($request->MPESA_ENABLE) ? 1 : 0,
            'MPESA_SANDBOX' => isset($request->MPESA_SANDBOX) ? 1 : 0,
            'MPESA_SHORTCODE' => strip_tags($request->MPESA_SHORTCODE),
            'MPESA_PASSKEY' => strip_tags($request->MPESA_PASSKEY),
        ]);

        $this->registerurl($request);

        $save->save();

        return back()->with('success','MPesa settings updated successfully !');

    }

    /**
     * @return mpesa auth token to proccess the authorize transcation.
     */

    public function token()
    {

        $credentials = base64_encode(env('MPESA_COSUMER_KEY') . ':' . env('MPESA_CONSUMER_SECRET'));

        if (config('mpesa.MPESA_SANDBOX') == 1) {
            $tokenurl = secure_url('https://sandbox.safaricom.co.ke/oauth/v1/generate');
        } else {
            $tokenurl = secure_url('https://safaricom.co.ke/oauth/v1/generate');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $credentials,
        ])->get($tokenurl, [
            'grant_type' => 'client_credentials',
        ]);

        if ($response->successful()) {

            $result = $response->json();

            return $result['access_token'];

        }

    }

    /**
     * @return response register URL for Mpesa.
     */

    public function registerurl($request)
    {

        if (config('mpesa.MPESA_SANDBOX') == 1) {
            $url = secure_url('https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl');
        } else {
            $url = secure_url('https://safaricom.co.ke/mpesa/c2b/v1/registerurl');
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $this->token())); //setting custom header

        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'ShortCode' => strip_tags($request->MPESA_SHORTCODE),
            'ResponseType' => ' ',
            'ConfirmationURL' => url('api/m/confirm'),
            'ValidationURL' => url('/api/m/validate'),
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);

        return $curl_response;

    }

    /**
     * @return base64 encoded password for Mpesa password at time of payment.
     */

    public function lipaNaMpesaPassword()
    {
        $lipa_time = date('Ymdhis');
        $passkey = config('mpesa.MPESA_PASSKEY');
        $BusinessShortCode = config('mpesa.MPESA_SHORTCODE');
        $timestamp = $lipa_time;
        $lipa_na_mpesa_password = base64_encode($BusinessShortCode . $passkey . $timestamp);
        return $lipa_na_mpesa_password;
    }

    /**
     * This function will stk push for Mpesa once this hit user should able to see MPesa popup on thier phone.
     * Upon successfull STK push you will recieve 0 Response code and checkout Id in response.
     */

    public function pay(Request $request)
    {

        if (!str_starts_with($request->phoneno, '254')) {

            \Session::flash('success',trans('Invalid MPesa Phone no.'));
            return redirect('all/cart')->withInput();
        }

        

        if (config('mpesa.MPESA_SANDBOX') == 1) {
            $url = secure_url('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest');
        } else {
            $url = secure_url('https://safaricom.co.ke/mpesa/stkpush/v1/processrequest');
        }

        $amount = (float) Crypt::decrypt($request->amount);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $this->token())); //setting custom header

        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'BusinessShortCode' => config('mpesa.MPESA_SHORTCODE'),
            'Password' => $this->lipaNaMpesaPassword(),
            'Timestamp' => date('Ymdhis'),
            'TransactionType' => __("CustomerPayBillOnline"),
            'Amount' => round($amount),
            'PartyA' => strip_tags($request->phoneno),
            'PartyB' => config('mpesa.MPESA_SHORTCODE'),
            'PhoneNumber' => strip_tags($request->phoneno),
            'CallBackURL' => url('api/m/confirm'),
            'AccountReference' => trans('Payment for order'),
            'TransactionDesc' => trans('Payment for order'),
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $result = curl_exec($curl);

        $result = json_decode($result, true);

        if (isset($result['ResponseCode']) && $result['ResponseCode'] == 0) {
            $checkoutid = $result['CheckoutRequestID'];

            \Log::info(trans('Payment request sent...') . $checkoutid);

            /* Returning Waiting view file */

            return view('mpesa::front.await', compact('checkoutid'));

        } else {
            /* Inserting a fail payment log in failed_transcation table*/
            
            \Session::flash('delete', $result['errorMessage']);
            return redirect('all/cart')->withInput();
        }
    }

    /**
     * @return validation response and log in laravel.log file.
     */

    public function validation(Request $request)
    {
        \Log::debug($request->getContent());
    }

    public function confirm(Request $request)
    {

        $content = json_decode($request->getContent(), true);

        if ($content != null) {
            if ($content['Body']['stkCallback']['ResultCode'] == 0) {

                MPesa::create([
                    'checkoutid' => $content['Body']['stkCallback']['CheckoutRequestID'],
                    'rcode' => $content['Body']['stkCallback']['ResultCode'],
                    'rdesc' => $content['Body']['stkCallback']['ResultDesc'],
                    'txnid' => $content['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'],
                ]);

            } else {

                MPesa::create([
                    'checkoutid' => $content['Body']['stkCallback']['CheckoutRequestID'],
                    'rcode' => $content['Body']['stkCallback']['ResultCode'],
                    'rdesc' => $content['Body']['stkCallback']['ResultDesc'],
                    'txnid' => null,
                ]);

            }
        } else {
            /** Logging the corrupt transcation in laravel.log file */
            \Log::error(trans("Transcation is corrupted."));
            return trans("Transcation is corrupted.");

        }
    }

    /**
     * This function will hit and call from await.blade.php file to verify the payment.
     * Result code should be 0 for successfull transcation else it will treat as fail.
     */

    public function verifypay(Request $request, $checkoutid)
    {

        $result = MPesa::where('checkoutid', $checkoutid)->first();

        if ($request->ajax() && $result) {

            if ($result->rcode == 0) {
                $txn_id = $result->txnid;


                $gsettings = Setting::first();
                $currency = Currency::first();

                $carts = Cart::where('user_id', Auth::User()->id)->get();

                foreach ($carts as $cart) {
                    if ($cart->offer_price != 0) {
                        $pay_amount = $cart->offer_price;
                    } else {
                        $pay_amount = $cart->price;
                    }

                    if ($cart->disamount != 0 || $cart->disamount != null) {
                        $cpn_discount = $cart->disamount;
                    } else {
                        $cpn_discount = '';
                    }

                    $lastOrder = Order::orderBy('created_at', 'desc')->first();

                    if (!$lastOrder) {
                        // We get here if there is no order at all
                        // If there is no number set it to 0, which will be 1 at the end.
                        $number = 0;
                    } else {
                        $number = substr($lastOrder->order_id, 3);
                    }

                    if($cart->type == 1)
                    {
                        $bundle_id = $cart->bundle_id;
                        $bundle_course_id = $cart->bundle->course_id;
                        $course_id = NULL;
                        $duration = NULL;
                        $instructor_payout = 0;
                        $instructor_id = $cart->bundle->user_id;

                        if($cart->bundle->duration_type == "m")
                        {
                            
                            if($cart->bundle->duration != NULL && $cart->bundle->duration !='')
                            {
                                $days = $cart->bundle->duration * 30;
                                $todayDate = date('Y-m-d');
                                $expireDate = date("Y-m-d", strtotime("$todayDate +$days days"));
                            }
                            else{
                                $todayDate = NULL;
                                $expireDate = NULL;
                            }
                        }
                        else
                        {

                            if($cart->bundle->duration != NULL && $cart->bundle->duration !='')
                            {
                                $days = $cart->bundle->duration;
                                $todayDate = date('Y-m-d');
                                $expireDate = date("Y-m-d", strtotime("$todayDate +$days days"));
                            }
                            else{
                                $todayDate = NULL;
                                $expireDate = NULL;
                            }

                        }
                    }
                    else{

                        if($cart->courses->duration_type == "m")
                        {
                            
                            if($cart->courses->duration != NULL && $cart->courses->duration !='')
                            {
                                $days = $cart->courses->duration * 30;
                                $todayDate = date('Y-m-d');
                                $expireDate = date("Y-m-d", strtotime("$todayDate +$days days"));
                            }
                            else{
                                $todayDate = NULL;
                                $expireDate = NULL;
                            }
                        }
                        else
                        {

                            if($cart->courses->duration != NULL && $cart->courses->duration !='')
                            {
                                $days = $cart->courses->duration;
                                $todayDate = date('Y-m-d');
                                $expireDate = date("Y-m-d", strtotime("$todayDate +$days days"));
                            }
                            else{
                                $todayDate = NULL;
                                $expireDate = NULL;
                            }

                        }


                        $setting = InstructorSetting::first();


                        if($cart->courses->instructor_revenue != NULL)
                        {
                            $x_amount = $pay_amount * $cart->courses->instructor_revenue;
                            $instructor_payout = $x_amount / 100;
                        }
                        else
                        {

                            if(isset($setting))
                            {
                                if($cart->courses->user->role == "instructor")
                                {
                                    $x_amount = $pay_amount * $setting->instructor_revenue;
                                    $instructor_payout = $x_amount / 100;
                                }
                                else
                                {
                                    $instructor_payout = 0;
                                }
                                
                            }
                            else
                            {
                                $instructor_payout = 0;
                            }  
                        }

                        

                        $bundle_id = NULL;
                        $course_id = $cart->course_id;
                        $bundle_course_id = NULL;
                        $duration = $cart->courses->duration;
                        $instructor_id = $cart->courses->user_id;
                    }


                    $created_order = Order::create([
                        'course_id' => $course_id,
                        'user_id' => Auth::User()->id,
                        'instructor_id' => $instructor_id,
                        'order_id' => '#' . sprintf("%08d", intval($number) + 1),
                        'transaction_id' => $txn_id,
                        'payment_method' => 'MPesa',
                        'total_amount' => $pay_amount,
                        'coupon_discount' => $cpn_discount,
                        'currency' => $currency->currency,
                        'currency_icon' => $currency->icon,
                        'duration' => $duration,
                        'enroll_start' => $todayDate,
                        'enroll_expire' => $expireDate,
                        'bundle_id' => $bundle_id,
                        'bundle_course_id' => $bundle_course_id,
                        'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    ]
                    );

                    Wishlist::where('user_id', Auth::User()->id)->where('course_id', $cart->course_id)->delete();

                    Cart::where('user_id', Auth::User()->id)->delete();

                    if ($instructor_payout != 0) {
                        if ($created_order) {

                            if ($cart->type == 0) {

                                if ($cart->courses->user->role == "instructor") {

                                    $created_payout = PendingPayout::create([
                                        'user_id' => $cart->courses->user_id,
                                        'course_id' => $cart->course_id,
                                        'order_id' => $created_order->id,
                                        'transaction_id' => $txn_id,
                                        'total_amount' => $pay_amount,
                                        'currency' => $currency->currency,
                                        'currency_icon' => $currency->icon,
                                        'instructor_revenue' => $instructor_payout,
                                        'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                                        'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                                    ]
                                    );
                                }
                            }

                        }
                    }

                    if($created_order){
                        if ($gsettings->twilio_enable == '1') {

                            try{
                                $recipients = Auth::user()->mobile;
                                
                
                                $msg = 'Hey'. ' ' .Auth::user()->fname . ' '.
                                        'You\'r successfully enrolled in '. $cart->courses->title .
                                        'Thanks'. ' ' . config('app.name');
                            
                                TwilioMsg::sendMessage($msg, $recipients);

                            }catch(\Exception $e){
                                
                            }

                        }
                    }


                    if ($created_order) {
                        try {

                            /*sending email*/
                            $x = 'You are successfully enrolled in a course';
                            $order = $created_order;
                            FacadesMail::to(FacadesAuth::User()->email)->send(new SendOrderMail($x, $order));

                            /*sending admin email*/
                                $x = 'User Enrolled in course '. $cart->courses->title;
                                $order = $created_order;
                                Mail::to($cart->courses->user->email)->send(new AdminMailOnOrder($x, $order));

                        } catch (\Swift_TransportException $e) {
                            Session::flash('deleted', 'Payment Successfully ! but Invoice will not sent because of error in mail configuration !');
                            return redirect('/');
                        }
                    }

                    if ($cart->type == 0) {

                        if ($created_order) {
                            // Notification when user enroll
                            $cor = Course::where('id', $cart->course_id)->first();

                            $course = [
                                'title' => $cor->title,
                                'image' => $cor->preview_image,
                            ];

                            $enroll = Order::where('course_id', $cart->course_id)->get();

                            if (!$enroll->isEmpty()) {
                                foreach ($enroll as $enrol) {
                                    $user = User::where('id', $enrol->user_id)->get();
                                    Notification::send($user, new UserEnroll($course));
                                }
                            }
                        }
                    }
                }

                return response()->json([
                    'resultCode' => $result->rcode,
                    'msg' => $result->rdesc,
                    'order_id' =>  $created_order->order_id,
                ]);

            } else {

                return response()->json([
                    'resultCode' => $result->rcode,
                    'msg' => $result->rdesc,
                ]);

            }

        }

    }


    public function adminsettings(){
        return view('mpesa::admin.mpesasettings');
    }

}
