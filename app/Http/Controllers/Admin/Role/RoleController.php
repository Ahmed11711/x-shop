<?php

namespace App\Http\Controllers\Admin\Role;

use App\Repositories\Role\RoleRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\Role\RoleStoreRequest;
use App\Http\Requests\Admin\Role\RoleUpdateRequest;
use App\Http\Resources\Admin\Role\RoleResource;

class RoleController extends BaseController
{
    public function __construct(RoleRepositoryInterface $repository)
    {
        parent::__construct();
        $this->initService(
            repository: $repository,
            collectionName: 'Role'
        );
        $this->storeRequestClass  = RoleStoreRequest::class;
        $this->updateRequestClass = RoleUpdateRequest::class;
        $this->resourceClass      = RoleResource::class;
    }

    protected function getShowRelationships(): array
    {
        return ['permissions'];
    }
}
