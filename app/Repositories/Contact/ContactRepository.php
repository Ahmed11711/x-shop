<?php

namespace App\Repositories\Contact;

use App\Repositories\Contact\ContactRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\Contact;

class ContactRepository extends BaseRepository implements ContactRepositoryInterface
{
    public function __construct(Contact $model)
    {
        parent::__construct($model);
    }
}
