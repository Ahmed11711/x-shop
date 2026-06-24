export const fields = [
  { key: "name", label: "Name", required: 1, placeholder: "Enter Name", type: "text", isString: false },
  { key: "description", label: "Description", required: 1, placeholder: "Enter Description", type: "textarea", isString: false },
  { key: "duration", label: "Duration", required: 1, placeholder: "Enter Duration", type: "text", isString: false },
  { key: "duration_type", label: "Duration Type", required: 1, placeholder: "Enter Duration Type", type: "select", isString: false,
      options: [
    {
        "value": "days",
        "label": "Days"
    },
    {
        "value": "months",
        "label": "Months"
    },
    {
        "value": "years",
        "label": "Years"
    }
] }
];