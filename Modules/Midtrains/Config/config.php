<?php

return [
    'name'   => 'Midtrains',
    'ENABLE' => env('MID_TRANS_ENABLE'),
    'MID_TRANS_CLIENT_KEY' => env('MID_TRANS_CLIENT_KEY'),
    'MID_TRANS_SERVER_KEY' => env('MID_TRANS_SERVER_KEY'),
    'MID_TRANS_MODE' => env('MID_TRANS_MODE','sandbox')
];
