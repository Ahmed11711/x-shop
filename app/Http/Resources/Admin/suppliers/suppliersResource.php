<?php

namespace App\Http\Resources\Admin\suppliers;

use Illuminate\Http\Resources\Json\JsonResource;

class suppliersResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'supplier_name' => $this->supplier_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
