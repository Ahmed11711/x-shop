<?php

namespace App\Http\Requests\Admin\suppliers;
use App\Http\Requests\BaseRequest\BaseRequest;
class suppliersStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'supplier_name' => 'required|string|max:150',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|string|max:150',
            'address' => 'nullable|string|max:255',
            'is_active' => 'required|integer',
        ];
    }
}
