<?php

namespace App\Observers;

use App\Models\Product;
use App\Services\WooCommerceService;
use Illuminate\Support\Facades\Log;

class WooCommerceProductObserver
{
    public function __construct(protected WooCommerceService $woocommerce) {}

    public function created(Product $product): void
    {
        // لو جاي من الـ webhook بالفعل (عنده woocommerce_product_id) متعملش create تاني
        if ($product->woocommerce_product_id) {
            return;
        }

        try {
            $data = $this->buildWcData($product);

            $wcProduct = $this->woocommerce->createProduct($data);

            if ($wcProduct) {
                $product->updateQuietly([
                    'woocommerce_product_id' => $wcProduct['id']
                ]);

                Log::info('Product created on WooCommerce', [
                    'product_id'              => $product->id,
                    'woocommerce_product_id'  => $wcProduct['id'],
                ]);
            }
        } catch (\Exception $e) {
            Log::error('WooCommerce create failed', [
                'product_id' => $product->id,
                'error'      => $e->getMessage(),
            ]);
        }
    }

    public function updated(Product $product): void
    {
        // لو التعديل الوحيد كان حقل woocommerce_product_id نفسه (من الـ webhook) متعملش حاجة
        if (count($product->getDirty()) === 1 && $product->isDirty('woocommerce_product_id')) {
            return;
        }

        if (!$product->woocommerce_product_id) {
            $this->created($product);
            return;
        }

        try {
            $data = $this->buildWcData($product);

            $updated = $this->woocommerce->updateProduct($product->woocommerce_product_id, $data);

            if ($updated) {
                Log::info('Product updated on WooCommerce', [
                    'product_id'             => $product->id,
                    'woocommerce_product_id' => $product->woocommerce_product_id,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('WooCommerce update failed', [
                'product_id' => $product->id,
                'error'      => $e->getMessage(),
            ]);
        }
    }

    public function deleted(Product $product): void
    {
        if (!$product->woocommerce_product_id) {
            return;
        }

        try {
            $this->woocommerce->deleteProduct($product->woocommerce_product_id);

            Log::info('Product deleted from WooCommerce', [
                'product_id'             => $product->id,
                'woocommerce_product_id' => $product->woocommerce_product_id,
            ]);
        } catch (\Exception $e) {
            Log::error('WooCommerce delete failed', [
                'product_id' => $product->id,
                'error'      => $e->getMessage(),
            ]);
        }
    }

    protected function buildWcData(Product $product): array
    {
        $data = [
            'name'            => $product->name,
            'description'     => $product->description,
            'sku'             => $product->sku,
            'regular_price'   => (string) ($product->selling_price_inc_tax ?? $product->selling_price_exc_tax),
            'weight'          => (string) $product->weight,
            'status'          => $product->not_for_sale ? 'draft' : 'publish',
            'type'            => 'simple',
            // الباركود مش حقل افتراضي في WooCommerce، بنحطه كـ meta_data
            'meta_data'       => array_filter([
                $product->barcode ? ['key' => 'barcode', 'value' => $product->barcode] : null,
            ]),
        ];

        // WooCommerce بيحتاج روابط category IDs مش أسامي، لو عايز تربط الكاتيجوري
        // لازم تعمل mapping بين category_id بتاعك و WooCommerce category id (هنتكلم عنها لو حبيت)

        if ($product->image) {
            $imagePath = ltrim($product->image, '/');
            $imagePath = str_replace('storage/', '', $imagePath);

            // لازم يكون رابط عام يقدر سيرفر ووردبريس يوصله (مش base64)
            $publicUrl = asset('storage/' . $imagePath);

            $data['images'] = [
                ['src' => $publicUrl],
            ];
        }

        return $data;
    }
}
