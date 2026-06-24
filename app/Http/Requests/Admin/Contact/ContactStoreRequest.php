<?php

namespace App\Http\Requests\Admin\Contact;

use App\Http\Requests\BaseRequest\BaseRequest;

class ContactStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'contact_id' => 'required|string|max:255|exists:contacts,id',
            'contact_type' => 'required|in:supplier,customer',
            'type' => 'required|in:individual,business',
            'customer_group_id' => 'nullable|integer|exists:customer_groups,id',
            'assigned_to' => 'nullable|integer',
            'prefix' => 'nullable|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'mobile' => 'required|string|max:255',
            'alternate_number' => 'nullable|string|max:255',
            'landline' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'tax_number' => 'nullable|string|max:255',
            'opening_balance' => 'required|numeric',
            'pay_term' => 'nullable|in:days,months',
            'credit_limit' => 'nullable|numeric',
            'address_line_1' => 'nullable|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:255',
            'landmark' => 'nullable|string|max:255',
            'street_name' => 'nullable|string|max:255',
            'building_number' => 'nullable|string|max:255',
            'additional_number' => 'nullable|string|max:255',
            'custom_field_1' => 'nullable|string|max:255',
            'custom_field_2' => 'nullable|string|max:255',
            'custom_field_3' => 'nullable|string|max:255',
            'custom_field_4' => 'nullable|string|max:255',
        ];
    }
}
