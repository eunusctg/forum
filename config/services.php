<?php

return [
    'openai' => ['key' => env('OPENAI_API_KEY')],
    'huggingface' => ['key' => env('HUGGINGFACE_API_KEY')],
    'stripe' => ['key' => env('STRIPE_KEY'), 'secret' => env('STRIPE_SECRET')],
    'paypal' => ['client_id' => env('PAYPAL_CLIENT_ID'), 'client_secret' => env('PAYPAL_CLIENT_SECRET')],
];
