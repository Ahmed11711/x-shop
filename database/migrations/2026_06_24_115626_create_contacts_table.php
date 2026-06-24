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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('contact_id')->unique(); // autogenerate

            // الأساسية
            $table->enum('contact_type', ['supplier', 'customer']);
            $table->enum('type', ['individual', 'business'])->default('individual');
            $table->foreignId('customer_group_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');

            // بيانات الاسم
            $table->string('prefix')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();

            // بيانات التواصل
            $table->string('mobile');
            $table->string('alternate_number')->nullable();
            $table->string('landline')->nullable();
            $table->string('email')->nullable();
            $table->date('date_of_birth')->nullable();

            // بيانات مالية
            $table->string('tax_number')->nullable();          // الرقم الضريبي
            $table->decimal('opening_balance', 10, 2)->default(0); // الرصيد الافتتاحي
            $table->enum('pay_term', ['days', 'months'])->nullable(); // فترة الدفع
            $table->decimal('credit_limit', 10, 2)->nullable();    // الحد الائتماني

            // العنوان
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('zip_code')->nullable();

            // عنوان سعودي
            $table->string('landmark')->nullable();
            $table->string('street_name')->nullable();
            $table->string('building_number')->nullable();
            $table->string('additional_number')->nullable();

            // حقول مخصصة
            $table->string('custom_field_1')->nullable();
            $table->string('custom_field_2')->nullable();
            $table->string('custom_field_3')->nullable();
            $table->string('custom_field_4')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
