<?php

namespace App\Http\Requests\Admin\ProductUnit;
use App\Http\Requests\BaseRequest\BaseRequest;
class ProductUnitUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'short_name' => 'sometimes|required|string|max:255',
            'allow_decimal' => 'sometimes|required|integer',
            'is_multiple' => 'sometimes|required|integer',
            'base_unit' => 'nullable|sometimes|string|max:255',
            'times_base_unit' => 'nullable|sometimes|numeric',
        ];
    }
}
