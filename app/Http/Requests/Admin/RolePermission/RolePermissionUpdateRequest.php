<?php

namespace App\Http\Requests\Admin\RolePermission;
use App\Http\Requests\BaseRequest\BaseRequest;
class RolePermissionUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role_id' => 'sometimes|required|integer|exists:roles,id',
            'permission_id' => 'sometimes|required|integer|exists:permissions,id',
        ];
    }
}
