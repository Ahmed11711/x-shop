<?php

namespace App\Http\Resources\Admin\PurchaseReturn;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseReturnResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                   => $this->id,
            'supplier_id'          => $this->supplier_id,
            'branch_id'            => $this->branch_id,
            'purchase_id'          => $this->purchase_id,
            'reference_number'     => $this->reference_number,
            'return_date'          => $this->return_date,
            'attachment_image'     => $this->attachment_image,

            'tax_type'             => $this->tax_type,
            'tax_value'            => $this->tax_value,
            'tax_amount'           => $this->tax_amount,

            'items_subtotal'       => $this->items_subtotal,
            'total_return_amount'  => $this->total_return_amount,

            'notes'                => $this->notes,
            'created_by'           => $this->created_by,
            'created_at'           => $this->created_at,
            'updated_at'           => $this->updated_at,

            'supplier' => $this->whenLoaded('supplier'),
            'branch'   => $this->whenLoaded('branch'),
            'purchase' => $this->whenLoaded('purchase'),
            'creator'  => $this->whenLoaded('creator'),

            'items' => $this->whenLoaded('items', function () {
                return $this->items->map(function ($item) {
                    return [
                        'id'         => $item->id,
                        'product_id' => $item->product_id,
                        'product'    => $item->relationLoaded('product') ? $item->product : null,
                        'quantity'   => $item->quantity,
                        'unit_price' => $item->unit_price,
                        'line_total' => $item->line_total,
                    ];
                });
            }),
        ];
    }
}
