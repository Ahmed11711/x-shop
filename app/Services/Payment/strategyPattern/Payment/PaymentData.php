<?php

namespace App\Services\Payment\strategyPattern\Payment;

class PaymentData
{
    public function __construct(
        public readonly float  $amount,
        public readonly string $currency,
        public readonly string $customerEmail,
        public readonly string $description = '',
        public readonly array  $metadata = [],
    ) {}
}
