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
        Schema::create('spouses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('district_id');
            $table->string('mother_first_name', 64)->nullable();
            $table->string('mother_second_name', 64)->nullable();
            $table->string('mother_third_name', 64)->nullable();
            $table->string('mother_last_name', 64)->nullable();
            $table->string('previous_marital_status', 32)->nullable();
            $table->string('education_level', 64)->nullable();
            $table->string('occupation', 128)->nullable();

            // تاريخ الميلاد
            $table->date('dob')->nullable();
            $table->string('birth_place', 128)->nullable();
            // محل الإقامة
            $table->string('residence_place', 128)->nullable();
            $table->foreign('person_id')->references('id')->on('people');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spouses');
    }
};
