<?php

namespace App\Repositories\Warranty;

use App\Repositories\Warranty\WarrantyRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\Warranty;

class WarrantyRepository extends BaseRepository implements WarrantyRepositoryInterface
{
    public function __construct(Warranty $model)
    {
        parent::__construct($model);
    }
}
