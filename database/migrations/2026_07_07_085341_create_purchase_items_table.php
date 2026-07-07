<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('purchase_id')->constrained('purchases');
            $table->foreignId('product_id')->constrained('products');

            $table->decimal('quantity', 12, 3)->default(1);                    // كمية المشتريات
            $table->decimal('unit_cost_before_discount', 14, 4)->default(0);    // تكلفة الوحدة (قبل الخصم)
            $table->decimal('discount_percentage', 6, 3)->default(0);           // نسبة الخصم
            $table->decimal('unit_cost_before_tax', 14, 4)->default(0);         // تكلفة الوحدة (قبل الضريبة)
            $table->decimal('line_total', 14, 2)->default(0);                   // اجمالي الصنف
            $table->decimal('profit_margin_percentage', 6, 3)->default(0);      // % Profit Margin
            $table->decimal('unit_sale_price_incl_tax', 14, 4)->default(0);     // سعر البيع للوحدة (شامل الضريبة)

            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};
