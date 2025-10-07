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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();

            // رقم العقد
            $table->unsignedBigInteger('contract_number')->unique();

            // النوع والحالة
            $table->foreignId('contract_status_id')
                  ->constrained('contract_statuses')
                  ->onDelete('restrict');

            $table->foreignId('contract_type_id')
                  ->constrained('contract_types')
                  ->onDelete('restrict');

            // تتبّع مستخدمي النظام (بدون ربطهم كأطراف)
            $table->foreignId('created_by')->nullable()
                  ->constrained('users')->nullOnDelete();

            $table->foreignId('approved_by')->nullable()
                  ->constrained('users')->nullOnDelete();

            $table->foreignId('rejected_by')->nullable()
                  ->constrained('users')->nullOnDelete();

            // تواريخ الحالة (استخدم date كما طلبت)
            $table->date('sent_at')->nullable();
            $table->date('approved_at')->nullable();
            $table->date('rejected_at')->nullable();

            // سبب الرفض (اختياري)
            $table->string('rejected_reason', 255)->nullable();

            // ختم الأمين الشرعي عند الإرسال (اختياري)
            $table->date('amin_seal_at')->nullable();
            $table->string('amin_seal_hash', 128)->nullable();
            $table->string('amin_seal_algo', 32)->nullable();

            // توقيع النظام الإلكتروني النهائي (اختياري)
            $table->date('signed_at')->nullable();
            $table->string('signature_hash', 128)->nullable();
            $table->string('signature_algo', 32)->nullable();


            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
