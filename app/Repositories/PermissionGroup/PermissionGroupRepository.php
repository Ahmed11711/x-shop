<?php

namespace App\Repositories\PermissionGroup;

use App\Repositories\PermissionGroup\PermissionGroupRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\PermissionGroup;

class PermissionGroupRepository extends BaseRepository implements PermissionGroupRepositoryInterface
{
    public function __construct(PermissionGroup $model)
    {
        parent::__construct($model);
    }
}
