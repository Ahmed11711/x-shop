<?php

namespace App\Repositories\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\Product;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
}
