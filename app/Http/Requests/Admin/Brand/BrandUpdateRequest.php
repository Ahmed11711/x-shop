<?php

namespace App\Http\Requests\Admin\Brand;
use App\Http\Requests\BaseRequest\BaseRequest;
class BrandUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'short_description' => 'nullable|sometimes|string|max:255',
        ];
    }
}
