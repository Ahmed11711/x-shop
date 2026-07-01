<?php

namespace App\Http\Resources\Admin\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                       => $this->id,

            // أساسيات
            'name'                     => $this->name,
            'sku'                      => $this->sku,
            'barcode'                  => $this->barcode,
            'barcode_type'             => $this->barcode_type,

            // تصنيف
            'unit'                     => $this->whenLoaded('unit', fn() => [
                'id'   => $this->unit->id,
                'name' => $this->unit->name,
            ]),
            'category'                 => $this->whenLoaded('category', fn() => [
                'id'   => $this->category->id,
                'name' => $this->category->name,
            ]),
            'sub_category'             => $this->whenLoaded('subCategory', fn() => [
                'id'   => $this->subCategory->id,
                'name' => $this->subCategory->name,
            ]),
            'brand'                    => $this->whenLoaded('brand', fn() => [
                'id'   => $this->brand->id,
                'name' => $this->brand->name,
            ]),

            // وصف
            'description'              => $this->description,

            // مخزون
            'manage_stock'             => $this->manage_stock,
            'alert_quantity'           => $this->alert_quantity,

            // وزن وخدمة
            'weight'                   => $this->weight,
            'service_time'             => $this->service_time,

            // خيارات
            'has_serial_imei'          => $this->has_serial_imei,
            'not_for_sale'             => $this->not_for_sale,
            'disable_woocommerce_sync' => $this->disable_woocommerce_sync,

            // نوع المنتج
            'product_type'             => $this->product_type,

            // ضرائب
            'tax'                      => $this->whenLoaded('tax', fn() => [
                'id'   => $this->tax->id,
                'name' => $this->tax->name,
            ]),
            'sales_tax_type'           => $this->sales_tax_type,

            // أسعار
            'purchase_price_exc_tax'   => $this->purchase_price_exc_tax,
            'purchase_price_inc_tax'   => $this->purchase_price_inc_tax,
            'selling_price_exc_tax'    => $this->selling_price_exc_tax,
            'selling_price_inc_tax'    => $this->selling_price_inc_tax,
            'profit_margin'            => $this->profit_margin,

            // ملفات
            'image'                    => $this->image,
            'product_brochure'         => $this->product_brochure,

            // فروع
            'branches'                 => $this->whenLoaded(
                'branches',
                fn() =>
                $this->branches->map(fn($b) => [
                    'id'   => $b->id,
                    'name' => $b->name,
                ])
            ),

            'created_at'               => $this->created_at?->toDateTimeString(),
            'updated_at'               => $this->updated_at?->toDateTimeString(),
        ];
    }
}
