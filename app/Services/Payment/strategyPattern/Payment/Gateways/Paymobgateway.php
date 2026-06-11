<?php

namespace App\Services\Payment\strategyPattern\Payment\Gateways;

use App\Services\Payment\strategyPattern\Payment\PaymentData;
use App\Services\Payment\strategyPattern\Payment\PaymentGatewayInterface;
use App\Services\Payment\strategyPattern\Payment\PaymentResult;

class PaymobGateway implements PaymentGatewayInterface
{
    public function charge(PaymentData $data): PaymentResult
    {
        // --- Paymob flow would go here ---
        // 1. Authenticate  → get token
        // 2. Create order  → get order_id
        // 3. Request payment key
        // 4. Redirect / iframe

        $fakeTransactionId = 'paymob_txn_' . uniqid();

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
        // POST https://accept.paymob.com/api/acceptance/void_refund/refund

        return PaymentResult::success(
            transactionId: 'paymob_refund_' . uniqid(),
            gateway: $this->getGatewayName(),
        );
    }

    public function getGatewayName(): string
    {
        return 'paymob';
    }
}
