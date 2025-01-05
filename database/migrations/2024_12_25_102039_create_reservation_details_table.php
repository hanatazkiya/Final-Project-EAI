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
        Schema::create('reservation_details', function (Blueprint $table) {
            $table->integer('reservation_id')->primary();
            $table->string('visitor_username')->nullable(false);
            $table->foreign('visitor_username')->references('username')->on('users');
            $table->integer('place_id')->nullable(false);
            $table->foreign('place_id')->references('id')->on('places');
            $table->integer('unit_price')->nullable(false);
            $table->integer('quantity')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_details');
    }
};
