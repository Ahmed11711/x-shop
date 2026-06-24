export const fields = [
  { key: "name", label: "Name", required: 1, placeholder: "Enter Name", type: "text", isString: false },
  { key: "calculation_type", label: "Calculation Type", required: 1, placeholder: "Enter Calculation Type", type: "select", isString: false,
      options: [
    {
        "value": "percentage",
        "label": "Percentage"
    },
    {
        "value": "fixed",
        "label": "Fixed"
    }
] },
  { key: "calculation_percentage", label: "Calculation Percentage", required: 1, placeholder: "Enter Calculation Percentage", type: "number", isString: false }
];