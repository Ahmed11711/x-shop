<?php

namespace App\Repositories\UserRole;

use App\Repositories\UserRole\UserRoleRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\UserRole;

class UserRoleRepository extends BaseRepository implements UserRoleRepositoryInterface
{
    public function __construct(UserRole $model)
    {
        parent::__construct($model);
    }
}
