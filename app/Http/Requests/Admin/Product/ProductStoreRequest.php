<?php

namespace App\Http\Requests\Admin\Product;

use App\Http\Requests\BaseRequest\BaseRequest;

class ProductStoreRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            // أساسيات
            'name'                     => ['required', 'string', 'max:255'],
            'sku'                      => ['nullable', 'string', 'max:100', 'unique:products,sku'],
            'barcode'                  => ['nullable', 'string', 'max:100'],
            'barcode_type'             => ['nullable', 'in:Code 128 (C128),Code 39,EAN-13,EAN-8,UPC-A,QR Code'],

            // تصنيف
            // 'unit_id'                  => ['nullable', 'exists:units,id'],
            'category_id'              => ['nullable', 'exists:category_products,id'],
            'sub_category_id'          => ['nullable', 'exists:category_products,id'],
            'brand_id'                 => ['nullable', 'exists:brands,id'],

            // وصف
            'description'              => ['nullable', 'string'],

            // مخزون
            'manage_stock'             => ['boolean'],
            'alert_quantity'           => ['nullable', 'integer', 'min:0'],

            // وزن وخدمة
            'weight'                   => ['nullable', 'numeric', 'min:0'],
            'service_time'             => ['nullable', 'integer', 'min:0'],

            // خيارات
            'has_serial_imei'          => ['boolean'],
            'not_for_sale'             => ['boolean'],
            'disable_woocommerce_sync' => ['boolean'],

            // نوع المنتج
            'product_type'             => ['nullable', 'in:single,variable,combo,digital'],

            // ضرائب
            'tax_id'                   => ['nullable', 'exists:taxes,id'],
            'sales_tax_type'           => ['nullable', 'in:exclusive,inclusive'],

            // أسعار
            'purchase_price_exc_tax'   => ['nullable', 'numeric', 'min:0'],
            'purchase_price_inc_tax'   => ['nullable', 'numeric', 'min:0'],
            'selling_price_exc_tax'    => ['nullable', 'numeric', 'min:0'],
            'selling_price_inc_tax'    => ['nullable', 'numeric', 'min:0'],
            'profit_margin'            => ['nullable', 'numeric', 'min:0', 'max:100'],

            // ملفات
            'image'                    => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'product_brochure'         => ['nullable', 'file', 'mimes:pdf,csv,zip,doc,docx,jpeg,jpg,png', 'max:2048'],

            // فروع
            'branch_ids'               => ['nullable', 'array'],
            'branch_ids.*'             => ['exists:branches,id'],
        ];
    }
}
