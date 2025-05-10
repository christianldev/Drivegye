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
        Schema::create('manage_fare', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('location_id');
            $table->integer('vehicle_id')->default(0);
            $table->decimal('base_fare', 5);
            $table->integer('capacity');
            $table->decimal('min_fare', 5);
            $table->decimal('per_min', 5);
            $table->decimal('per_km', 5);
            $table->decimal('schedule_fare', 5);
            $table->decimal('schedule_cancel_fare', 5);
            $table->integer('waiting_time')->nullable();
            $table->decimal('waiting_charge', 5);
            $table->string('currency_code', 10)->nullable()->index('manage_fare_currency_code_foreign');
            $table->enum('apply_peak', ['Yes', 'No']);
            $table->enum('apply_night', ['Yes', 'No']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manage_fare');
    }
};
