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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->enum('purchase_status', ['draft', 'received', 'pending', 'cancelled'])->default('draft');
            $table->dateTime('purchase_date');
            $table->string('reference_number', 100)->nullable();

            $table->foreignId('supplier_id')
                ->constrained('suppliers');
            $table->foreignId('branch_id')->constrained('branches');
            $table->string('address', 255)->nullable();
            $table->string('attachment_image', 255)->nullable();

            $table->string('payment_period')->nullable();

            // الإجماليات (Cache للأداء، محسوبة من purchase_items)
            // $table->decimal('items_subtotal', 14, 2)->default(0);   // مجموع العناصر
            // $table->decimal('grand_total', 14, 2)->default(0);      // الاجمالي

            $table->enum('discount_type', ['percentage', 'fixed_amount'])->nullable();

            $table->decimal('discount_value', 14, 2)->default(0);
            $table->decimal('discount_amount', 14, 2)->default(0);

            $table->enum('tax_type', ['percentage', 'fixed_amount'])->nullable();
            $table->decimal('tax_amount', 14, 2)->default(0);

            $table->decimal('shipping_cost_total', 14, 2)->default(0);
            $table->string('shipping_details', 255)->nullable();

            $table->decimal('total_purchase_amount', 14, 2)->default(0);
            $table->decimal('total_paid', 14, 2)->default(0);
            $table->decimal('due_amount', 14, 2)->default(0);

            $table->text('notes')->nullable();

            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
