<?php

return [
    'name'               => __('Onepay'),
    'ENABLE'             => env("ONEPAY_ENABLE",0),
    'ONEPAY_ACCESS_CODE' => env('ONEPAY_ACCESS_CODE'),
    'ONEPAY_SECURE_CODE' => env('ONEPAY_SECURE_CODE'),
    'ONEPAY_MERCHANT_ID' => env('ONEPAY_MERCHANT_ID'),
    'payurl'             => 'https://mtf.onepay.vn/paygate/vpcpay.op?',
    'vpc_Version'        => 2
];
