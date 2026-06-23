<?php

namespace App\Http\Controllers\Admin\PermissionGroup;

use App\Repositories\PermissionGroup\PermissionGroupRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\PermissionGroup\PermissionGroupStoreRequest;
use App\Http\Requests\Admin\PermissionGroup\PermissionGroupUpdateRequest;
use App\Http\Resources\Admin\PermissionGroup\PermissionGroupResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PermissionGroupController extends BaseController
{
    public function __construct(PermissionGroupRepositoryInterface $repository)
    {
        parent::__construct();
        $this->initService(
            repository: $repository,
            collectionName: 'PermissionGroup'
        );
        $this->storeRequestClass  = PermissionGroupStoreRequest::class;
        $this->updateRequestClass = PermissionGroupUpdateRequest::class;
        $this->resourceClass      = PermissionGroupResource::class;
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $validated = app($this->updateRequestClass)->validated();

        $record = $this->applyScoping($this->repository->query())->find($id);

        if (!$record) {
            return $this->errorResponse("Record not found or unauthorized", 404);
        }

        try {
            DB::beginTransaction();

            $oldRecord = clone $record;

            $record->update($validated);

            $this->afterUpdate($record, $oldRecord, $request);

            DB::commit();

            $record->load($this->withRelationships);

            return $this->successResponse(
                new $this->resourceClass($record),
                'Record updated successfully'
            );
        } catch (\Symfony\Component\HttpKernel\Exception\HttpException $e) {
            DB::rollBack();
            return $this->errorResponse($e->getMessage(), $e->getStatusCode());
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("Error updating PermissionGroup: " . $e->getMessage());
            return $this->errorResponse("Failed to update record", 500);
        }
    }

    protected function afterStore($record, Request $request): void
    {
        $exists = DB::table('permissions')
            ->where('permission_group_id', $record->id)
            ->exists();

        if ($exists) return;

        $groupName = strtolower($record->name);
        $now       = now();

        $rows = array_map(fn($suffix) => [
            'permission_group_id' => $record->id,
            'name'                => "{$groupName}.{$suffix}",
            'label'               => ucfirst($suffix) . ' ' . $record->name,
            'is_active'           => true,
            'created_at'          => $now,
            'updated_at'          => $now,
        ], ['view', 'create', 'update', 'delete']);

        DB::table('permissions')->insert($rows);
    }

    protected function afterUpdate($updatedRecord, $oldRecord, Request $request): void
    {
        $newGroupName = strtolower($updatedRecord->name);
        $oldGroupName = strtolower($oldRecord->name);

        $crudSuffixes = ['view', 'create', 'update', 'delete'];

        $existingPermissions = DB::table('permissions')
            ->where('permission_group_id', $updatedRecord->id)
            ->get(['id', 'name']);

        $existingSuffixes = $existingPermissions
            ->map(fn($p) => last(explode('.', $p->name)))
            ->toArray();

        // لو الاسم اتغير → حدّث الـ name والـ label للموجودين
        if ($newGroupName !== $oldGroupName) {
            foreach ($existingPermissions as $perm) {
                $suffix = last(explode('.', $perm->name));
                DB::table('permissions')
                    ->where('id', $perm->id)
                    ->update([
                        'name'       => "{$newGroupName}.{$suffix}",
                        'label'      => ucfirst($suffix) . ' ' . $updatedRecord->name,
                        'updated_at' => now(),
                    ]);
            }
        }

        // ضيف البس الـ CRUD الناقصة
        $missingSuffixes = array_diff($crudSuffixes, $existingSuffixes);

        if (!empty($missingSuffixes)) {
            $now  = now();
            $rows = [];

            foreach ($missingSuffixes as $suffix) {
                $rows[] = [
                    'permission_group_id' => $updatedRecord->id,
                    'name'                => "{$newGroupName}.{$suffix}",
                    'label'               => ucfirst($suffix) . ' ' . $updatedRecord->name,
                    'is_active'           => true,
                    'created_at'          => $now,
                    'updated_at'          => $now,
                ];
            }

            DB::table('permissions')->insert($rows);
        }
    }
}
