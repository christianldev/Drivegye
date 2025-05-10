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
        Schema::table('schedule_ride', function (Blueprint $table) {
            $table->foreign(['company_id'])->references(['id'])->on('companies');
            $table->foreign(['car_id'])->references(['id'])->on('car_type')->onDelete('CASCADE');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedule_ride', function (Blueprint $table) {
            $table->dropForeign('schedule_ride_company_id_foreign');
            $table->dropForeign('schedule_ride_car_id_foreign');
            $table->dropForeign('schedule_ride_user_id_foreign');
        });
    }
};
