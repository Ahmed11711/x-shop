<?php

namespace App\Http\Controllers\Api\Auth;

use \App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Http\Resources\Admin\Auth\LoginResource;
use App\Repositories\User\UserRepositoryInterface;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Hash;

use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    use ApiResponseTrait;
    public function __construct(public UserRepositoryInterface $userRepository) {}
    public function login(LoginRequest $request)
    {
        $data = $request->validated();


        $contact = $request->input('email') ?? $request->input('phone');

        $user = User::where('email', $contact)
            ->orWhere('phone', $contact)
            ->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return $this->errorResponse('Invalid credentials', 401);
        }

        $token = JWTAuth::claims([
            'tenant_id' => app('tenant')->id,
        ])->fromUser($user);

        return (new LoginResource($user))->additional([
            'meta' => [
                'access_token' => $token,
                'token_type'   => 'bearer',
            ]
        ]);
    }
}
