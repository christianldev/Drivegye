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
        Schema::create('peak_fare_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fare_id')->index('peak_fare_details_fare_id_foreign');
            $table->enum('type', ['Peak', 'Night']);
            $table->tinyInteger('day')->nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->decimal('price', 10);

            $table->index(['day', 'start_time', 'end_time']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peak_fare_details');
    }
};
