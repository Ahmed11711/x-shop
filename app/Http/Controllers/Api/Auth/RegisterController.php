<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Central\Auth\RegisterRequest;
use App\Models\Central\User;
use App\Services\TenantService\CreateErpTenantService;

class RegisterController extends Controller
{

    public function __construct(
        public CreateErpTenantService $academyService,

    ) {}

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();


        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'] ?? null,
            'phone'    => $data['phone'] ?? null,
            'password' => bcrypt($data['password']),
            'role'     => 'admin',
        ]);

        $this->academyService->registerAcademyTenant($data);

        return response()->json([
            'message' => 'User registered successfully',
            'user'    => $user
        ], 201);
    }
}
