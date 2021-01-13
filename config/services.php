<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [
        'client_id' => '1068248420340915',  //client face của bạn
        'client_secret' => '5e2ba7d52c626251422a42c1ce02b7a8',  //client app service face của bạn
        'redirect' => 'http://localhost/shop/admin/callback' //callback trả về
    ],

    'google' => [
        'client_id' => '514909163893-t6m3bkpms7ulr7pa0u20ja9fj4nhdds7.apps.googleusercontent.com',
        'client_secret' => '_qGxPgvOjK_exfJOvwNe_3RY',
        'redirect' => 'http://localhost/shop/google/callback' 
    ],



];
