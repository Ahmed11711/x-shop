<?php

namespace App\Http\Requests\Admin\Role;
use App\Http\Requests\BaseRequest\BaseRequest;
class RoleStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:roles,name',
            'description' => 'nullable|string|max:255',
            'is_active' => 'required|integer',
        ];
    }
}
