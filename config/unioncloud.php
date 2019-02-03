<?php

return [

    'baseURL' => env('UNIONCLOUD_BASEURL', 'unioncloud.org'),

    'v0auth' => [
        'email' => env('UNIONCLOUD_V0AUTH_EMAIL', 'email'),
        'password' => env('UNIONCLOUD_V0AUTH_PASSWORD', 'passsword'),
        'appID' => env('UNIONCLOUD_V0AUTH_APPID', 'appid'),
        'appPassword' => env('UNIONCLOUD_V0AUTH_APPPASSWORD', 'apppassword')

    ]

];