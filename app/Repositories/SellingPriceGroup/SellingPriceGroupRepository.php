<?php

namespace App\Repositories\SellingPriceGroup;

use App\Repositories\SellingPriceGroup\SellingPriceGroupRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\SellingPriceGroup;

class SellingPriceGroupRepository extends BaseRepository implements SellingPriceGroupRepositoryInterface
{
    public function __construct(SellingPriceGroup $model)
    {
        parent::__construct($model);
    }
}
