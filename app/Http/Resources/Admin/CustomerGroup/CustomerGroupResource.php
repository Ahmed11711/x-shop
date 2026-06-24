<?php

namespace App\Http\Resources\Admin\CustomerGroup;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerGroupResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'calculation_type' => $this->calculation_type,
            'calculation_percentage' => $this->calculation_percentage,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
