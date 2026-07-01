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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // ─── معلومات المنتج الأساسية ───────────────────────────────
            $table->string('name');
            $table->string('sku')->nullable()->unique();
            $table->string('barcode')->nullable();
            $table->enum('barcode_type', [
                'Code 128 (C128)',
                'Code 39',
                'EAN-13',
                'EAN-8',
                'UPC-A',
                'QR Code',
            ])->default('Code 128 (C128)');

            // ─── التصنيف والعلامة التجارية ─────────────────────────────

            $table->foreignId('category_id')->nullable()
                ->constrained('category_products')->nullOnDelete();
            $table->foreignId('sub_category_id')->nullable()
                ->constrained('category_products')->nullOnDelete();
            $table->foreignId('brand_id')->nullable()
                ->constrained('brands')->nullOnDelete();

            // ─── الوصف ─────────────────────────────────────────────────
            $table->longText('description')->nullable();

            // ─── إدارة المخزون ─────────────────────────────────────────
            $table->boolean('manage_stock')->default(true);
            $table->integer('alert_quantity')->nullable();

            // ─── الوزن والخدمة ─────────────────────────────────────────
            $table->decimal('weight', 10, 3)->nullable();
            $table->integer('service_time')->nullable(); // بالدقائق

            // ─── خيارات المنتج ─────────────────────────────────────────
            $table->boolean('has_serial_imei')->default(false);
            $table->boolean('not_for_sale')->default(false);
            $table->boolean('disable_woocommerce_sync')->default(false);

            // ─── نوع المنتج ────────────────────────────────────────────
            $table->enum('product_type', [
                'single',
                'variable',
                'combo',
                'digital',
            ])->default('single');

            // ─── الضرائب ───────────────────────────────────────────────

            $table->string('tax_id')->nullable();
            $table->enum('sales_tax_type', [
                'exclusive',
                'inclusive',
            ])->default('exclusive');

            // ─── الأسعار ───────────────────────────────────────────────
            $table->decimal('purchase_price_exc_tax', 15, 2)->nullable();
            $table->decimal('purchase_price_inc_tax', 15, 2)->nullable();
            $table->decimal('selling_price_exc_tax', 15, 2)->nullable();
            $table->decimal('selling_price_inc_tax', 15, 2)->nullable();
            $table->decimal('profit_margin', 5, 2)->nullable();

            // ─── الصور والملفات ────────────────────────────────────────
            $table->string('image')->nullable();
            $table->string('product_brochure')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
