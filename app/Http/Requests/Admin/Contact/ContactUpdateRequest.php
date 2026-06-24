<?php

namespace App\Http\Requests\Admin\Contact;

use App\Http\Requests\BaseRequest\BaseRequest;

class ContactUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'contact_id' => 'sometimes|required|string|max:255|exists:contacts,id',
            'contact_type' => 'sometimes|required|in:supplier,customer',
            'type' => 'sometimes|required|in:individual,business',
            'customer_group_id' => 'nullable|sometimes|integer|exists:customer_groups,id',
            'assigned_to' => 'nullable|sometimes|integer',
            'prefix' => 'nullable|sometimes|string|max:255',
            'first_name' => 'sometimes|required|string|max:255',
            'middle_name' => 'nullable|sometimes|string|max:255',
            'last_name' => 'nullable|sometimes|string|max:255',
            'mobile' => 'sometimes|required|string|max:255',
            'alternate_number' => 'nullable|sometimes|string|max:255',
            'landline' => 'nullable|sometimes|string|max:255',
            'email' => 'nullable|sometimes|string|max:255',
            'date_of_birth' => 'nullable|sometimes|date',
            'tax_number' => 'nullable|sometimes|string|max:255',
            'opening_balance' => 'sometimes|required|numeric',
            'pay_term' => 'nullable|sometimes|in:days,months',
            'credit_limit' => 'nullable|sometimes|numeric',
            'address_line_1' => 'nullable|sometimes|string|max:255',
            'address_line_2' => 'nullable|sometimes|string|max:255',
            'city' => 'nullable|sometimes|string|max:255',
            'state' => 'nullable|sometimes|string|max:255',
            'country' => 'nullable|sometimes|string|max:255',
            'zip_code' => 'nullable|sometimes|string|max:255',
            'landmark' => 'nullable|sometimes|string|max:255',
            'street_name' => 'nullable|sometimes|string|max:255',
            'building_number' => 'nullable|sometimes|string|max:255',
            'additional_number' => 'nullable|sometimes|string|max:255',
            'custom_field_1' => 'nullable|sometimes|string|max:255',
            'custom_field_2' => 'nullable|sometimes|string|max:255',
            'custom_field_3' => 'nullable|sometimes|string|max:255',
            'custom_field_4' => 'nullable|sometimes|string|max:255',
        ];
    }
}
