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
        Schema::create('schedule_ride', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('schedule_ride_user_id_foreign');
            $table->unsignedInteger('company_id')->nullable()->index('schedule_ride_company_id_foreign');
            $table->string('schedule_date', 255);
            $table->string('schedule_time', 255);
            $table->string('schedule_end_date', 100);
            $table->string('schedule_end_time', 100);
            $table->string('pickup_latitude', 100);
            $table->string('pickup_longitude', 100);
            $table->string('drop_latitude', 100);
            $table->string('drop_longitude', 100);
            $table->string('pickup_location', 255);
            $table->string('drop_location', 255);
            $table->text('trip_path');
            $table->unsignedInteger('car_id')->index('schedule_ride_car_id_foreign');
            $table->unsignedInteger('location_id');
            $table->unsignedInteger('peak_id');
            $table->enum('booking_type', ['Manual Booking', 'Schedule Booking'])->default('Schedule Booking');
            $table->integer('driver_id')->default(0);
            $table->enum('status', ['Pending', 'Completed', 'Cancelled', 'Car Not Found'])->nullable()->index();
            $table->string('timezone', 100);
            $table->string('payment_method', 50);
            $table->string('fare_estimation', 15);
            $table->enum('is_wallet', ['Yes', 'No'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_ride');
    }
};
