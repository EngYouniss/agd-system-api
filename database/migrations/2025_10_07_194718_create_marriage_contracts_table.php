<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('marriage_contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contract_id'); // = contracts.id (PK=FK)

            // الشروط
            $table->text('husband_conditions')->nullable();
            $table->text('wife_conditions')->nullable();
            // المهر
            $table->decimal('mahr_advanced', 12, 2)->nullable();
            $table->decimal('mahr_deferred', 12, 2)->nullable();
            $table->string('mahr_currency', 8)->nullable();
            $table->string('mahr_description', 255)->nullable();

            $table->timestamps();

            $table->foreign('contract_id')->references('id')->on('contracts')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('marriage_contracts');
    }
};
