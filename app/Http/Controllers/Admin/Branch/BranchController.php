<?php

namespace App\Http\Controllers\Admin\Branch;

use App\Repositories\Branch\BranchRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\Branch\BranchStoreRequest;
use App\Http\Requests\Admin\Branch\BranchUpdateRequest;
use App\Http\Resources\Admin\Branch\BranchResource;

class BranchController extends BaseController
{
    public function __construct(BranchRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'Branch'
        );

        $this->storeRequestClass = BranchStoreRequest::class;
        $this->updateRequestClass = BranchUpdateRequest::class;
        $this->resourceClass = BranchResource::class;
    }
}
