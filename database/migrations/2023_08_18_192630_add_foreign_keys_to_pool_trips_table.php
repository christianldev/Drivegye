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
        Schema::table('pool_trips', function (Blueprint $table) {
            $table->foreign(['driver_id'])->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['currency_code'])->references(['code'])->on('currency');
            $table->foreign(['toll_reason_id'])->references(['id'])->on('toll_reasons')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pool_trips', function (Blueprint $table) {
            $table->dropForeign('pool_trips_driver_id_foreign');
            $table->dropForeign('pool_trips_currency_code_foreign');
            $table->dropForeign('pool_trips_toll_reason_id_foreign');
        });
    }
};
