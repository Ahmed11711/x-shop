<?php

namespace App\Http\Requests\Admin\Role;
use App\Http\Requests\BaseRequest\BaseRequest;
class RoleUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255|unique:roles,name,'.$this->route('role').',id',
            'description' => 'nullable|sometimes|string|max:255',
            'is_active' => 'sometimes|required|integer',
        ];
    }
}
