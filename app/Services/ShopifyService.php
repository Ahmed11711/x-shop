<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ShopifyService
{
    protected string $storeUrl;
    protected string $accessToken;
    protected string $apiVersion = '2026-04';

    public function __construct()
    {
        $this->storeUrl    = config('services.shopify.store_url');
        $this->accessToken = config('services.shopify.access_token');
    }

    public function createProduct(array $data): array|null
    {
        $response = Http::withHeaders($this->headers())
            ->post("https://{$this->storeUrl}/admin/api/{$this->apiVersion}/products.json", [
                'product' => $data,
            ]);

        if ($response->successful()) {
            return $response->json('product');
        }

        Log::error('Shopify createProduct failed', [
            'status' => $response->status(),
            'body'   => $response->body(),
        ]);

        return null;
    }

    public function updateProduct(string $shopifyProductId, array $data): array|null
    {
        $response = Http::withHeaders($this->headers())
            ->put("https://{$this->storeUrl}/admin/api/{$this->apiVersion}/products/{$shopifyProductId}.json", [
                'product' => $data,
            ]);

        if ($response->successful()) {
            return $response->json('product');
        }

        Log::error('Shopify updateProduct failed', [
            'status' => $response->status(),
            'body'   => $response->body(),
        ]);

        return null;
    }

    public function deleteProduct(string $shopifyProductId): bool
    {
        $response = Http::withHeaders($this->headers())
            ->delete("https://{$this->storeUrl}/admin/api/{$this->apiVersion}/products/{$shopifyProductId}.json");

        if ($response->successful()) {
            return true;
        }

        Log::error('Shopify deleteProduct failed', [
            'status' => $response->status(),
            'body'   => $response->body(),
        ]);

        return false;
    }

    protected function headers(): array
    {
        return [
            'X-Shopify-Access-Token' => $this->accessToken,
            'Content-Type'           => 'application/json',
        ];
    }
}
