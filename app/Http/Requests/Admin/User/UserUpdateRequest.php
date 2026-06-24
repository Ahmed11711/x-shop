<?php

namespace App\Http\Requests\Admin\User;

use App\Http\Requests\BaseRequest\BaseRequest;

class UserUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'               => 'sometimes|required|string|max:255',
            'email'              => 'sometimes|required|string|email|max:255|unique:users,email,' . $this->route('user') . ',id',
            'email_verified_at'  => 'nullable|sometimes|date',
            'password'           => 'sometimes|required|string|max:255',
            'phone'              => 'sometimes|required|string|unique:users,phone,' . $this->route('user') . ',id',
            'role'               => 'sometimes|required|in:super_admin,admin,user,selsae',
            'commission_rate'    => 'required_if:role,selsae|nullable|numeric|min:0|max:100',
            'max_discount'       => 'required_if:role,selsae|nullable|numeric|min:0|max:100',
        ];
    }
}
