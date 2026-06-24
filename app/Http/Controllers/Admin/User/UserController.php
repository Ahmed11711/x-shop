<?php

namespace App\Http\Controllers\Admin\User;

use App\Repositories\User\UserRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\User\UserStoreRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Http\Resources\Admin\User\UserResource;
use App\Models\SalespersonProfile;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function __construct(UserRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'User'
        );

        $this->storeRequestClass = UserStoreRequest::class;
        $this->updateRequestClass = UserUpdateRequest::class;
        $this->resourceClass = UserResource::class;
    }

    protected function beforeStore(array $data, Request $request): array
    {
        return collect($data)->except(['commission_rate', 'max_discount'])->toArray();
    }

    protected function beforeUpdate(array $data, $existingRecord, Request $request): array
    {
        return collect($data)->except(['commission_rate', 'max_discount'])->toArray();
    }

    protected function afterStore($record, Request $request): void
    {
        if ($record->role === 'selsae') {
            SalespersonProfile::create([
                'user_id'         => $record->id,
                'commission_rate' => $request->input('commission_rate', 0),
                'max_discount'    => $request->input('max_discount', 0),
            ]);
        }
    }

    protected function afterUpdate($updatedRecord, $oldRecord, Request $request): void
    {
        $isSalesNow = $updatedRecord->role === 'selsae';
        $hasProfile = $updatedRecord->salespersonProfile()->exists();

        if ($isSalesNow && !$hasProfile) {
            $updatedRecord->salespersonProfile()->create([
                'commission_rate' => $request->input('commission_rate', 0),
                'max_discount'    => $request->input('max_discount', 0),
            ]);
        } elseif ($isSalesNow && $hasProfile) {
            $updatedRecord->salespersonProfile()->update([
                'commission_rate' => $request->input('commission_rate'),
                'max_discount'    => $request->input('max_discount'),
            ]);
        } elseif (!$isSalesNow && $hasProfile) {
            $updatedRecord->salespersonProfile()->delete();
        }
    }
}
