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
        Schema::create('trip_stops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trip_id');
            $table->unsignedBigInteger('city_id');
            $table->integer('order');
            $table->date('date');
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->double('cost');
            $table->timestamps();

            $table->foreign('trip_id')->references('id')->on('trips');
            $table->foreign('city_id')->references('id')->on('cities');

            $table->index('trip_id');
            $table->index('city_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_stops');
    }
};
