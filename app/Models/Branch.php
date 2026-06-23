<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{


    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
