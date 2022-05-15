<?php declare(strict_types = 1);

return [
    'air' => [
        'production' => [
            'base_uri' => env('DOMAINS_AIR_PROD_BASEURI', 'https://test.api.amadeus.com/v2'),
            'bearer_token' => env('DOMAINS_AIR_PROD_BEARER_TOKEN', ''),
        ],
        'staging' => [
            'base_uri' => env('DOMAINS_AIR_STAGING_BASEURI', 'https://test.api.amadeus.com/v2'),
            'bearer_token' => env('DOMAINS_AIR_STAGING_BEARER_TOKEN', ''),
        ],
    ],
];
