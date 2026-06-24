<?php

namespace App\Http\Resources\Admin\ProductUnit;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductUnitResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'short_name' => $this->short_name,
            'allow_decimal' => $this->allow_decimal,
            'is_multiple' => $this->is_multiple,
            'base_unit' => $this->base_unit,
            'times_base_unit' => $this->times_base_unit,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
