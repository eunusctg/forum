<?php

namespace App\Services;

use App\Models\User;

class PaymentService
{
    public function startCheckout(User $user, string $provider, string $plan): string
    {
        return match ($provider) {
            'stripe' => 'https://checkout.stripe.com/pay/mock-session?plan='.$plan.'&user='.$user->id,
            'paypal' => 'https://www.paypal.com/checkoutnow?token=mock_'.$plan.'_'.$user->id,
        };
    }
}
