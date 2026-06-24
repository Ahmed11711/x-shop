<?php

namespace App\Http\Resources\Admin\SellingPriceGroup;

use Illuminate\Http\Resources\Json\JsonResource;

class SellingPriceGroupResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
