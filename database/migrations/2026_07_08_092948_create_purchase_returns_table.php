<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_returns', function (Blueprint $table) {
            $table->id();

            $table->foreignId('supplier_id')->constrained('suppliers');
            $table->foreignId('branch_id')->constrained('branches');

            $table->foreignId('purchase_id')->nullable()->constrained('purchases')->nullOnDelete();

            $table->string('reference_number', 100)->nullable();
            $table->dateTime('return_date');
            $table->string('attachment_image', 255)->nullable();

            $table->string('tax_type', 20)->nullable(); // percentage, fixed
            $table->decimal('tax_value', 14, 2)->default(0);
            $table->decimal('tax_amount', 14, 2)->default(0);

            $table->decimal('items_subtotal', 14, 2)->default(0);
            $table->decimal('total_return_amount', 14, 2)->default(0);

            $table->text('notes')->nullable();

            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_returns');
    }
};
