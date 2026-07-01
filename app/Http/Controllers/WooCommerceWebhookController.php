<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| نسخة تجريبية (Testing Only)
|--------------------------------------------------------------------------
| بدل ما نقرأ webhook_secret من جدول woocommerce_settings، بنستخدم
| قيمة ثابتة مؤقتة من .env عشان نجرب بسرعة من غير ما نضيف عمود جديد
| أو نعدّل الـ connect() تاني.
|
| لازم تضيف السطر ده في ملف .env بتاعك:
|
|   WOOCOMMERCE_WEBHOOK_SECRET=test-secret-123
|
| ولما تعمل connect() (أو تنشئ webhook يدوي من WooCommerce Admin)،
| حط نفس القيمة دي في خانة "Secret" بتاعت الـ webhook.
|--------------------------------------------------------------------------
*/

class WooCommerceWebhookController extends Controller
{
    public function handle(Request $request, string $tenant)
    {
        $rawBody = $request->getContent();

        // WooCommerce بيبعت ping فاضي أول مرة يتعمل فيها الـ webhook
        if (empty($rawBody)) {
            return response()->json(['status' => 'ping received'], 200);
        }

        $webhookSecret = config('services.woocommerce.webhook_secret');

        if (!$webhookSecret) {
            Log::error('WOOCOMMERCE_WEBHOOK_SECRET غير موجود في .env');
            return response()->json(['message' => 'Server misconfigured'], 500);
        }

        // تحقق من التوقيع
        $signatureHeader = $request->header('X-WC-Webhook-Signature');
        $expectedSignature = base64_encode(hash_hmac('sha256', $rawBody, $webhookSecret, true));

        if (!$signatureHeader || !hash_equals($expectedSignature, $signatureHeader)) {
            Log::warning('Invalid webhook signature', ['tenant' => $tenant]);
            return response()->json(['message' => 'Invalid signature'], 401);
        }

        $topic   = $request->header('X-WC-Webhook-Topic');
        $payload = $request->json()->all();

        Log::info('WooCommerce webhook received', ['tenant' => $tenant, 'topic' => $topic, 'payload' => $payload]);

        match ($topic) {
            'product.created' => $this->handleProductCreated($payload, $tenant),
            'product.updated' => $this->handleProductUpdated($payload, $tenant),
            'product.deleted' => $this->handleProductDeleted($payload, $tenant),
            'order.created'   => $this->handleOrderCreated($payload, $tenant),
            'order.updated'   => $this->handleOrderUpdated($payload, $tenant),
            default            => Log::info('Unhandled webhook topic', ['topic' => $topic]),
        };

        return response()->json(['status' => 'received'], 200);
    }

    private function handleProductCreated(array $payload, string $tenant): void
    {
        DB::table('synced_products')->updateOrInsert(
            ['woocommerce_id' => $payload['id'], 'tenant' => $tenant],
            [
                'name'      => $payload['name']   ?? '',
                'sku'       => $payload['sku']    ?? '',
                'price'     => $payload['price']  ?? 0,
                'status'    => $payload['status'] ?? '',
                'raw_data'  => json_encode($payload),
                'synced_at' => now(),
            ]
        );
    }

    private function handleProductUpdated(array $payload, string $tenant): void
    {
        $this->handleProductCreated($payload, $tenant);
    }

    private function handleProductDeleted(array $payload, string $tenant): void
    {
        DB::table('synced_products')
            ->where('woocommerce_id', $payload['id'])
            ->where('tenant', $tenant)
            ->delete();
    }

    private function handleOrderCreated(array $payload, string $tenant): void
    {
        DB::table('synced_orders')->updateOrInsert(
            ['woocommerce_order_id' => $payload['id'], 'tenant' => $tenant],
            [
                'status'        => $payload['status']        ?? '',
                'total'         => $payload['total']         ?? 0,
                'customer_note' => $payload['customer_note'] ?? '',
                'raw_data'      => json_encode($payload),
                'synced_at'     => now(),
            ]
        );
    }

    private function handleOrderUpdated(array $payload, string $tenant): void
    {
        $this->handleOrderCreated($payload, $tenant);
    }
}
