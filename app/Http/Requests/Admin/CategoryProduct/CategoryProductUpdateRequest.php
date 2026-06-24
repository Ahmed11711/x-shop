<?php

namespace App\Http\Requests\Admin\CategoryProduct;
use App\Http\Requests\BaseRequest\BaseRequest;
class CategoryProductUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'code' => 'nullable|sometimes|string|max:255',
            'description' => 'nullable|sometimes|string',
        ];
    }
}
