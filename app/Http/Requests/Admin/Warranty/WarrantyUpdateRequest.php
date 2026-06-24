<?php

namespace App\Http\Requests\Admin\Warranty;
use App\Http\Requests\BaseRequest\BaseRequest;
class WarrantyUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|sometimes|string',
            'duration' => 'sometimes|required|integer',
            'duration_type' => 'sometimes|required|in:days,months,years',
        ];
    }
}
