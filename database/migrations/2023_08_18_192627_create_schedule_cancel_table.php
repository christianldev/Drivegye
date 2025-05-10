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
        Schema::create('schedule_cancel', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('schedule_ride_id')->index('schedule_cancel_schedule_ride_id_foreign');
            $table->string('cancel_reason');
            $table->unsignedInteger('cancel_reason_id')->index('schedule_cancel_cancel_reason_id_foreign');
            $table->enum('cancel_by', ['Rider', 'Driver', 'Admin', 'Company']);
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
        Schema::dropIfExists('schedule_cancel');
    }
};
