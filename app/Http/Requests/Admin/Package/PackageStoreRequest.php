<?php

namespace App\Http\Requests\Admin\Package;
use App\Http\Requests\BaseRequest\BaseRequest;
class PackageStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'is_active' => 'required|integer',
            'duration_months' => 'required|numeric',
            'order' => 'required|integer',
            'recommended' => 'required|integer',
        ];
    }
}
