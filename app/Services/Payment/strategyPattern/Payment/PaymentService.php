<?php

namespace App\Services\Payment\strategyPattern\Payment;

class PaymentService
{
    private PaymentGatewayInterface $gateway;

    public function __construct(string $gateway = 'stripe')
    {
        $this->gateway = PaymentFactory::make($gateway);
    }

    public function setGateway(string $gateway): self
    {
        $this->gateway = PaymentFactory::make($gateway);
        return $this;
    }

    public function charge(PaymentData $data): PaymentResult
    {
        return $this->gateway->charge($data);
    }

    public function refund(string $transactionId, float $amount): PaymentResult
    {
        return $this->gateway->refund($transactionId, $amount);
    }

    public function getCurrentGateway(): string
    {
        return $this->gateway->getGatewayName();
    }
}
