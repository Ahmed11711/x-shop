<?php

namespace App\Http\Requests\Admin\UserPackage;
use App\Http\Requests\BaseRequest\BaseRequest;
class UserPackageStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'package_id' => 'required|integer|exists:packages,id',
            'package_name' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'active' => 'required|integer',
            'transaction_id' => 'nullable|string|max:255',
            'status' => 'required|in:pending,active,expired,cancelled,failed',
            'price' => 'required|numeric',
        ];
    }
}
