<?php

namespace App\Http\Requests\Admin\PermissionGroup;
use App\Http\Requests\BaseRequest\BaseRequest;
class PermissionGroupStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:permission_groups,name',
            'label' => 'nullable|string|max:255',
            'is_active' => 'required|integer',
        ];
    }
}
