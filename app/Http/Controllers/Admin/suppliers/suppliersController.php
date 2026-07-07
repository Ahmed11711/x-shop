<?php

namespace App\Http\Controllers\Admin\suppliers;

use App\Repositories\suppliers\suppliersRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\suppliers\suppliersStoreRequest;
use App\Http\Requests\Admin\suppliers\suppliersUpdateRequest;
use App\Http\Resources\Admin\suppliers\suppliersResource;

class suppliersController extends BaseController
{
    public function __construct(suppliersRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'suppliers'
        );

        $this->storeRequestClass = suppliersStoreRequest::class;
        $this->updateRequestClass = suppliersUpdateRequest::class;
        $this->resourceClass = suppliersResource::class;
    }
}
