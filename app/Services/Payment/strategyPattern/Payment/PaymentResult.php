<?php

namespace App\Services\Payment\strategyPattern\Payment;

class PaymentResult
{
    public function __construct(
        public readonly bool   $success,
        public readonly string $transactionId,
        public readonly string $gateway,
        public readonly string $message = '',
        public readonly array  $rawResponse = [],
    ) {}

    public static function success(string $transactionId, string $gateway, array $raw = []): self
    {
        return new self(
            success: true,
            transactionId: $transactionId,
            gateway: $gateway,
            message: 'Payment successful',
            rawResponse: $raw,
        );
    }

    public static function failure(string $gateway, string $message, array $raw = []): self
    {
        return new self(
            success: false,
            transactionId: '',
            gateway: $gateway,
            message: $message,
            rawResponse: $raw,
        );
    }
}
