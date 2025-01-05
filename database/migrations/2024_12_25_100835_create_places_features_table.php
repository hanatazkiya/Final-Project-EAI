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
        Schema::create('places_features', function (Blueprint $table) {
            $table->id();
            $table->integer('place_id')->nullable(false);
            $table->foreign('place_id')->references('id')->on('places');
            $table->string('feature')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places_features');
    }
};
