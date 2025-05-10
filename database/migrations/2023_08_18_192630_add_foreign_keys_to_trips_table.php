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
        Schema::table('trips', function (Blueprint $table) {
            $table->foreign(['toll_reason_id'])->references(['id'])->on('toll_reasons')->onDelete('CASCADE');
            $table->foreign(['currency_code'])->references(['code'])->on('currency');
            $table->foreign(['request_id'])->references(['id'])->on('request')->onDelete('CASCADE');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['car_id'])->references(['id'])->on('car_type')->onDelete('CASCADE');
            $table->foreign(['driver_id'])->references(['id'])->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->dropForeign('trips_toll_reason_id_foreign');
            $table->dropForeign('trips_currency_code_foreign');
            $table->dropForeign('trips_request_id_foreign');
            $table->dropForeign('trips_user_id_foreign');
            $table->dropForeign('trips_car_id_foreign');
            $table->dropForeign('trips_driver_id_foreign');
        });
    }
};
