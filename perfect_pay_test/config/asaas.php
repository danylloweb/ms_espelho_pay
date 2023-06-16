<?php

return [
    'url' => env('ASAAS_URL', 'https://sandbox.asaas.com/'),
    'wallet_id' => env('ASAAS_WALLET_ID', '53cb8476-2e34-4226-b287-643abf837983'),
    'api_key' => env('ASAAS_API_KEY', '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwNTcxNTE6OiRhYWNoXzlmZjg1NmE0LTBkMjktNGE2Mi05NmUwLTg5NDUyZDkyZDkyOQ=='),
    'payment_create' => [
        'method'   => 'POST',
        'resource' => 'api/v3/payments',
        'json'     => true,
    ],
    'customer_create' => [
        'method'   => 'POST',
        'resource' => 'api/v3/customers',
        'json'     => true,
    ],
];
