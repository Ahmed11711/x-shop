<?php

namespace App\Repositories\Role;

use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\Role;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
