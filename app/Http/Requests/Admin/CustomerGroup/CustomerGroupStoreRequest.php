<?php

namespace App\Http\Requests\Admin\CustomerGroup;
use App\Http\Requests\BaseRequest\BaseRequest;
class CustomerGroupStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'calculation_type' => 'nullable|in:percentage,fixed',
            'calculation_percentage' => 'nullable|numeric',
        ];
    }
}
