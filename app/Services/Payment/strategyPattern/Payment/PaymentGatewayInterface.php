<?php

namespace App\Services\Payment\strategyPattern\Payment;

interface PaymentGatewayInterface
{
    public function charge(PaymentData $data): PaymentResult;
    public function refund(string $transactionId, float $amount): PaymentResult;
    public function getGatewayName(): string;
}
