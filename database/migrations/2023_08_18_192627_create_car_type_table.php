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
        Schema::create('car_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('car_name');
            $table->string('description')->nullable();
            $table->string('vehicle_image');
            $table->string('active_image');
            $table->enum('is_pool', ['Yes', 'No'])->default('No');
            $table->enum('status', ['Active', 'Inactive'])->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_type');
    }
};
