<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '175856906316300',
        'client_secret' => 'f77fb2f1260279daaf9c472897b54990',
        'redirect' => 'http://yasin.com:8000/admin/login/facebook/callback',
    ],

    'google' => [
        'client_id' => '331542046444-jphht1j35cfbpjolt1bn436a07kvv1fn.apps.googleusercontent.com',
        'client_secret' => 'FzSYmNoNi1L2EBmSNEbNMbny',
        'redirect' => 'http://yasin.com:8000/admin/login/google/callback',
    ],

];
