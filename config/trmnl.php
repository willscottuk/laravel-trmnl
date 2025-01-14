<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Plugin Type
    |--------------------------------------------------------------------------
    |
    | Specifies if your TRMNL plugin is public or private; default is private.
    | If set to public, the authentication routes will be exposed.
    | Publish and run migrations to create the necessary tables.
    */
    'plugin_type' => env('TRMNL_PLUGIN_TYPE', 'private'),
    'oauth_client_id' => env('TRMNL_OAUTH_CLIENT_ID'),
    'oauth_client_secret' => env('TRMNL_OAUTH_CLIENT_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Data Strategy
    |--------------------------------------------------------------------------
    |
    | TRMNL supports two data strategies: polling and webhook.
    | Default is polling.
    | If your plugin type is private, you can set the data strategy to webhook.
    | If you set the data strategy to webhook, you must provide a webhook URL.
    */
    'data_strategy' => env('TRMNL_DATA_STRATEGY', 'polling'),
    'webhook_url' => env('TRMNL_WEBHOOK_URL'),
];
