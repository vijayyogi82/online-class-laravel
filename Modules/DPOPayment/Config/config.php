<?php

/*
* Configuration file for DPO payment.
*/

return [
    'name' => __('DPOPayment'),
    'enable' => env("ENABLE_DPOPAYMENT",0),
    'enable_sandbox' => env('DPO_SANDBOX',1),
    'COMPANY_TOKEN' => env('COMPANY_TOKEN'),
    'SERVICE_TYPE' => env('SERVICE_TYPE'),
    'GATEWAY_URL_LIVE' => 'https://secure.3gdirectpay.com/API/v6/',
    'GATEWAY_URL_SANDBOX' => 'https://secure1.sandbox.directpay.online/API/v6/'
];
