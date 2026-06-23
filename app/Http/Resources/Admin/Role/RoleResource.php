<?php

namespace App\Http\Resources\Admin\Role;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'is_active'   => $this->is_active,
            'permissions' => $this->whenLoaded(
                'permissions',
                fn() =>
                $this->permissions->map(fn($p) => [
                    'id'    => $p->id,
                    'name'  => $p->name,
                    'label' => $p->label,
                ])
            ),
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}
