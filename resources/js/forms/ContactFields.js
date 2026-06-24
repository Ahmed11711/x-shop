export const fields = [
  { key: "contact_id", label: "Contact Id", required: 1, placeholder: "Enter Contact Id", type: "text", isString: false },
  { key: "contact_type", label: "Contact Type", required: 1, placeholder: "Enter Contact Type", type: "select", isString: false,
      options: [
    {
        "value": "supplier",
        "label": "Supplier"
    },
    {
        "value": "customer",
        "label": "Customer"
    }
] },
  { key: "type", label: "Type", required: 1, placeholder: "Enter Type", type: "select", isString: false,
      options: [
    {
        "value": "individual",
        "label": "Individual"
    },
    {
        "value": "business",
        "label": "Business"
    }
] },
  { key: "customer_group_id", label: "Customer Group Id", required: 1, placeholder: "Enter Customer Group Id", type: "number", isString: false },
  { key: "assigned_to", label: "Assigned To", required: 1, placeholder: "Enter Assigned To", type: "number", isString: false },
  { key: "prefix", label: "Prefix", required: 1, placeholder: "Enter Prefix", type: "text", isString: false },
  { key: "first_name", label: "First Name", required: 1, placeholder: "Enter First Name", type: "text", isString: false },
  { key: "middle_name", label: "Middle Name", required: 1, placeholder: "Enter Middle Name", type: "text", isString: false },
  { key: "last_name", label: "Last Name", required: 1, placeholder: "Enter Last Name", type: "text", isString: false },
  { key: "mobile", label: "Mobile", required: 1, placeholder: "Enter Mobile", type: "text", isString: false },
  { key: "alternate_number", label: "Alternate Number", required: 1, placeholder: "Enter Alternate Number", type: "text", isString: false },
  { key: "landline", label: "Landline", required: 1, placeholder: "Enter Landline", type: "text", isString: false },
  { key: "email", label: "Email", required: 1, placeholder: "Enter Email", type: "text", isString: false },
  { key: "date_of_birth", label: "Date Of Birth", required: 1, placeholder: "Enter Date Of Birth", type: "text", isString: false },
  { key: "tax_number", label: "Tax Number", required: 1, placeholder: "Enter Tax Number", type: "text", isString: false },
  { key: "opening_balance", label: "Opening Balance", required: 1, placeholder: "Enter Opening Balance", type: "number", isString: false },
  { key: "pay_term", label: "Pay Term", required: 1, placeholder: "Enter Pay Term", type: "select", isString: false,
      options: [
    {
        "value": "days",
        "label": "Days"
    },
    {
        "value": "months",
        "label": "Months"
    }
] },
  { key: "credit_limit", label: "Credit Limit", required: 1, placeholder: "Enter Credit Limit", type: "number", isString: false },
  { key: "address_line_1", label: "Address Line 1", required: 1, placeholder: "Enter Address Line 1", type: "text", isString: false },
  { key: "address_line_2", label: "Address Line 2", required: 1, placeholder: "Enter Address Line 2", type: "text", isString: false },
  { key: "city", label: "City", required: 1, placeholder: "Enter City", type: "text", isString: false },
  { key: "state", label: "State", required: 1, placeholder: "Enter State", type: "text", isString: false },
  { key: "country", label: "Country", required: 1, placeholder: "Enter Country", type: "text", isString: false },
  { key: "zip_code", label: "Zip Code", required: 1, placeholder: "Enter Zip Code", type: "text", isString: false },
  { key: "landmark", label: "Landmark", required: 1, placeholder: "Enter Landmark", type: "text", isString: false },
  { key: "street_name", label: "Street Name", required: 1, placeholder: "Enter Street Name", type: "text", isString: false },
  { key: "building_number", label: "Building Number", required: 1, placeholder: "Enter Building Number", type: "text", isString: false },
  { key: "additional_number", label: "Additional Number", required: 1, placeholder: "Enter Additional Number", type: "text", isString: false },
  { key: "custom_field_1", label: "Custom Field 1", required: 1, placeholder: "Enter Custom Field 1", type: "text", isString: false },
  { key: "custom_field_2", label: "Custom Field 2", required: 1, placeholder: "Enter Custom Field 2", type: "text", isString: false },
  { key: "custom_field_3", label: "Custom Field 3", required: 1, placeholder: "Enter Custom Field 3", type: "text", isString: false },
  { key: "custom_field_4", label: "Custom Field 4", required: 1, placeholder: "Enter Custom Field 4", type: "text", isString: false }
];