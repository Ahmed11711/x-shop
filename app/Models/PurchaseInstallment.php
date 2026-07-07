<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseInstallment extends Model
{


    protected $casts = [
        'prior_balance' => 'decimal:2',
        'paid_on'       => 'datetime',
        'amount'        => 'decimal:2',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
