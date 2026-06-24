<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Repositories\Contact\ContactRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\Contact\ContactStoreRequest;
use App\Http\Requests\Admin\Contact\ContactUpdateRequest;
use App\Http\Resources\Admin\Contact\ContactResource;

class ContactController extends BaseController
{
    public function __construct(ContactRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'Contact'
        );

        $this->storeRequestClass = ContactStoreRequest::class;
        $this->updateRequestClass = ContactUpdateRequest::class;
        $this->resourceClass = ContactResource::class;
    }
}
