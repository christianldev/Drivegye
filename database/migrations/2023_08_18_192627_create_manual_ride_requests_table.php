<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manual_ride_requests', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('driver_id', 120);
            $table->string('car_type', 255);
            $table->string('pickup_address', 250);
            $table->string('dropoff_address', 250);
            $table->string('pickup_lat', 120);
            $table->string('pickup_lng', 120);
            $table->string('dropoff_lat', 120);
            $table->string('dropoff_lng', 120);
            $table->string('status', 11)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manual_ride_requests');
    }
};
