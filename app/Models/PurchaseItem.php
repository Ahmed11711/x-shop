<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{

    protected $casts = [
        'quantity'                  => 'decimal:3',
        'unit_cost_before_discount' => 'decimal:4',
        'discount_percentage'       => 'decimal:3',
        'unit_cost_before_tax'      => 'decimal:4',
        'line_total'                => 'decimal:2',
        'profit_margin_percentage'  => 'decimal:3',
        'unit_sale_price_incl_tax'  => 'decimal:4',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
