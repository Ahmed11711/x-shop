<?php

namespace App\Http\Resources\Admin\Package;

use App\Http\Resources\Admin\FeaturePackage\FeaturePackageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'desc' => $this->desc,
            'price' => $this->price,
            'discount' => $this->discount,
            'is_active' => $this->is_active,
            'duration_months' => $this->duration_months,
            'order' => $this->order,
            'recommended' => $this->recommended,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'features' => FeaturePackageResource::collection($this->whenLoaded('packageFeatures')),

        ];
    }
}
