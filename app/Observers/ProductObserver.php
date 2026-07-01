<?php

namespace App\Observers;

use App\Models\Product;
use App\Services\ShopifyService;
use Illuminate\Support\Facades\Log;

class ProductObserver
{
    public function __construct(protected ShopifyService $shopify) {}

    public function created(Product $product): void
    {
        // لو جاي من الـ webhook (عنده shopify_product_id بالفعل) متعملش create
        if ($product->shopify_product_id) {
            return;
        }

        try {
            $data = $this->buildShopifyData($product);

            $shopifyProduct = $this->shopify->createProduct($data);

            if ($shopifyProduct) {
                $product->updateQuietly([
                    'shopify_product_id' => $shopifyProduct['id']
                ]);

                Log::info('Product created on Shopify', [
                    'product_id' => $product->id,
                    'shopify_product_id' => $shopifyProduct['id'],
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Shopify create failed', [
                'product_id' => $product->id,
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function updated(Product $product): void
    {
        if (count($product->getDirty()) === 1 && $product->isDirty('shopify_product_id')) {
            return;
        }

        if (!$product->shopify_product_id) {
            $this->created($product);
            return;
        }

        try {
            $data = $this->buildShopifyData($product);

            $updated = $this->shopify->updateProduct($product->shopify_product_id, $data);

            if ($updated) {
                Log::info('Product updated on Shopify', [
                    'product_id' => $product->id,
                    'shopify_product_id' => $product->shopify_product_id,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Shopify update failed', [
                'product_id' => $product->id,
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function deleted(Product $product): void
    {
        if (!$product->shopify_product_id) {
            return;
        }

        try {
            $this->shopify->deleteProduct($product->shopify_product_id);

            Log::info('Product deleted from Shopify', [
                'product_id' => $product->id,
                'shopify_product_id' => $product->shopify_product_id,
            ]);
        } catch (\Exception $e) {
            Log::error('Shopify delete failed', [
                'product_id' => $product->id,
                'error' => $e->getMessage(),
            ]);
        }
    }

    protected function buildShopifyData(Product $product): array
    {
        $data = [
            'title'        => $product->name,
            'body_html'    => $product->description,
            'vendor'       => $product->brand?->name ?? 'My Store',
            'product_type' => $product->product_type,
            'status'       => $product->not_for_sale ? 'draft' : 'active',
            'tags'         => implode(', ', array_filter([
                $product->category?->name,
                $product->subCategory?->name,
                $product->brand?->name,
            ])),
            'variants' => [
                [
                    'sku'         => $product->sku,
                    'price'       => $product->selling_price_inc_tax ?? $product->selling_price_exc_tax,
                    'barcode'     => $product->barcode,
                    'weight'      => $product->weight,
                    'weight_unit' => 'kg',
                    'taxable'     => $product->tax_id ? true : false,
                ],
            ],
        ];

        if ($product->image) {
            $imagePath = ltrim($product->image, '/');
            $imagePath = str_replace('storage/', '', $imagePath);
            $fullPath  = storage_path('app/public/' . $imagePath);

            if (file_exists($fullPath)) {
                $data['images'] = [
                    [
                        'attachment' => base64_encode(file_get_contents($fullPath)),
                        'filename'   => basename($imagePath),
                    ]
                ];
            }
        }

        return $data;
    }
}
