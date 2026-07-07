<?php

namespace App\Http\Resources\Admin\Purchase;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                    => $this->id,
            'purchase_status'       => $this->purchase_status,
            'purchase_date'         => $this->purchase_date,
            'reference_number'      => $this->reference_number,
            'supplier_id'           => $this->supplier_id,
            'branch_id'             => $this->branch_id,
            'address'               => $this->address,
            'attachment_image'      => $this->attachment_image,
            'payment_period'        => $this->payment_period,

            'discount_type'         => $this->discount_type,
            'discount_value'        => $this->discount_value,
            'discount_amount'       => $this->discount_amount,

            'tax_type'              => $this->tax_type,
            'tax_value'             => $this->tax_value,
            'tax_amount'            => $this->tax_amount,

            'shipping_cost_total'   => $this->shipping_cost_total,
            'shipping_details'      => $this->shipping_details,

            'total_purchase_amount' => $this->total_purchase_amount,
            'total_paid'            => $this->total_paid,
            'due_amount'            => $this->due_amount,

            'notes'                 => $this->notes,
            'created_by'            => $this->created_by,
            'created_at'            => $this->created_at,
            'updated_at'            => $this->updated_at,

            // العلاقات (تتحمل بس لو معمولها load مسبقًا)
            'supplier'    => $this->whenLoaded('supplier'),
            'branch'      => $this->whenLoaded('branch'),
            'creator'     => $this->whenLoaded('creator'),

            'items' => $this->whenLoaded('items', function () {
                return $this->items->map(function ($item) {
                    return [
                        'id'                        => $item->id,
                        'product_id'                => $item->product_id,
                        // هنا الفرق: نتأكد إن العلاقة اتحملت فعلاً قبل ما نرجعها
                        'product'                   => $item->relationLoaded('product') ? $item->product : null,
                        'quantity'                  => $item->quantity,
                        'unit_cost_before_discount' => $item->unit_cost_before_discount,
                        'discount_percentage'       => $item->discount_percentage,
                        'unit_cost_before_tax'      => $item->unit_cost_before_tax,
                        'line_total'                => $item->line_total,
                        'profit_margin_percentage'  => $item->profit_margin_percentage,
                        'unit_sale_price_incl_tax'  => $item->unit_sale_price_incl_tax,
                        'sort_order'                => $item->sort_order,
                    ];
                });
            }),

            'expenses'     => $this->whenLoaded('expenses'),
            'installments' => $this->whenLoaded('installments'),
        ];
    }
}
