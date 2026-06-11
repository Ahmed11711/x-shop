<?php

namespace App\Services\Payment\strategyPattern\Payment\Gateways;

use App\Services\Payment\strategyPattern\Payment\PaymentData;
use App\Services\Payment\strategyPattern\Payment\PaymentGatewayInterface;
use App\Services\Payment\strategyPattern\Payment\PaymentResult;

class StripeGateway implements PaymentGatewayInterface
{
    public function charge(PaymentData $data): PaymentResult
    {
        // --- Stripe SDK call would go here ---
        // \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        // $charge = \Stripe\PaymentIntent::create([...]);

        $fakeTransactionId = 'stripe_txn_' . uniqid();

        return PaymentResult::success(
            transactionId: $fakeTransactionId,
            gateway: $this->getGatewayName(),
            raw: [
                'amount'   => $data->amount,
                'currency' => $data->currency,
                'email'    => $data->customerEmail,
            ],
        );
    }

    public function refund(string $transactionId, float $amount): PaymentResult
    {
        // \Stripe\Refund::create(['payment_intent' => $transactionId, 'amount' => $amount * 100]);

        return PaymentResult::success(
            transactionId: 'stripe_refund_' . uniqid(),
            gateway: $this->getGatewayName(),
        );
    }

    public function getGatewayName(): string
    {
        return 'stripe';
    }
}
