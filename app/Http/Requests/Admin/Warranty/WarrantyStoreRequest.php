<?php

namespace App\Http\Requests\Admin\Warranty;
use App\Http\Requests\BaseRequest\BaseRequest;
class WarrantyStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer',
            'duration_type' => 'required|in:days,months,years',
        ];
    }
}
