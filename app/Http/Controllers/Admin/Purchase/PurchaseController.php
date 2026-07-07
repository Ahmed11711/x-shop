<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Repositories\Purchase\PurchaseRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\Purchase\PurchaseStoreRequest;
use App\Http\Requests\Admin\Purchase\PurchaseUpdateRequest;
use App\Http\Resources\Admin\Purchase\PurchaseResource;
use Illuminate\Http\Request;

class PurchaseController extends BaseController
{
    public function __construct(PurchaseRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'Purchase',
            fileFields: ['attachment_image']
        );

        $this->storeRequestClass = PurchaseStoreRequest::class;
        $this->updateRequestClass = PurchaseUpdateRequest::class;
        $this->resourceClass = PurchaseResource::class;

        $this->withRelationships = [
            'supplier',
            'branch',
            'items.product',
            'expenses',
            'installments',
            'creator',
        ];
    }

    /**
     * قبل الحفظ: نحسب الإجماليات من العناصر المرسلة،
     * نضيف created_by، ونشيل أي مفاتيح مش أعمدة فعلية في جدول purchases.
     */
    protected function beforeStore(array $data, Request $request): array
    {
        $data['created_by'] = 1; // fallback مؤقت لحد ما الـ auth يشتغل

        $totals = $this->calculateTotals($request);

        $data['total_purchase_amount'] = $totals['total_purchase_amount'];
        $data['discount_amount']       = $totals['discount_amount'];
        $data['tax_amount']            = $totals['tax_amount'];
        $data['shipping_cost_total']   = $totals['shipping_cost_total'];
        $data['total_paid']            = $totals['total_paid'];
        $data['due_amount']            = $totals['due_amount'];

        // مهم جدًا: دول مش أعمدة في جدول purchases، لازم يتشالوا قبل الـ create()
        unset($data['items'], $data['expenses'], $data['installment']);

        return $data;
    }

    /**
     * بعد إنشاء صف purchases: نحفظ العناصر والمصاريف والقسط الأول.
     */
    protected function afterStore($record, Request $request): void
    {
        $this->syncItems($record, $request->input('items', []));
        $this->syncExpenses($record, $request->input('expenses', []));
        $this->storeInitialInstallment($record, $request);
    }

    /**
     * قبل التحديث: نفس منطق حساب الإجماليات وتنظيف الـ data.
     */
    protected function beforeUpdate(array $data, $existingRecord, Request $request): array
    {
        $totals = $this->calculateTotals($request, $existingRecord);

        $data['total_purchase_amount'] = $totals['total_purchase_amount'];
        $data['discount_amount']       = $totals['discount_amount'];
        $data['tax_amount']            = $totals['tax_amount'];
        $data['shipping_cost_total']   = $totals['shipping_cost_total'];
        $data['total_paid']            = $totals['total_paid'];
        $data['due_amount']            = $totals['due_amount'];

        unset($data['items'], $data['expenses'], $data['installment']);

        return $data;
    }

    /**
     * بعد التحديث: مزامنة العناصر والمصاريف (حذف/تعديل/إضافة).
     */
    protected function afterUpdate($updatedRecord, $oldRecord, Request $request): void
    {
        $this->syncItems($updatedRecord, $request->input('items', []));
        $this->syncExpenses($updatedRecord, $request->input('expenses', []));
    }

    /**
     * قبل الحذف: منع حذف فاتورة عليها أقساط مسجلة.
     */
    protected function beforeDestroy($record): void
    {
        if ($record->installments()->exists()) {
            abort(422, 'لا يمكن حذف فاتورة شراء مرتبط بها أقساط مدفوعة.');
        }
    }

    /**
     * مزامنة عناصر الفاتورة: تحديث الموجود، حذف المحذوف، إضافة الجديد.
     */
    protected function syncItems($purchase, array $items): void
    {
        $incomingIds = collect($items)->pluck('id')->filter()->all();

        $purchase->items()
            ->whereNotIn('id', $incomingIds)
            ->delete();

        foreach ($items as $item) {
            $itemData = [
                'product_id'                => $item['product_id'],
                'quantity'                  => $item['quantity'],
                'unit_cost_before_discount' => $item['unit_cost_before_discount'] ?? 0,
                'discount_percentage'       => $item['discount_percentage'] ?? 0,
                'unit_cost_before_tax'      => $item['unit_cost_before_tax'] ?? 0,
                'line_total'                => $this->calculateLineTotal($item),
                'profit_margin_percentage'  => $item['profit_margin_percentage'] ?? 0,
                'unit_sale_price_incl_tax'  => $item['unit_sale_price_incl_tax'] ?? 0,
                'sort_order'                => $item['sort_order'] ?? 0,
            ];

            if (!empty($item['id'])) {
                $purchase->items()->where('id', $item['id'])->update($itemData);
            } else {
                $purchase->items()->create($itemData);
            }
        }
    }

    /**
     * مزامنة مصاريف الفاتورة الإضافية.
     */
    protected function syncExpenses($purchase, array $expenses): void
    {
        $incomingIds = collect($expenses)->pluck('id')->filter()->all();

        $purchase->expenses()
            ->whereNotIn('id', $incomingIds)
            ->delete();

        foreach ($expenses as $expense) {
            $expenseData = [
                'expense_details' => $expense['expense_details'] ?? null,
                'expense_amount'  => $expense['expense_amount'] ?? 0,
            ];

            if (!empty($expense['id'])) {
                $purchase->expenses()->where('id', $expense['id'])->update($expenseData);
            } else {
                $purchase->expenses()->create($expenseData);
            }
        }
    }

    /**
     * حفظ أول قسط لو المستخدم أدخل مبلغ مدفوع وقت إنشاء الفاتورة.
     */
    protected function storeInitialInstallment($purchase, Request $request): void
    {
        $amount = $request->input('installment.amount');

        if (empty($amount) || (float) $amount <= 0) {
            return;
        }

        $purchase->installments()->create([
            'prior_balance'  => 0,
            'paid_on'        => $request->input('installment.paid_on', now()),
            'amount'         => $amount,
            'payment_method' => $request->input('installment.payment_method'),
            'payment_note'   => $request->input('installment.payment_note'),
            'created_by'     =>   1,
        ]);
    }

    /**
     * حساب إجمالي الفاتورة بالكامل من عناصر الطلب، بدل الاعتماد على أرقام الفرونت.
     */
    protected function calculateTotals(Request $request, $existingRecord = null): array
    {
        $items = $request->input('items', []);

        $itemsSubtotal = collect($items)->sum(function ($item) {
            return $this->calculateLineTotal($item);
        });

        $discountType   = $request->input('discount_type');
        $discountValue  = (float) $request->input('discount_value', 0);
        $discountAmount = $discountType === 'percentage'
            ? $itemsSubtotal * ($discountValue / 100)
            : $discountValue;

        $taxType       = $request->input('tax_type');
        $taxValue      = (float) $request->input('tax_value', 0);
        $afterDiscount = $itemsSubtotal - $discountAmount;
        $taxAmount     = $taxType === 'percentage'
            ? $afterDiscount * ($taxValue / 100)
            : $taxValue;

        $shippingCostTotal = (float) $request->input('shipping_cost_total', 0);

        $expenses      = $request->input('expenses', []);
        $expensesTotal = collect($expenses)->sum(fn($e) => (float) ($e['expense_amount'] ?? 0));

        $totalPurchaseAmount = $afterDiscount + $taxAmount + $shippingCostTotal + $expensesTotal;

        $priorPaid            = $existingRecord->total_paid ?? 0;
        $newInstallmentAmount = (float) $request->input('installment.amount', 0);
        $totalPaid            = $priorPaid + $newInstallmentAmount;

        return [
            'discount_amount'       => round($discountAmount, 2),
            'tax_amount'            => round($taxAmount, 2),
            'shipping_cost_total'   => round($shippingCostTotal, 2),
            'total_purchase_amount' => round($totalPurchaseAmount, 2),
            'total_paid'            => round($totalPaid, 2),
            'due_amount'            => round($totalPurchaseAmount - $totalPaid, 2),
        ];
    }

    /**
     * إجمالي الصنف الواحد = (تكلفة الوحدة بعد الخصم) × الكمية.
     */
    protected function calculateLineTotal(array $item): float
    {
        $qty      = (float) ($item['quantity'] ?? 0);
        $unitCost = (float) ($item['unit_cost_before_tax'] ?? $item['unit_cost_before_discount'] ?? 0);

        return round($qty * $unitCost, 2);
    }
}
