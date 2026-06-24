<?php

namespace App\Http\Controllers\Admin\CustomerGroup;

use App\Repositories\CustomerGroup\CustomerGroupRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\CustomerGroup\CustomerGroupStoreRequest;
use App\Http\Requests\Admin\CustomerGroup\CustomerGroupUpdateRequest;
use App\Http\Resources\Admin\CustomerGroup\CustomerGroupResource;

class CustomerGroupController extends BaseController
{
    public function __construct(CustomerGroupRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'CustomerGroup'
        );

        $this->storeRequestClass = CustomerGroupStoreRequest::class;
        $this->updateRequestClass = CustomerGroupUpdateRequest::class;
        $this->resourceClass = CustomerGroupResource::class;
    }
}
