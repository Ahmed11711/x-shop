<?php

namespace App\Repositories\Package;

use App\Models\Central\Package;
use App\Repositories\Package\PackageRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;

class PackageRepository extends BaseRepository implements PackageRepositoryInterface
{
    public function __construct(Package $model)
    {
        parent::__construct($model);
    }
    public function getFreePackage()
    {
        return $this->model->where('price', 0)->first();
    }
}
