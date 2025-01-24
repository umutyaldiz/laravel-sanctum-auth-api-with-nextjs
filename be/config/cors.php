<?php
return [

    /*
    |--------------------------------------------------------------------------
    | CORS Configuration
    |--------------------------------------------------------------------------
    |
    | The allowed paths, methods, and other settings for Cross-Origin
    | Resource Sharing (CORS) are defined here. Adjust these settings
    | to match your requirements.
    |
    */

    // 'paths' => ['*'],
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:3000'],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => ['*'],
    'max_age' => 0,
    'supports_credentials' => true,

];
