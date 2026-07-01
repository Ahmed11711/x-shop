<?php

namespace App\Http\Controllers\Admin\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\Product\ProductStoreRequest;
use App\Http\Requests\Admin\Product\ProductUpdateRequest;
use App\Http\Resources\Admin\Product\ProductResource;

class ProductController extends BaseController
{
    public function __construct(ProductRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'products',
            fileFields: ['image', 'product_brochure'],
        );

        $this->storeRequestClass  = ProductStoreRequest::class;
        $this->updateRequestClass = ProductUpdateRequest::class;
        $this->resourceClass      = ProductResource::class;

        $this->withRelationships = [
            'category',
            'brand',
        ];
    }
}
