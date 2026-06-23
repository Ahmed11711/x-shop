<?php

namespace App\Http\Requests\Admin\Branch;
use App\Http\Requests\BaseRequest\BaseRequest;
class BranchUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'address' => 'nullable|sometimes|string|max:255',
            'phone' => 'nullable|sometimes|string|max:255',
            'manager_id' => 'nullable|sometimes|integer',
            'is_active' => 'sometimes|required|integer',
        ];
    }
}
