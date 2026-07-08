<?php

namespace App\Http\Requests\Admin\PurchaseReturn;

use App\Http\Requests\BaseRequest\BaseRequest;
use App\Models\PurchaseReturn;
use Illuminate\Validation\Rule;

class PurchaseReturnUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'supplier_id'       => 'sometimes|required|integer|exists:suppliers,id',
            'branch_id'         => 'sometimes|required|integer|exists:branches,id',
            'purchase_id'       => 'nullable|sometimes|integer|exists:purchases,id',
            'reference_number'  => 'nullable|sometimes|string|max:100',
            'return_date'       => 'sometimes|required|date',
            'attachment_image'  => 'nullable|sometimes|file|mimes:pdf,csv,zip,doc,docx,jpeg,jpg,png|max:2048',

            'tax_type'  => ['nullable', 'sometimes', Rule::in(PurchaseReturn::TYPES)],
            'tax_value' => 'nullable|sometimes|numeric|min:0',

            'notes' => 'nullable|sometimes|string',

            'items'                      => 'sometimes|required|array|min:1',
            'items.*.id'                => 'nullable|integer|exists:purchase_return_items,id',
            'items.*.product_id'        => 'required_with:items|integer|exists:products,id',
            'items.*.quantity'          => 'required_with:items|numeric|min:0.001',
            'items.*.unit_price'        => 'required_with:items|numeric|min:0',
        ];
    }
}
