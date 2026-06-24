<?php

namespace App\Repositories\CustomerGroup;

use App\Repositories\CustomerGroup\CustomerGroupRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\CustomerGroup;

class CustomerGroupRepository extends BaseRepository implements CustomerGroupRepositoryInterface
{
    public function __construct(CustomerGroup $model)
    {
        parent::__construct($model);
    }
}
