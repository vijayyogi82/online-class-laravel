<?php

namespace Modules\Esewa\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Session;
use Redirect;
use DB;
use Auth;
use App\Cart;
use App\Wishlist;
use App\Order;
use App\Currency;
use Mail;
use App\Mail\SendOrderMail;
use App\Notifications\UserEnroll;
use App\Course;
use App\User;
use Notification;
use Carbon\Carbon;
use App\InstructorSetting;
use App\PendingPayout;
use App\Mail\AdminMailOnOrder;
use TwilioMsg;
use App\Setting;
use App\Http\Controllers\OrderStoreController;

class EsewaController extends Controller
{
    /**
     * This function will used to verify the payment.
     * If result is successfull it process to confirmation page else it will treat as fail.
     */

    public function success(Request $request)
    {

       
        if( isset($request->oid) && isset($request->amt) && isset($request->refId))
        {
            
            if(env('ESEWA_MODE') == 'SANDBOX')
            {
                $url = "https://uat.esewa.com.np/epay/transrec";   
            }
            else{

                $url = "https://merchant.esewa.com.np/epay/transrec";

            }

            $carts = Cart::where('user_id',Auth::User()->id)->get();
               
            $pay_amount = 0;
               
            foreach($carts as $cart)
            { 
                
                if ($cart->offer_price != 0)
                {
                    $pay_amount = $pay_amount + $cart->offer_price;
                }
                else
                {
                    $offer_total = $pay_amount + $cart->price;
                }
            }

            

            $data =[
                'amt'       => $pay_amount,
                'pdc'       =>  0,
                'psc'       =>  0,
                'tAmt'      => $pay_amount,
                'rid'       => $request->refId,
                'pid'       => $request->oid,
                'scd'       => env('ESEWA_MERCHANT_ID'),
                'su'        =>  route('esewa.success',[ 'q' => 'su']),
                'fu'        =>  route('esewa.fail',['q' => 'fu']) 
            ];

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);



            $response_code = $this->get_xml_node_value('response_code',$response );
            

            if( trim($response_code) == 'Success')
            {
                

                $gsettings = Setting::first();

                $current_date = Carbon::now();

                $currency = Currency::first();
                
                $carts = Cart::where('user_id',Auth::User()->id)->get();
               
                foreach($carts as $cart)
                { 
                    if ($cart->offer_price != 0)
                    {
                        $pay_amount =  $cart->offer_price;
                    }
                    else
                    {
                        $pay_amount =  $cart->price;
                    }

                    if ($cart->disamount != 0 || $cart->disamount != NULL)
                    {
                        $cpn_discount =  $cart->disamount;
                    }
                    else
                    {
                        $cpn_discount =  '';
                    }


                    $lastOrder = Order::orderBy('created_at', 'desc')->first();

                    if ( ! $lastOrder )
                    {
                        // We get here if there is no order at all
                        // If there is no number set it to 0, which will be 1 at the end.
                        $number = 0;
                    }
                    else
                    { 
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
                        'transaction_id' => $request->refId,
                        'payment_method' => 'Esewa',
                        'total_amount' => $pay_amount,
                        'coupon_discount' => $cpn_discount,
                        'currency' => $currency->currency,
                        'currency_icon' => $currency->icon,
                        'duration' => $duration,
                        'enroll_start' => $todayDate,
                        'enroll_expire' => $expireDate,
                        'instructor_revenue' => $instructor_payout,
                        'bundle_id' => $bundle_id,
                        'bundle_course_id' => $bundle_course_id,
                        'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
                        ]
                    );
                    
                    Wishlist::where('user_id',Auth::User()->id)->where('course_id', $cart->course_id)->delete();

                    Cart::where('user_id',Auth::User()->id)->delete();


                    if($instructor_payout != 0)
                    {
                        if($created_order)
                        {
                            if($cart->type == 0)
                            {
                                if($cart->courses->user->role == "instructor")
                                {
                                    $created_payout = PendingPayout::create([
                                        'user_id' => $cart->courses->user_id,
                                        'course_id' => $cart->course_id,
                                        'order_id' => $created_order->id,
                                        'transaction_id' => $request->refId,
                                        'total_amount' => $pay_amount,
                                        'currency' => $currency->currency,
                                        'currency_icon' => $currency->icon,
                                        'instructor_revenue' => $instructor_payout,
                                        'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
                                        'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
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
                    


                    if($created_order){
                        if (env('MAIL_USERNAME')!=null) {
                            try{
                                
                                /*sending user email*/
                                $x = 'You are successfully enrolled in a course';
                                $order = $created_order;
                                Mail::to(Auth::User()->email)->send(new SendOrderMail($x, $order));


                                /*sending admin email*/
                                $x = 'User Enrolled in course '. $cart->courses->title;
                                $order = $created_order;
                                Mail::to($cart->courses->user->email)->send(new AdminMailOnOrder($x, $order));


                            }catch(\Swift_TransportException $e){
                                
                            }

                        }
                    }

                    if($cart->type == 0)
                    {

                        if($created_order){
                            // Notification when user enroll
                            $cor = Course::where('id', $cart->course_id)->first();

                            $course = [
                              'title' => $cor->title,
                              'image' => $cor->preview_image,
                            ];

                            $enroll = Order::where('course_id', $cart->course_id)->get();

                            if(!$enroll->isEmpty())
                            {
                                foreach($enroll as $enrol)
                                {
                                    $user = User::where('id', $enrol->user_id)->get();
                                    Notification::send($user,new UserEnroll($course));
                                }
                            }
                        }

                    }
                   
                }

               
                return redirect('confirmation');

               
            }
            else{
                

                \Session::flash('delete', trans('flash.PaymentFailed'));
                return redirect('/');

            }
            
        
        }

    }

    /* If payment status is failed it will return payment failed message*/

    public function fail(Request $request){

        \Session::flash('delete', trans('flash.PaymentFailed'));
        return redirect('/');
    }

    /* This function will vefify payment from payment page server*/

    public function get_xml_node_value($node, $xml) {

        if ($xml == false) {
            return false;
        }

        $found = preg_match('#<'.$node.'(?:\s+[^>]+)?>(.*?)'.
                '</'.$node.'>#s', $xml, $matches);

        if ($found != false) {
            
            return $matches[1]; 
             
        }     

        return false;
    }

    
}
