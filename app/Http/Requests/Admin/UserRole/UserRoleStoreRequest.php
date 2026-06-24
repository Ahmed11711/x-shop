<?php

namespace App\Http\Requests\Admin\UserRole;
use App\Http\Requests\BaseRequest\BaseRequest;
class UserRoleStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'role_id' => 'required|integer|exists:roles,id',
            'branch_id' => 'nullable|integer|exists:branches,id',
        ];
    }
}
