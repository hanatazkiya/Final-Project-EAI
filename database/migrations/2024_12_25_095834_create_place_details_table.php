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
        Schema::create('place_details', function (Blueprint $table) {
            $table->integer('place_id')->primary();
            $table->string('admin_username')->nullable(false);
            $table->foreign('admin_username')->references('username')->on('admins');
            $table->longText('description')->nullable(false);
            $table->string('city')->nullable(false);
            $table->string('maps')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('place_details');
    }
};
