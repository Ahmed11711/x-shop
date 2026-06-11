<?php

namespace App\Http\Controllers;

use App\Services\Payment\strategyPattern\Payment\PaymentData;
use App\Services\Payment\strategyPattern\Payment\PaymentFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\Payment\strategyPattern\Payment\PaymentService;

class PaymentController extends Controller
{
    public function __construct(private PaymentService $paymentService) {}


    public function charge(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'gateway'     => 'required|string|in:stripe,paymob,paypal',
            'amount'      => 'required|numeric|min:1',
            'currency'    => 'required|string|size:3',
            'email'       => 'required|email',
            'description' => 'nullable|string|max:255',
        ]);

        $data = new PaymentData(
            amount: $validated['amount'],
            currency: strtoupper($validated['currency']),
            customerEmail: $validated['email'],
            description: $validated['description'] ?? '',
        );

        $result = $this->paymentService
            ->setGateway($validated['gateway'])
            ->charge($data);

        return response()->json([
            'success'        => $result->success,
            'transaction_id' => $result->transactionId,
            'gateway'        => $result->gateway,
            'message'        => $result->message,
        ], $result->success ? 200 : 422);
    }

    /**
     * POST /api/payments/refund
     * Body: { "gateway": "stripe", "transaction_id": "txn_xxx", "amount": 50 }
     */
    public function refund(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'gateway'        => 'required|string|in:stripe,paymob,paypal',
            'transaction_id' => 'required|string',
            'amount'         => 'required|numeric|min:1',
        ]);

        $result = $this->paymentService
            ->setGateway($validated['gateway'])
            ->refund($validated['transaction_id'], $validated['amount']);

        return response()->json([
            'success'        => $result->success,
            'transaction_id' => $result->transactionId,
            'gateway'        => $result->gateway,
            'message'        => $result->message,
        ], $result->success ? 200 : 422);
    }

    /**
     * GET /api/payments/gateways
     */
    public function gateways(): JsonResponse
    {
        return response()->json([
            'gateways' => PaymentFactory::available(),
        ]);
    }
}
