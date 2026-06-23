<?php

namespace App\Http\Requests\Admin\PermissionGroup;
use App\Http\Requests\BaseRequest\BaseRequest;
class PermissionGroupUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255|unique:permission_groups,name,'.$this->route('permissionGroup').',id',
            'label' => 'nullable|sometimes|string|max:255',
            'is_active' => 'sometimes|required|integer',
        ];
    }
}
