<?php

namespace App\Http\Requests\Admin\Brand;
use App\Http\Requests\BaseRequest\BaseRequest;
class BrandStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
        ];
    }
}
