<?php

namespace App\Repositories\CategoryProduct;

use App\Repositories\CategoryProduct\CategoryProductRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\CategoryProduct;

class CategoryProductRepository extends BaseRepository implements CategoryProductRepositoryInterface
{
    public function __construct(CategoryProduct $model)
    {
        parent::__construct($model);
    }
}
