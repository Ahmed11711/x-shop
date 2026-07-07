export const fields = [
  { key: "purchase_status", label: "Purchase Status", required: 1, placeholder: "Enter Purchase Status", type: "select", isString: false,
      options: [
    {
        "value": "\u0645\u0633\u0648\u062f\u0629",
        "label": "\u0645\u0633\u0648\u062f\u0629"
    },
    {
        "value": "\u0645\u0633\u062a\u0644\u0645",
        "label": "\u0645\u0633\u062a\u0644\u0645"
    },
    {
        "value": "\u0645\u0639\u0644\u0642",
        "label": "\u0645\u0639\u0644\u0642"
    },
    {
        "value": "\u0645\u0644\u063a\u064a",
        "label": "\u0645\u0644\u063a\u064a"
    }
] },
  { key: "purchase_date", label: "Purchase Date", required: 1, placeholder: "Enter Purchase Date", type: "text", isString: false },
  { key: "reference_number", label: "Reference Number", required: 1, placeholder: "Enter Reference Number", type: "text", isString: false },
  { key: "supplier_id", label: "Supplier Id", required: 1, placeholder: "Enter Supplier Id", type: "number", isString: false },
  { key: "branch_id", label: "Branch Id", required: 1, placeholder: "Enter Branch Id", type: "number", isString: false },
  { key: "address", label: "Address", required: 1, placeholder: "Enter Address", type: "text", isString: false },
  { key: "attachment_image", label: "Attachment Image", required: 1, placeholder: "Enter Attachment Image", type: "image", isString: true },
  { key: "payment_period", label: "Payment Period", required: 1, placeholder: "Enter Payment Period", type: "text", isString: false },
  { key: "discount_type", label: "Discount Type", required: 1, placeholder: "Enter Discount Type", type: "select", isString: false,
      options: [
    {
        "value": "\u0646\u0633\u0628\u0629 \u0645\u0626\u0648\u064a\u0629",
        "label": "\u0646\u0633\u0628\u0629 \u0645\u0626\u0648\u064a\u0629"
    },
    {
        "value": "\u0645\u0628\u0644\u063a \u062b\u0627\u0628\u062a",
        "label": "\u0645\u0628\u0644\u063a \u062b\u0627\u0628\u062a"
    }
] },
  { key: "discount_value", label: "Discount Value", required: 1, placeholder: "Enter Discount Value", type: "number", isString: false },
  { key: "discount_amount", label: "Discount Amount", required: 1, placeholder: "Enter Discount Amount", type: "number", isString: false },
  { key: "tax_type", label: "Tax Type", required: 1, placeholder: "Enter Tax Type", type: "select", isString: false,
      options: [
    {
        "value": "\u0646\u0633\u0628\u0629 \u0645\u0626\u0648\u064a\u0629",
        "label": "\u0646\u0633\u0628\u0629 \u0645\u0626\u0648\u064a\u0629"
    },
    {
        "value": "\u0645\u0628\u0644\u063a \u062b\u0627\u0628\u062a",
        "label": "\u0645\u0628\u0644\u063a \u062b\u0627\u0628\u062a"
    }
] },
  { key: "tax_amount", label: "Tax Amount", required: 1, placeholder: "Enter Tax Amount", type: "number", isString: false },
  { key: "shipping_cost_total", label: "Shipping Cost Total", required: 1, placeholder: "Enter Shipping Cost Total", type: "number", isString: false },
  { key: "shipping_details", label: "Shipping Details", required: 1, placeholder: "Enter Shipping Details", type: "text", isString: false },
  { key: "total_purchase_amount", label: "Total Purchase Amount", required: 1, placeholder: "Enter Total Purchase Amount", type: "number", isString: false },
  { key: "total_paid", label: "Total Paid", required: 1, placeholder: "Enter Total Paid", type: "number", isString: false },
  { key: "due_amount", label: "Due Amount", required: 1, placeholder: "Enter Due Amount", type: "number", isString: false },
  { key: "notes", label: "Notes", required: 1, placeholder: "Enter Notes", type: "textarea", isString: false },
  { key: "created_by", label: "Created By", required: 1, placeholder: "Enter Created By", type: "number", isString: false }
];