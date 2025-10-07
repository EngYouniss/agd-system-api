<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('divorce_contracts', function (Blueprint $table) {
            $table->id();

            // هذا السجل يتبع عقدًا عامًا في contracts (1:1)
            $table->unsignedBigInteger('contract_id');

            // تفاصيل الطلاق
            $table->unsignedTinyInteger('talaq_number'); // 1..3
            $table->enum('divorce_type', ['revocable','irrevocable_minor','irrevocable_major']);
            $table->string('reason', 255)->nullable();

            $table->timestamps();

            // قيود وفهارس
            $table->foreign('contract_id')
                  ->references('id')->on('contracts')
                  ->cascadeOnDelete();


            $table->unique('contract_id'); // يضمن 1:1 مع contracts
            $table->unique(['marriage_contract_id','talaq_number']); // لا تكرار لنفس رقم الطلقة لنفس الزواج

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('divorce_contracts');
    }
};
