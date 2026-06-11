<?php

namespace App\Http\Requests\Central\Auth;

use App\Http\Requests\BaseRequest\BaseRequest;


class RegisterRequest extends BaseRequest
{



    public function rules(): array
    {
        return [
            'name'         => 'required|string|max:255',
            'username'     => 'required|string|max:255|unique:users,username',
            'email'        => 'required|email|unique:users,email',
            'phone'        => 'required|string|unique:users,phone',
            'password'     => 'required|string|min:6',
            'link_academy' => 'required|string|unique:xshop_central.tenants,domain',
        ];
    }
}
