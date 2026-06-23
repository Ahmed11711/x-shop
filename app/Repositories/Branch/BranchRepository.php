<?php

namespace App\Repositories\Branch;

use App\Repositories\Branch\BranchRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\Branch;

class BranchRepository extends BaseRepository implements BranchRepositoryInterface
{
    public function __construct(Branch $model)
    {
        parent::__construct($model);
    }
}
