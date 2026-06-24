<?php

namespace App\Http\Controllers\Admin\Warranty;

use App\Repositories\Warranty\WarrantyRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\Warranty\WarrantyStoreRequest;
use App\Http\Requests\Admin\Warranty\WarrantyUpdateRequest;
use App\Http\Resources\Admin\Warranty\WarrantyResource;

class WarrantyController extends BaseController
{
    public function __construct(WarrantyRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'Warranty'
        );

        $this->storeRequestClass = WarrantyStoreRequest::class;
        $this->updateRequestClass = WarrantyUpdateRequest::class;
        $this->resourceClass = WarrantyResource::class;
    }
}
