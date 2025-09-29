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
            $table->unsignedBigInteger('contract_number');
            $table->text('husband_conditions')->nullable();
            $table->text('wife_conditions')->nullable();
            $table->decimal('mahr_total',12,2)->default(0);
            $table->decimal('mahr_paid',12,2)->default(0);
            $table->decimal('mahr_remaining',12,2)->default(0);
            $table->foreignId('contract_status_id')->constrained('contract_statuses')->onDelete('restrict');
            $table->foreignId('contract_type_id')->constrained('contract_types')->onDelete('restrict');
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
