<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseExpense extends Model
{

    protected $casts = [
        'expense_amount' => 'decimal:2',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }
}
