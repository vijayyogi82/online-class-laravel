<?php

namespace Modules\Smanager\Services;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;

class sManagerService
{
    /**
     * initiatePayment
     * @param array $info
     * @return Application|RedirectResponse|Redirector
     */
    public static function initiatePayment(array $info)
    {

        $url = curl_init(env('SMANAGER_URL').'/v1/ecom-payment/initiate');
        try{
            $header = array(
                'client-id:'.env('SMANAGER_CLIENT_ID'),
                'client-secret:'.env('SMANAGER_CLIENT_SECRET'),
                'Accept: application/json'
            );
            curl_setopt($url, CURLOPT_HTTPHEADER, $header);
            curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($url, CURLOPT_POSTFIELDS, $info);
            curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
            $result = curl_exec($url);
            curl_close($url);
            $responseJSON = json_decode($result, true);
            $code    = $responseJSON['code'];
            $message = $responseJSON['message'];
            // return $responseJSON;

            if ($code !== 200) {
                return redirect(url('smanager/fail'));
            }
            return redirect(url($responseJSON['data']['link']));

        } catch (\Exception $ex) {
            return redirect(url('smanager/fail'));
        }
    }

    /**
     * paymentDetails
     * @param string $tran_id
     * @return Application|RedirectResponse|Redirector
     */
    public static function paymentDetails(string $tran_id)
    {
        $url = curl_init(env('SMANAGER_URL').'/v1/ecom-payment/details?transaction_id='.$tran_id);

        try{
            $header = array(
                'client-id:'.env('SMANAGER_CLIENT_ID'),
                'client-secret:'.env('SMANAGER_CLIENT_SECRET'),
                'Accept: application/json'
            );
            curl_setopt($url, CURLOPT_HTTPHEADER, $header);
            curl_setopt($url, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
            $result = curl_exec($url);
            curl_close($url);
            $responseJSON = json_decode($result, true);
            $code    = $responseJSON['code'];
            $message = $responseJSON['message'];



            return $responseJSON;

            if ($code !== 200) {
                return $message->error();
                return redirect(url('smanager/fail'));
            }

            return $responseJSON;

        } catch (\Exception $ex) {

            
            return Redirect::back()
                ->withErrors([$ex->getMessage()]);
        }
    }

}
