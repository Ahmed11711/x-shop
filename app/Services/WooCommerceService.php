<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WooCommerceService
{
    protected string $storeUrl;
    protected string $consumerKey;
    protected string $consumerSecret;

    public function __construct()
    {
        $this->storeUrl       = config('services.woocommerce.store_url');
        $this->consumerKey    = config('services.woocommerce.consumer_key');
        $this->consumerSecret = config('services.woocommerce.consumer_secret');
    }

    public function createProduct(array $data): array|null
    {
        $response = Http::withBasicAuth($this->consumerKey, $this->consumerSecret)
            ->post("{$this->storeUrl}/wp-json/wc/v3/products", $data);

        if ($response->successful()) {
            return $response->json();
        }

        Log::error('WooCommerce createProduct failed', [
            'status' => $response->status(),
            'body'   => $response->body(),
        ]);

        return null;
    }

    public function updateProduct(string $wcProductId, array $data): array|null
    {
        $response = Http::withBasicAuth($this->consumerKey, $this->consumerSecret)
            ->put("{$this->storeUrl}/wp-json/wc/v3/products/{$wcProductId}", $data);

        if ($response->successful()) {
            return $response->json();
        }

        Log::error('WooCommerce updateProduct failed', [
            'status' => $response->status(),
            'body'   => $response->body(),
        ]);

        return null;
    }

    public function deleteProduct(string $wcProductId): bool
    {
        $response = Http::withBasicAuth($this->consumerKey, $this->consumerSecret)
            ->delete("{$this->storeUrl}/wp-json/wc/v3/products/{$wcProductId}", [
                'force' => true, // حذف نهائي بدل الترحيل لسلة المهملات
            ]);

        if ($response->successful()) {
            return true;
        }

        Log::error('WooCommerce deleteProduct failed', [
            'status' => $response->status(),
            'body'   => $response->body(),
        ]);

        return false;
    }
}
