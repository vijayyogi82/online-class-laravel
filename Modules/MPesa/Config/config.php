<?php

/*
* Configuration file for mpesa payment.
*/

return [
    'name' => __('MPesa'),
    'ENABLE' => env('MPESA_ENABLE',0),
    'MPESA_COSUMER_KEY' => env('MPESA_COSUMER_KEY'),
    'MPESA_CONSUMER_SECRET' => env('MPESA_CONSUMER_SECRET'),
    'MPESA_SANDBOX' => env('MPESA_SANDBOX',1),
    'MPESA_SHORTCODE' => env('MPESA_SHORTCODE'),
    'MPESA_PASSKEY' => env('MPESA_PASSKEY')
];
