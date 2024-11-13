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

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],
    'google' => [
        'client_id' => env('GOOGLE_OAUTH_ID'),
        'client_secret' => env('GOOGLE_OAUTH_KEY'),
<<<<<<< HEAD
        'redirect' => env('GOOGLE_REDIRECT_URI'),
=======
        'redirect' => env('APP_ENV') === 'local'
        ? 'http://127.0.0.1:8000/google-callback'
        : 'https://todo-rifas.crudzaso.com/google-callback',
>>>>>>> 846dd045d5247ca948bfc1d4863ff9c0f187ffbe
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
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


    'discord' => [
        'webhook_url' => env('DISCORD_WEBHOOK_URL'),
    ],



];
