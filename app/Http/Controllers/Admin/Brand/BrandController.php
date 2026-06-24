<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Repositories\Brand\BrandRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\Brand\BrandStoreRequest;
use App\Http\Requests\Admin\Brand\BrandUpdateRequest;
use App\Http\Resources\Admin\Brand\BrandResource;

class BrandController extends BaseController
{
    public function __construct(BrandRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'Brand'
        );

        $this->storeRequestClass = BrandStoreRequest::class;
        $this->updateRequestClass = BrandUpdateRequest::class;
        $this->resourceClass = BrandResource::class;
    }
}
