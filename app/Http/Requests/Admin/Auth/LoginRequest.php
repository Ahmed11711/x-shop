<?php

namespace App\Http\Requests\Admin\Auth;

use App\Http\Requests\BaseRequest\BaseRequest;


class LoginRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'email'    => 'required_without:phone|string',
            'phone'    => 'required_without:email|string',
            'password' => 'required|string'
        ];
    }
}
