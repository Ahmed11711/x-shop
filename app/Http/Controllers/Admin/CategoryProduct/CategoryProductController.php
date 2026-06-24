<?php

namespace App\Http\Controllers\Admin\CategoryProduct;

use App\Repositories\CategoryProduct\CategoryProductRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\CategoryProduct\CategoryProductStoreRequest;
use App\Http\Requests\Admin\CategoryProduct\CategoryProductUpdateRequest;
use App\Http\Resources\Admin\CategoryProduct\CategoryProductResource;

class CategoryProductController extends BaseController
{
    public function __construct(CategoryProductRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'CategoryProduct'
        );

        $this->storeRequestClass = CategoryProductStoreRequest::class;
        $this->updateRequestClass = CategoryProductUpdateRequest::class;
        $this->resourceClass = CategoryProductResource::class;
    }
}
