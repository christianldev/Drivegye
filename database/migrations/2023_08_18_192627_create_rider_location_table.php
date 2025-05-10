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
        Schema::create('rider_location', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->unique();
            $table->text('home');
            $table->text('work');
            $table->string('home_latitude', 100);
            $table->string('home_longitude', 100);
            $table->string('work_latitude', 100);
            $table->string('work_longitude', 100);
            $table->string('latitude', 100);
            $table->string('longitude', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rider_location');
    }
};
