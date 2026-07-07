<?php

namespace App\Http\Requests\Admin\Purchase;

use App\Http\Requests\BaseRequest\BaseRequest;

class PurchaseUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'purchase_status'   => 'sometimes|required|in:draft,received,pending,cancelled',
            'purchase_date'     => 'sometimes|required|date',
            'reference_number'  => 'nullable|sometimes|string|max:100',
            'supplier_id'       => 'sometimes|required|integer|exists:suppliers,id',
            'branch_id'         => 'sometimes|required|integer|exists:branches,id',
            'address'           => 'nullable|sometimes|string|max:255',
            'attachment_image'  => 'nullable|sometimes|file|mimes:pdf,csv,zip,doc,docx,jpeg,jpg,png|max:2048',
            'payment_period'    => 'nullable|sometimes|string|max:255',

            'discount_type'   => 'nullable|sometimes|in:percentage,fixed',
            'discount_value'  => 'nullable|sometimes|numeric|min:0',
            'tax_type'        => 'nullable|sometimes|in:percentage,fixed',
            'tax_value'       => 'nullable|sometimes|numeric|min:0',

            'shipping_cost_total' => 'nullable|sometimes|numeric|min:0',
            'shipping_details'    => 'nullable|sometimes|string|max:255',

            'notes' => 'nullable|sometimes|string',

            'items'                              => 'sometimes|required|array|min:1',
            'items.*.id'                          => 'nullable|integer|exists:purchase_items,id',
            'items.*.product_id'                 => 'required_with:items|integer|exists:products,id',
            'items.*.quantity'                   => 'required_with:items|numeric|min:0.001',
            'items.*.unit_cost_before_discount'   => 'required_with:items|numeric|min:0',
            'items.*.discount_percentage'         => 'nullable|numeric|min:0|max:100',
            'items.*.unit_cost_before_tax'        => 'nullable|numeric|min:0',
            'items.*.profit_margin_percentage'    => 'nullable|numeric|min:0',
            'items.*.unit_sale_price_incl_tax'    => 'nullable|numeric|min:0',
            'items.*.sort_order'                  => 'nullable|integer|min:0',

            'expenses'                    => 'nullable|array',
            'expenses.*.id'                => 'nullable|integer|exists:purchase_expenses,id',
            'expenses.*.expense_details'  => 'nullable|string|max:255',
            'expenses.*.expense_amount'   => 'required_with:expenses|numeric|min:0',
        ];
    }
}
