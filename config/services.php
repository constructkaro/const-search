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

    'twilio' => [
        'sid' => env('TWILIO_ACCOUNT_SID'),
        'token' => env('TWILIO_AUTH_TOKEN'),
        'verify_sid' => env('TWILIO_VERIFY_SERVICE_SID'),
    ],

    'otp' => [
        'provider' => env('OTP_PROVIDER', 'twilio'),
    ],

    'realtime_otp' => [
        'endpoint' => env('REALTIME_OTP_ENDPOINT'),
        'method' => env('REALTIME_OTP_METHOD', 'POST'),
        'api_key' => env('REALTIME_OTP_API_KEY'),
        'auth_header' => env('REALTIME_OTP_AUTH_HEADER', 'Authorization'),
        'mobile_field' => env('REALTIME_OTP_MOBILE_FIELD', 'mobile'),
        'message_field' => env('REALTIME_OTP_MESSAGE_FIELD', 'message'),
        'otp_field' => env('REALTIME_OTP_OTP_FIELD'),
        'include_country_code' => env('REALTIME_OTP_INCLUDE_COUNTRY_CODE', true),
        'message' => env('REALTIME_OTP_MESSAGE', 'Your Constructkaro OTP is {otp}.'),
        'success_path' => env('REALTIME_OTP_SUCCESS_PATH'),
        'success_value' => env('REALTIME_OTP_SUCCESS_VALUE'),
        'ttl_minutes' => env('REALTIME_OTP_TTL_MINUTES', 10),
        'timeout' => env('REALTIME_OTP_TIMEOUT', 15),
        'extra' => json_decode(env('REALTIME_OTP_EXTRA', '{}'), true) ?: [],
    ],

    'google_maps' => [
        'browser_key' => env('GOOGLE_MAPS_BROWSER_KEY'),
    ],

];
