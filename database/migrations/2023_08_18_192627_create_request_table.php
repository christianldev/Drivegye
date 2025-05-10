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
        Schema::create('request', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('request_user_id_foreign');
            $table->unsignedInteger('seats')->default(1);
            $table->string('pickup_latitude', 100);
            $table->string('pickup_longitude', 100);
            $table->string('drop_latitude', 100);
            $table->string('drop_longitude', 100);
            $table->string('pickup_location', 255);
            $table->string('drop_location', 255);
            $table->unsignedInteger('car_id')->index('request_car_id_foreign');
            $table->integer('group_id')->nullable();
            $table->unsignedInteger('driver_id')->index('request_driver_id_foreign');
            $table->string('payment_mode', 50)->default('Credit Card');
            $table->string('schedule_id', 100)->default('Null');
            $table->unsignedInteger('location_id');
            $table->enum('additional_fare', ['Peak']);
            $table->string('peak_fare', 100);
            $table->string('additional_rider', 10);
            $table->string('timezone', 100);
            $table->text('trip_path');
            $table->string('status', 100)->default('Null')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request');
    }
};
