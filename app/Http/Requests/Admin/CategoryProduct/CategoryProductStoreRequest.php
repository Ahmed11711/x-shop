<?php

namespace App\Http\Requests\Admin\CategoryProduct;
use App\Http\Requests\BaseRequest\BaseRequest;
class CategoryProductStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ];
    }
}
