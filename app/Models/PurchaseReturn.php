<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseReturn extends Model
{
    public const TYPE_PERCENTAGE = 'percentage';
    public const TYPE_FIXED      = 'fixed';

    public const TYPES = [
        self::TYPE_PERCENTAGE,
        self::TYPE_FIXED,
    ];

    protected $fillable = [
        'supplier_id',
        'branch_id',
        'purchase_id',
        'reference_number',
        'return_date',
        'attachment_image',
        'tax_type',
        'tax_value',
        'tax_amount',
        'items_subtotal',
        'total_return_amount',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'return_date'          => 'datetime',
        'tax_value'            => 'decimal:2',
        'tax_amount'           => 'decimal:2',
        'items_subtotal'       => 'decimal:2',
        'total_return_amount'  => 'decimal:2',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }

    public function items()
    {
        return $this->hasMany(PurchaseReturnItem::class, 'purchase_return_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
