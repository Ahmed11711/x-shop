export const fields = [
  { key: "supplier_id", label: "Supplier Id", required: 1, placeholder: "Enter Supplier Id", type: "number", isString: false },
  { key: "branch_id", label: "Branch Id", required: 1, placeholder: "Enter Branch Id", type: "number", isString: false },
  { key: "purchase_id", label: "Purchase Id", required: 1, placeholder: "Enter Purchase Id", type: "number", isString: false },
  { key: "reference_number", label: "Reference Number", required: 1, placeholder: "Enter Reference Number", type: "text", isString: false },
  { key: "return_date", label: "Return Date", required: 1, placeholder: "Enter Return Date", type: "text", isString: false },
  { key: "attachment_image", label: "Attachment Image", required: 1, placeholder: "Enter Attachment Image", type: "image", isString: true },
  { key: "tax_type", label: "Tax Type", required: 1, placeholder: "Enter Tax Type", type: "text", isString: false },
  { key: "tax_value", label: "Tax Value", required: 1, placeholder: "Enter Tax Value", type: "number", isString: false },
  { key: "tax_amount", label: "Tax Amount", required: 1, placeholder: "Enter Tax Amount", type: "number", isString: false },
  { key: "items_subtotal", label: "Items Subtotal", required: 1, placeholder: "Enter Items Subtotal", type: "number", isString: false },
  { key: "total_return_amount", label: "Total Return Amount", required: 1, placeholder: "Enter Total Return Amount", type: "number", isString: false },
  { key: "notes", label: "Notes", required: 1, placeholder: "Enter Notes", type: "textarea", isString: false },
  { key: "created_by", label: "Created By", required: 1, placeholder: "Enter Created By", type: "number", isString: false }
];