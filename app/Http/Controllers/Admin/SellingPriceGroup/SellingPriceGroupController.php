<?php

namespace App\Http\Controllers\Admin\SellingPriceGroup;

use App\Repositories\SellingPriceGroup\SellingPriceGroupRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\SellingPriceGroup\SellingPriceGroupStoreRequest;
use App\Http\Requests\Admin\SellingPriceGroup\SellingPriceGroupUpdateRequest;
use App\Http\Resources\Admin\SellingPriceGroup\SellingPriceGroupResource;

class SellingPriceGroupController extends BaseController
{
    public function __construct(SellingPriceGroupRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'SellingPriceGroup'
        );

        $this->storeRequestClass = SellingPriceGroupStoreRequest::class;
        $this->updateRequestClass = SellingPriceGroupUpdateRequest::class;
        $this->resourceClass = SellingPriceGroupResource::class;
    }
}
