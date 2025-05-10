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
        Schema::table('schedule_cancel', function (Blueprint $table) {
            $table->foreign(['schedule_ride_id'])->references(['id'])->on('schedule_ride')->onDelete('CASCADE');
            $table->foreign(['cancel_reason_id'])->references(['id'])->on('cancel_reasons')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedule_cancel', function (Blueprint $table) {
            $table->dropForeign('schedule_cancel_schedule_ride_id_foreign');
            $table->dropForeign('schedule_cancel_cancel_reason_id_foreign');
        });
    }
};
