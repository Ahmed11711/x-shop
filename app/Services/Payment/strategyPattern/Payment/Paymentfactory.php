<?php

namespace App\Services\Payment\strategyPattern\Payment;

use App\Services\Payment\strategyPattern\Payment\Gateways\PaymobGateway;
use App\Services\Payment\strategyPattern\Payment\Gateways\PayPalGateway;
use App\Services\Payment\strategyPattern\Payment\Gateways\StripeGateway;
use InvalidArgumentException;

class PaymentFactory
{
    private static array $gateways = [
        'stripe'  => StripeGateway::class,
        'paymob'  => PaymobGateway::class,
        'paypal'  => PayPalGateway::class,
    ];

    public static function make(string $gateway): PaymentGatewayInterface
    {
        $gateway = strtolower($gateway);

        if (! array_key_exists($gateway, self::$gateways)) {
            throw new InvalidArgumentException(
                "Gateway [{$gateway}] is not supported. Available: " . implode(', ', array_keys(self::$gateways))
            );
        }

        return new (self::$gateways[$gateway])();
    }

    public static function available(): array
    {
        return array_keys(self::$gateways);
    }
}
