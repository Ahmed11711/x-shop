<?php

namespace App\Http\Requests\Admin\UserRole;
use App\Http\Requests\BaseRequest\BaseRequest;
class UserRoleUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|required|integer|exists:users,id',
            'role_id' => 'sometimes|required|integer|exists:roles,id',
            'branch_id' => 'nullable|sometimes|integer|exists:branches,id',
        ];
    }
}
