<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    // ==== الحالات (Status Constants) ====
    public const STATUS_DRAFT     = 'draft';
    public const STATUS_RECEIVED  = 'received';
    public const STATUS_PENDING   = 'pending';
    public const STATUS_CANCELLED = 'cancelled';

    public const STATUSES = [
        self::STATUS_DRAFT,
        self::STATUS_RECEIVED,
        self::STATUS_PENDING,
        self::STATUS_CANCELLED,
    ];

    // ==== أنواع الخصم/الضريبة ====
    public const TYPE_PERCENTAGE = 'percentage';
    public const TYPE_FIXED      = 'fixed';

    public const TYPES = [
        self::TYPE_PERCENTAGE,
        self::TYPE_FIXED,
    ];



    protected $casts = [
        'purchase_date'         => 'datetime',
        'discount_value'        => 'decimal:2',
        'discount_amount'       => 'decimal:2',
        'tax_value'             => 'decimal:2',
        'tax_amount'            => 'decimal:2',
        'shipping_cost_total'   => 'decimal:2',
        'total_purchase_amount' => 'decimal:2',
        'total_paid'            => 'decimal:2',
        'due_amount'            => 'decimal:2',
    ];

    // ==== العلاقات ====

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function items()
    {
        return $this->hasMany(PurchaseItem::class, 'purchase_id');
    }

    public function expenses()
    {
        return $this->hasMany(PurchaseExpense::class, 'purchase_id');
    }

    public function installments()
    {
        return $this->hasMany(PurchaseInstallment::class, 'purchase_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // ==== Scopes مفيدة ====

    public function scopeStatus($query, string $status)
    {
        return $query->where('purchase_status', $status);
    }

    public function scopeUnpaid($query)
    {
        return $query->where('due_amount', '>', 0);
    }

    // ==== Accessors مساعدة ====

    public function isFullyPaid(): bool
    {
        return (float) $this->due_amount <= 0;
    }
}
