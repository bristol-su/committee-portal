<?php

return [
    'client_id' => env('TYPEFORM_CLIENT_ID'),
    'client_secret' => env('TYPEFORM_CLIENT_SECRET'),
    
    'url_prefix' => '/_connector/typeform',
    'urlAuthorize' => 'https://api.typeform.com/oauth/authorize',
    'urlAccessToken' => 'https://api.typeform.com/oauth/token',
];