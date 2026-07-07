<?php

namespace App\Http\Requests\Admin\suppliers;
use App\Http\Requests\BaseRequest\BaseRequest;
class suppliersUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'supplier_name' => 'sometimes|required|string|max:150',
            'phone' => 'nullable|sometimes|string|max:30',
            'email' => 'nullable|sometimes|string|max:150',
            'address' => 'nullable|sometimes|string|max:255',
            'is_active' => 'sometimes|required|integer',
        ];
    }
}
