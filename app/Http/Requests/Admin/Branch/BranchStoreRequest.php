<?php

namespace App\Http\Requests\Admin\Branch;
use App\Http\Requests\BaseRequest\BaseRequest;
class BranchStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'manager_id' => 'nullable|integer',
            'is_active' => 'required|integer',
        ];
    }
}
