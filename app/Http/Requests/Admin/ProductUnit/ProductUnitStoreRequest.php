<?php

namespace App\Http\Requests\Admin\ProductUnit;
use App\Http\Requests\BaseRequest\BaseRequest;
class ProductUnitStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'short_name' => 'required|string|max:255',
            'allow_decimal' => 'required|integer',
            'is_multiple' => 'required|integer',
            'base_unit' => 'nullable|string|max:255',
            'times_base_unit' => 'nullable|numeric',
        ];
    }
}
