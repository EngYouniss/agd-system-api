<?php
// database/migrations/xxxx_xx_xx_000003_create_return_contracts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('return_contracts', function (Blueprint $table) {
            $table->id();

            // هذا السجل يتبع عقدًا عامًا في contracts (1:1)
            $table->unsignedBigInteger('contract_id');
            // إن كانت الرجعة مشتقّة من طلاق موجود داخل النظام:
            // يشير إلى contracts.id لعقد الطلاق
            $table->unsignedBigInteger('divorce_contract_id')->nullable();

            // تفاصيل الرجعة
            $table->boolean('within_iddah')->nullable(); // داخل العِدّة؟
            $table->date('return_date')->nullable();
            $table->string('return_notes', 255)->nullable();

            $table->timestamps();

            // قيود وفهارس
            $table->foreign('contract_id')
                  ->references('id')->on('contracts')
                  ->cascadeOnDelete();

            $table->foreign('divorce_contract_id')
                  ->references('id')->on('contracts')
                  ->onDelete('restrict'); // لا تحذف الرجعة عند حذف الطلاق إلا إذا رغبت

            // 1:1 مع contracts
            $table->unique('contract_id');

            // رجعة واحدة لكل طلاق مصدر داخل النظام
            $table->unique('divorce_contract_id');


        });
    }

    public function down(): void
    {
        Schema::dropIfExists('return_contracts');
    }
};
