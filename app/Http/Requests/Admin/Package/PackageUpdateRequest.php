<?php

namespace App\Http\Requests\Admin\Package;
use App\Http\Requests\BaseRequest\BaseRequest;
class PackageUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'desc' => 'nullable|sometimes|string',
            'price' => 'sometimes|required|numeric',
            'discount' => 'sometimes|required|numeric',
            'is_active' => 'sometimes|required|integer',
            'duration_months' => 'sometimes|required|numeric',
            'order' => 'sometimes|required|integer',
            'recommended' => 'sometimes|required|integer',
        ];
    }
}
