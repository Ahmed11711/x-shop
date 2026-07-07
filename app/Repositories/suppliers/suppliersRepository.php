<?php

namespace App\Repositories\suppliers;

use App\Repositories\suppliers\suppliersRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\supplier;

class suppliersRepository extends BaseRepository implements suppliersRepositoryInterface
{
    public function __construct(supplier $model)
    {
        parent::__construct($model);
    }
}
