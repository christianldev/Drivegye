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
        Schema::table('request', function (Blueprint $table) {
            $table->foreign(['driver_id'])->references(['id'])->on('users')->onDelete('CASCADE');
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
        Schema::table('request', function (Blueprint $table) {
            $table->dropForeign('request_driver_id_foreign');
            $table->dropForeign('request_car_id_foreign');
            $table->dropForeign('request_user_id_foreign');
        });
    }
};
