<?php

namespace App\Http\Requests\Admin\SellingPriceGroup;
use App\Http\Requests\BaseRequest\BaseRequest;
class SellingPriceGroupStoreRequest extends BaseRequest
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
        ];
    }
}
