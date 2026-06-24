<?php

namespace App\Http\Requests\Admin\CustomerGroup;
use App\Http\Requests\BaseRequest\BaseRequest;
class CustomerGroupUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'calculation_type' => 'nullable|sometimes|in:percentage,fixed',
            'calculation_percentage' => 'nullable|sometimes|numeric',
        ];
    }
}
