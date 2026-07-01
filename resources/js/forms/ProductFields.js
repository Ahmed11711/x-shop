export const fields = [
  { key: "name", label: "Name", required: 1, placeholder: "Enter Name", type: "text", isString: false },
  { key: "sku", label: "Sku", required: 1, placeholder: "Enter Sku", type: "text", isString: false },
  { key: "barcode", label: "Barcode", required: 1, placeholder: "Enter Barcode", type: "text", isString: false },
  { key: "barcode_type", label: "Barcode Type", required: 1, placeholder: "Enter Barcode Type", type: "select", isString: false,
      options: [
    {
        "value": "Code 128 (C128)",
        "label": "Code 128 (C128)"
    },
    {
        "value": "Code 39",
        "label": "Code 39"
    },
    {
        "value": "EAN-13",
        "label": "EAN-13"
    },
    {
        "value": "EAN-8",
        "label": "EAN-8"
    },
    {
        "value": "UPC-A",
        "label": "UPC-A"
    },
    {
        "value": "QR Code",
        "label": "QR Code"
    }
] },
  { key: "category_id", label: "Category Id", required: 1, placeholder: "Enter Category Id", type: "number", isString: false },
  { key: "sub_category_id", label: "Sub Category Id", required: 1, placeholder: "Enter Sub Category Id", type: "number", isString: false },
  { key: "brand_id", label: "Brand Id", required: 1, placeholder: "Enter Brand Id", type: "number", isString: false },
  { key: "description", label: "Description", required: 1, placeholder: "Enter Description", type: "textarea", isString: false },
  { key: "manage_stock", label: "Manage Stock", required: 1, placeholder: "Enter Manage Stock", type: "boolean", isString: false },
  { key: "alert_quantity", label: "Alert Quantity", required: 1, placeholder: "Enter Alert Quantity", type: "text", isString: false },
  { key: "weight", label: "Weight", required: 1, placeholder: "Enter Weight", type: "number", isString: false },
  { key: "service_time", label: "Service Time", required: 1, placeholder: "Enter Service Time", type: "text", isString: false },
  { key: "has_serial_imei", label: "Has Serial Imei", required: 1, placeholder: "Enter Has Serial Imei", type: "boolean", isString: false },
  { key: "not_for_sale", label: "Not For Sale", required: 1, placeholder: "Enter Not For Sale", type: "boolean", isString: false },
  { key: "disable_woocommerce_sync", label: "Disable Woocommerce Sync", required: 1, placeholder: "Enter Disable Woocommerce Sync", type: "boolean", isString: false },
  { key: "product_type", label: "Product Type", required: 1, placeholder: "Enter Product Type", type: "select", isString: false,
      options: [
    {
        "value": "single",
        "label": "Single"
    },
    {
        "value": "variable",
        "label": "Variable"
    },
    {
        "value": "combo",
        "label": "Combo"
    },
    {
        "value": "digital",
        "label": "Digital"
    }
] },
  { key: "tax_id", label: "Tax Id", required: 1, placeholder: "Enter Tax Id", type: "text", isString: false },
  { key: "sales_tax_type", label: "Sales Tax Type", required: 1, placeholder: "Enter Sales Tax Type", type: "select", isString: false,
      options: [
    {
        "value": "exclusive",
        "label": "Exclusive"
    },
    {
        "value": "inclusive",
        "label": "Inclusive"
    }
] },
  { key: "purchase_price_exc_tax", label: "Purchase Price Exc Tax", required: 1, placeholder: "Enter Purchase Price Exc Tax", type: "number", isString: false },
  { key: "purchase_price_inc_tax", label: "Purchase Price Inc Tax", required: 1, placeholder: "Enter Purchase Price Inc Tax", type: "number", isString: false },
  { key: "selling_price_exc_tax", label: "Selling Price Exc Tax", required: 1, placeholder: "Enter Selling Price Exc Tax", type: "number", isString: false },
  { key: "selling_price_inc_tax", label: "Selling Price Inc Tax", required: 1, placeholder: "Enter Selling Price Inc Tax", type: "number", isString: false },
  { key: "profit_margin", label: "Profit Margin", required: 1, placeholder: "Enter Profit Margin", type: "number", isString: false },
  { key: "image", label: "Image", required: 1, placeholder: "Enter Image", type: "image", isString: true },
  { key: "product_brochure", label: "Product Brochure", required: 1, placeholder: "Enter Product Brochure", type: "text", isString: false }
];