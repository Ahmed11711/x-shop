<?php

namespace App\Repositories\Brand;

use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\Brand;

class BrandRepository extends BaseRepository implements BrandRepositoryInterface
{
    public function __construct(Brand $model)
    {
        parent::__construct($model);
    }
}
