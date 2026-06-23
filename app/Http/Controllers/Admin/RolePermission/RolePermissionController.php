<?php

namespace App\Http\Controllers\Admin\RolePermission;

use App\Repositories\RolePermission\RolePermissionRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\RolePermission\RolePermissionStoreRequest;
use App\Http\Requests\Admin\RolePermission\RolePermissionUpdateRequest;
use App\Http\Resources\Admin\RolePermission\RolePermissionResource;

class RolePermissionController extends BaseController
{
    public function __construct(RolePermissionRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'RolePermission'
        );

        $this->storeRequestClass = RolePermissionStoreRequest::class;
        $this->updateRequestClass = RolePermissionUpdateRequest::class;
        $this->resourceClass = RolePermissionResource::class;
    }
}
