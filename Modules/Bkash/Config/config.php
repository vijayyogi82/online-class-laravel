<?php

/*
* Configuration file for Bkash payment.
*/

return [
    'name' => 'Bkash',
    'ENABLE' => env('ENABLE_BKASH',0),
    'BKASH_APP_KEY' => env('BKASH_APP_KEY'),
    'BKASH_APP_SECRET' => env('BKASH_APP_SECRET'),
    'BKASH_USER_NAME' => env('BKASH_USER_NAME'),
    'BKASH_PASSWORD' => env('BKASH_PASSWORD'),
    'SANDBOX_URL' => 'https://checkout.sandbox.bka.sh/v1.2.0-beta',
    'LIVE_URL' => 'https://checkout.pay.bka.sh/v1.2.0-beta',
    'SANDBOX_ENABLED' => env('BKASH_SANDBOX_MODE',1),
    'BKASH_PAYMENT_SANDBOX' => 'https://scripts.sandbox.bka.sh/versions/1.2.0-beta',
    'BKASH_PAYMENT_LIVE' => 'https://scripts.pay.bka.sh/versions/1.2.0-beta',
];
