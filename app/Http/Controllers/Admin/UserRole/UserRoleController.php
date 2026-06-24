<?php

namespace App\Http\Controllers\Admin\UserRole;

use App\Repositories\UserRole\UserRoleRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\UserRole\UserRoleStoreRequest;
use App\Http\Requests\Admin\UserRole\UserRoleUpdateRequest;
use App\Http\Resources\Admin\UserRole\UserRoleResource;

class UserRoleController extends BaseController
{
    public function __construct(UserRoleRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'UserRole'
        );

        $this->storeRequestClass = UserRoleStoreRequest::class;
        $this->updateRequestClass = UserRoleUpdateRequest::class;
        $this->resourceClass = UserRoleResource::class;
    }
}
