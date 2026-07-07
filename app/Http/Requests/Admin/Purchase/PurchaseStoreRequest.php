<?php

namespace App\Http\Requests\Admin\Purchase;

use App\Http\Requests\BaseRequest\BaseRequest;
use App\Models\Purchase;
use Illuminate\Validation\Rule;

class PurchaseStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // بيانات الفاتورة الأساسية
            'purchase_status' => ['required', Rule::in(Purchase::STATUSES)],
            'purchase_date'     => 'required|date',
            'reference_number'  => 'nullable|string|max:100',
            'supplier_id'       => 'required|integer|exists:suppliers,id',
            'branch_id'         => 'required|integer|exists:branches,id',
            'address'           => 'nullable|string|max:255',
            'attachment_image'  => 'nullable|file|mimes:pdf,csv,zip,doc,docx,jpeg,jpg,png|max:2048',
            'payment_period'    => 'nullable|string|max:255',

            // الخصم والضريبة (المدخلات بس، الحسابات بتتم في الكنترولر)
            'discount_type'    => ['nullable', Rule::in(Purchase::TYPES)],
            'discount_value'  => 'nullable|numeric|min:0',
            'tax_type'         => ['nullable', Rule::in(Purchase::TYPES)],
            'tax_value'       => 'nullable|numeric|min:0',

            // الشحن (مدخل مباشر من المستخدم)
            'shipping_cost_total' => 'nullable|numeric|min:0',
            'shipping_details'    => 'nullable|string|max:255',

            'notes' => 'nullable|string',

            // عناصر الفاتورة
            'items'                              => 'required|array|min:1',
            'items.*.product_id'                 => 'required|integer|exists:products,id',
            'items.*.quantity'                   => 'required|numeric|min:0.001',
            'items.*.unit_cost_before_discount'   => 'required|numeric|min:0',
            'items.*.discount_percentage'         => 'nullable|numeric|min:0|max:100',
            'items.*.unit_cost_before_tax'        => 'nullable|numeric|min:0',
            'items.*.profit_margin_percentage'    => 'nullable|numeric|min:0',
            'items.*.unit_sale_price_incl_tax'    => 'nullable|numeric|min:0',
            'items.*.sort_order'                  => 'nullable|integer|min:0',

            // مصاريف إضافية
            'expenses'                    => 'nullable|array',
            'expenses.*.expense_details'  => 'nullable|string|max:255',
            'expenses.*.expense_amount'   => 'required_with:expenses|numeric|min:0',

            // قسط أول اختياري وقت الإنشاء
            'installment'                 => 'nullable|array',
            'installment.amount'          => 'required_with:installment|numeric|min:0.01',
            'installment.paid_on'         => 'nullable|date',
            'installment.payment_method'  => 'nullable|string|max:100',
            'installment.payment_note'    => 'nullable|string',
        ];
    }
}
