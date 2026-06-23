<?php

namespace App\Repositories\RolePermission;

use App\Repositories\RolePermission\RolePermissionRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\RolePermission;

class RolePermissionRepository extends BaseRepository implements RolePermissionRepositoryInterface
{
    public function __construct(RolePermission $model)
    {
        parent::__construct($model);
    }
}
