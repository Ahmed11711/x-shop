<?php

namespace App\Http\Controllers\Admin\ProductUnit;

use App\Repositories\ProductUnit\ProductUnitRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\ProductUnit\ProductUnitStoreRequest;
use App\Http\Requests\Admin\ProductUnit\ProductUnitUpdateRequest;
use App\Http\Resources\Admin\ProductUnit\ProductUnitResource;

class ProductUnitController extends BaseController
{
    public function __construct(ProductUnitRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'ProductUnit'
        );

        $this->storeRequestClass = ProductUnitStoreRequest::class;
        $this->updateRequestClass = ProductUnitUpdateRequest::class;
        $this->resourceClass = ProductUnitResource::class;
    }
}
