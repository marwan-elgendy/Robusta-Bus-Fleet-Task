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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('start_city_id');
            $table->unsignedBigInteger('end_city_id');
            $table->unsignedBigInteger('bus_id');
            $table->timestamps();

            $table->foreign('start_city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('end_city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('no action');

            $table->index('start_city_id');
            $table->index('end_city_id');
            $table->index('bus_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
