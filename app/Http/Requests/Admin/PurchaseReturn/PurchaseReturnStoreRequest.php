<?php

namespace App\Http\Requests\Admin\PurchaseReturn;

use App\Http\Requests\BaseRequest\BaseRequest;
use App\Models\PurchaseReturn;
use Illuminate\Validation\Rule;

class PurchaseReturnStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'supplier_id'       => 'required|integer|exists:suppliers,id',
            'branch_id'         => 'required|integer|exists:branches,id',
            'purchase_id'       => 'nullable|integer|exists:purchases,id',
            'reference_number'  => 'nullable|string|max:100',
            'return_date'       => 'required|date',
            'attachment_image'  => 'nullable|file|mimes:pdf,csv,zip,doc,docx,jpeg,jpg,png|max:2048',

            'tax_type'  => ['nullable', Rule::in(PurchaseReturn::TYPES)],
            'tax_value' => 'nullable|numeric|min:0',

            'notes' => 'nullable|string',

            'items'                      => 'required|array|min:1',
            'items.*.product_id'        => 'required|integer|exists:products,id',
            'items.*.quantity'          => 'required|numeric|min:0.001',
            'items.*.unit_price'        => 'required|numeric|min:0',
        ];
    }
}
