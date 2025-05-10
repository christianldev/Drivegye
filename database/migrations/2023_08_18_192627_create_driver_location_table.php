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
        Schema::create('driver_location', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('driver_location_user_id_foreign');
            $table->string('latitude', 100);
            $table->string('longitude', 100);
            $table->unsignedInteger('car_id')->index('driver_location_car_id_foreign');
            $table->unsignedInteger('pool_trip_id')->nullable();
            $table->enum('status', ['Online', 'Offline', 'Trip', 'Pool Trip'])->default('Offline');
            $table->timestamps();

            $table->index(['status', 'latitude', 'longitude']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver_location');
    }
};
