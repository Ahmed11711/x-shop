<?php

namespace App\Repositories\User;

use App\Models\Central\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
