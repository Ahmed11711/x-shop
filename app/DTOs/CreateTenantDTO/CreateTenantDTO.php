<?php
// app/DTOs/CreateTenantDTO.php
namespace App\DTOs;

use Illuminate\Http\Request;

class CreateTenantDTO
{
    public function __construct(
        public readonly int $userId,
        public readonly string $name,
        public readonly string $username,
        public readonly string $domain,
        public readonly string $password,
        public readonly ?string $email = null,
        public readonly ?string $phone = null,
        public readonly mixed $passedPackage = null,
        public readonly mixed $passedFeatures = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            userId: $data['user_id'],
            name: $data['name'],
            username: $data['username'],
            domain: $data['domain'],
            password: $data['password'],
            email: $data['email'] ?? $data['user_email'] ?? null,
            phone: $data['phone'] ?? null,
            passedPackage: $data['passed_package'] ?? null,
            passedFeatures: $data['passed_features'] ?? collect(),
        );
    }

    public static function fromRequest(Request $request): self
    {
        return self::fromArray($request->validated());
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'name' => $this->name,
            'username' => $this->username,
            'domain' => $this->domain,
            'password' => $this->password,
            'email' => $this->email,
            'phone' => $this->phone,
            'passed_package' => $this->passedPackage,
            'passed_features' => $this->passedFeatures,
        ];
    }
}
