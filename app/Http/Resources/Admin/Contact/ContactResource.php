<?php

namespace App\Http\Resources\Admin\Contact;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'contact_id' => $this->contact_id,
            'contact_type' => $this->contact_type,
            'type' => $this->type,
            'customer_group_id' => $this->customer_group_id,
            'assigned_to' => $this->assigned_to,
            'prefix' => $this->prefix,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'mobile' => $this->mobile,
            'alternate_number' => $this->alternate_number,
            'landline' => $this->landline,
            'email' => $this->email,
            'date_of_birth' => $this->date_of_birth,
            'tax_number' => $this->tax_number,
            'opening_balance' => $this->opening_balance,
            'pay_term' => $this->pay_term,
            'credit_limit' => $this->credit_limit,
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'zip_code' => $this->zip_code,
            'landmark' => $this->landmark,
            'street_name' => $this->street_name,
            'building_number' => $this->building_number,
            'additional_number' => $this->additional_number,
            'custom_field_1' => $this->custom_field_1,
            'custom_field_2' => $this->custom_field_2,
            'custom_field_3' => $this->custom_field_3,
            'custom_field_4' => $this->custom_field_4,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
