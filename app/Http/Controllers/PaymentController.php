<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(private readonly PaymentService $payments) {}

    public function checkout(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'plan' => 'required|string|max:50',
            'provider' => 'required|in:stripe,paypal',
        ]);

        $url = $this->payments->startCheckout($request->user(), $data['provider'], $data['plan']);

        return redirect()->away($url);
    }
}
