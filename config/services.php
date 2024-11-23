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
    'mailgun'=>[
        'domain'=>env('MAILGUN_DOMAIN'),
        'secret'=>env('MAILGUN_SECRET'),
        'endpoint'=>env('MAILGUN_ENDPOINT','api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost'=>[
        'secret'=>env('SPARKPOST_SECRET'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    'stripe'=> [
        'model'=>App\Models\User::class,
        'key'=>env('STRIPE_KEY'),
        'secret'=>env('STRIPE_SECRET'),
        'webhook'=>[
            'secret'=>env('STRIPR_WEBHOOK_SECRET'),
            'tolerance'=>env('STRIPE_WEBHOOK_TOLERANCE',300),
        ]
        ],
    'facebook' => [
    'client_id' => '974005338100549', //client face
    'client_secret' => '938cb1a7135a1473d89106658141b049', //client app service face 
    'redirect' => 'http://localhost/demoshop3/admin/callback' //callback trả về
],


];