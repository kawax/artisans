<?php

use function Revolution\Illuminate\Support\env;

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
        'domain'   => env('MAILGUN_DOMAIN'),
        'secret'   => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key'    => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model'   => App\Models\User::class,
        'key'     => env('STRIPE_KEY'),
        'secret'  => env('STRIPE_SECRET'),
        'webhook' => [
            'secret'    => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

    'github' => [
        'client_id'     => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect'      => '/callback',
    ],

    'discord' => [
        'prefix'    => '/',
        'not_found' => 'Command Not Found!',
        'path'      => [
            'commands' => app_path('Discord/Commands'),
            'directs'  => app_path('Discord/Directs'),
        ],
        'token'     => env('DISCORD_BOT_TOKEN'),
        'channel'   => [
            'user'        => env('DISCORD_CHANNEL_USER'),
            'post'        => env('DISCORD_CHANNEL_POST'),
            'post_report' => env('DISCORD_CHANNEL_POST_REPORT'),
        ],
        'bot'       => env('DISCORD_BOT'),
    ],

    'slack' => [
        'user' => env('SLACK_USER'),
        'post' => env('SLACK_POST'),
    ],

];
