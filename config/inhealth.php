<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Payment Section Inhealth Container
    |--------------------------------------------------------------------------
    | Config variable are declared in the .env
    |
    |
    */

    'inhealth_prod' => env('INHEALTH_PRODUCTION',false),
    'inhealth_dev_url' => env('IHEALTH_DEV_URL', 'https://development.inhealth.co.id/pelkesws2/'),
    'inhealth_prod_url' => env('IHEALTH_PROD_URL', 'https://development.inhealth.co.id/pelkesws2/'),
    'credentials' => [
        'token' => env('INHEALTH_TOKEN', null),
        'provider_code' => env('INHEALTH_PROVIDER_CODE', null)
    ]

];
