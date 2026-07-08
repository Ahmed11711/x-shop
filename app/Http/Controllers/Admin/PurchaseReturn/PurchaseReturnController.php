<?php

namespace App\Http\Controllers\Admin\PurchaseReturn;

use App\Repositories\PurchaseReturn\PurchaseReturnRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\PurchaseReturn\PurchaseReturnStoreRequest;
use App\Http\Requests\Admin\PurchaseReturn\PurchaseReturnUpdateRequest;
use App\Http\Resources\Admin\PurchaseReturn\PurchaseReturnResource;
use Illuminate\Http\Request;

class PurchaseReturnController extends BaseController
{
    public function __construct(PurchaseReturnRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'PurchaseReturn',
            fileFields: ['attachment_image']
        );

        $this->storeRequestClass = PurchaseReturnStoreRequest::class;
        $this->updateRequestClass = PurchaseReturnUpdateRequest::class;
        $this->resourceClass = PurchaseReturnResource::class;

        $this->withRelationships = [
            'supplier',
            'branch',
            'purchase',
            'items.product',
            'creator',
        ];
    }

    protected function beforeStore(array $data, Request $request): array
    {
        $data['created_by'] =  1;

        $totals = $this->calculateTotals($request);
        $data['items_subtotal']      = $totals['items_subtotal'];
        $data['tax_amount']          = $totals['tax_amount'];
        $data['total_return_amount'] = $totals['total_return_amount'];

        unset($data['items']);

        return $data;
    }

    protected function afterStore($record, Request $request): void
    {
        $this->syncItems($record, $request->input('items', []));
        $this->decrementStock($record);
    }

    protected function beforeUpdate(array $data, $existingRecord, Request $request): array
    {
        $totals = $this->calculateTotals($request);
        $data['items_subtotal']      = $totals['items_subtotal'];
        $data['tax_amount']          = $totals['tax_amount'];
        $data['total_return_amount'] = $totals['total_return_amount'];

        unset($data['items']);

        return $data;
    }

    protected function afterUpdate($updatedRecord, $oldRecord, Request $request): void
    {
        $this->syncItems($updatedRecord, $request->input('items', []));
        // ملحوظة: لو عدّلت الكميات بعد ما المخزون اتخصم، محتاج منطق فرق (diff)
        // بدل خصم تاني كامل. سيبتها كتنبيه تحت.
    }

    protected function syncItems($purchaseReturn, array $items): void
    {
        $incomingIds = collect($items)->pluck('id')->filter()->all();

        $purchaseReturn->items()
            ->whereNotIn('id', $incomingIds)
            ->delete();

        foreach ($items as $item) {
            $itemData = [
                'product_id' => $item['product_id'],
                'quantity'   => $item['quantity'],
                'unit_price' => $item['unit_price'] ?? 0,
                'line_total' => $this->calculateLineTotal($item),
            ];

            if (!empty($item['id'])) {
                $purchaseReturn->items()->where('id', $item['id'])->update($itemData);
            } else {
                $purchaseReturn->items()->create($itemData);
            }
        }
    }


    protected function decrementStock($purchaseReturn): void
    {
        foreach ($purchaseReturn->items as $item) {
            \App\Models\ProductBranch::where('product_id', $item->product_id)
                ->where('branch_id', $purchaseReturn->branch_id)
                ->decrement('quantity', $item->quantity);
        }
    }
    protected function calculateTotals(Request $request): array
    {
        $items = $request->input('items', []);

        $itemsSubtotal = collect($items)->sum(function ($item) {
            return $this->calculateLineTotal($item);
        });

        $taxType  = $request->input('tax_type');
        $taxValue = (float) $request->input('tax_value', 0);
        $taxAmount = $taxType === 'percentage'
            ? $itemsSubtotal * ($taxValue / 100)
            : $taxValue;

        $totalReturnAmount = $itemsSubtotal + $taxAmount;

        return [
            'items_subtotal'       => round($itemsSubtotal, 2),
            'tax_amount'           => round($taxAmount, 2),
            'total_return_amount'  => round($totalReturnAmount, 2),
        ];
    }

    protected function calculateLineTotal(array $item): float
    {
        $qty   = (float) ($item['quantity'] ?? 0);
        $price = (float) ($item['unit_price'] ?? 0);

        return round($qty * $price, 2);
    }
}
