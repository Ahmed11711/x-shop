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
        Schema::create('purchase_installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained('purchases');

            $table->decimal('prior_balance', 14, 2)->default(0);   // الرصيد المسبق
            $table->dateTime('paid_on');                           // المدفوعة على
            $table->decimal('amount', 14, 2);                      // المبلغ

            $table->string('payment_method')->nullable();  // المرجع الدفع
            $table->text('payment_note')->nullable();               // ملاحظة الدفع

            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_installments');
    }
};
