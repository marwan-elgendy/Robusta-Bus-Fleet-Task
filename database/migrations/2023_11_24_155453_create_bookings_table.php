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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('trip_id');
            $table->unsignedBigInteger('start_stop_id');
            $table->unsignedBigInteger('end_stop_id');
            $table->unsignedBigInteger('seat_id');
            $table->uuid('ticket_number');
            $table->double('cost');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('no action');
            $table->foreign('start_stop_id')->references('id')->on('trip_stops')->onDelete('no action');
            $table->foreign('end_stop_id')->references('id')->on('trip_stops')->onDelete('no action');
            $table->foreign('seat_id')->references('id')->on('bus_seats')->onDelete('no action');

            # Add Indexes for Foreign Keys, this will help with search performance as there will be many reads
            # compared to writes in order to find out if a seat is available.
            $table->index('user_id');
            $table->index('trip_id');
            $table->index('start_stop_id');
            $table->index('end_stop_id');
            $table->index('seat_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
