<?php

namespace App\Repositories\PurchaseReturn;

use App\Repositories\PurchaseReturn\PurchaseReturnRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\PurchaseReturn;

class PurchaseReturnRepository extends BaseRepository implements PurchaseReturnRepositoryInterface
{
    public function __construct(PurchaseReturn $model)
    {
        parent::__construct($model);
    }
}
