<?php

return [
    'name' => 'AuthorizeNet',
    'API_LOGIN_ID' => env('API_LOGIN_ID'),
    'TRANSCATION_KEY' => env('TRANSCATION_KEY'),
    'AUTHORIZE_NET_MODE' => env('AUTHORIZE_NET_MODE'),
    'ENABLE' => env('AUTHORIZE_NET_ENABLE',0)
];
