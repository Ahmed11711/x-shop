<?php

namespace App\Repositories\ProductUnit;

use App\Repositories\ProductUnit\ProductUnitRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\ProductUnit;

class ProductUnitRepository extends BaseRepository implements ProductUnitRepositoryInterface
{
    public function __construct(ProductUnit $model)
    {
        parent::__construct($model);
    }
}
