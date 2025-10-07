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
        Schema::create('court_district', function (Blueprint $table) {
            $table->unsignedBigInteger('court_id');
            $table->unsignedBigInteger('district_id');
            $table->primary(['court_id','district_id']);
            $table->foreign('court_id')->references('id')->on('courts');
            $table->foreign('district_id')->references('id')->on('districts');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('court_district');
    }
};
