<?php

namespace App\Repositories\Purchase;

use App\Repositories\Purchase\PurchaseRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\Purchase;

class PurchaseRepository extends BaseRepository implements PurchaseRepositoryInterface
{
    public function __construct(Purchase $model)
    {
        parent::__construct($model);
    }
}
