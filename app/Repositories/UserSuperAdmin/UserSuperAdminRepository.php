<?php

namespace App\Repositories\UserSuperAdmin;

use App\Repositories\BaseRepository\BaseRepository;
use App\Models\Central\User;

class UserSuperAdminRepository extends BaseRepository implements UserSuperAdminRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
