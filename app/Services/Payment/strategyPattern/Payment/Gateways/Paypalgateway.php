<?php

namespace App\Services\Payment\strategyPattern\Payment\Gateways;

use App\Services\Payment\strategyPattern\Payment\PaymentData;
use App\Services\Payment\strategyPattern\Payment\PaymentGatewayInterface;
use App\Services\Payment\strategyPattern\Payment\PaymentResult;

class PayPalGateway implements PaymentGatewayInterface
{
    public function charge(PaymentData $data): PaymentResult
    {
        // --- PayPal SDK call would go here ---
        // $order = $client->orders()->create([...]);

        $fakeTransactionId = 'paypal_txn_' . uniqid();

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
        // POST /v2/payments/captures/{id}/refund

        return PaymentResult::success(
            transactionId: 'paypal_refund_' . uniqid(),
            gateway: $this->getGatewayName(),
        );
    }

    public function getGatewayName(): string
    {
        return 'paypal';
    }
}
