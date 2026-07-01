<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WooCommerceConnectController extends Controller
{
    public function connect()
    {
        $storeUrl = 'https://almaram-company.com/test';
        $consumerKey = 'ck_3515284d1357259a106ed71a0eb9200b015a48ee';
        $consumerSecret = 'cs_bee02afbdd99fb772e197678aa7b68fc1034362f';
        $tenant = 'store1';

        $response = Http::withBasicAuth(
            $consumerKey,
            $consumerSecret
        )->get($storeUrl . '/wp-json/wc/v3/system_status');

        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'Connection failed',
                'response' => $response->body(),
            ], 400);
        }

        $topics = [
            'product.created',
            'product.updated',
            'product.deleted',
            'order.created',
            'order.updated',
            'order.deleted',
        ];

        foreach ($topics as $topic) {

            $webhook = Http::withBasicAuth(
                $consumerKey,
                $consumerSecret
            )->post($storeUrl . '/wp-json/wc/v3/webhooks', [
                'name'         => 'Laravel - ' . $topic,
                'topic'        => $topic,
                'delivery_url' => url('/api/woocommerce/webhook/' . $tenant),
                'secret'       => config('services.woocommerce.webhook_secret'),
                'status'       => 'active',
            ]);

            Log::info("Webhook {$topic}", [
                'status' => $webhook->status(),
                'body'   => $webhook->json(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'WooCommerce connected successfully.',
        ]);
    }
}
