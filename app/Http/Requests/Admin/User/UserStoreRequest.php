<?php

namespace App\Http\Requests\Admin\User;

use App\Http\Requests\BaseRequest\BaseRequest;

class UserStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'               => 'required|string|max:255',
            'email'              => 'required|string|email|max:255|unique:users,email',
            'email_verified_at'  => 'nullable|date',
            'password'           => 'required|string|max:255',
            'phone'              => 'required|string|unique:users,phone',
            'role'               => 'required|in:super_admin,admin,user,selsae',
            'commission_rate'    => 'required_if:role,selsae|nullable|numeric|min:0|max:100',
            'max_discount'       => 'required_if:role,selsae|nullable|numeric|min:0|max:100',
        ];
    }
}
