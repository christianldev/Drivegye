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
        Schema::table('trip_toll_reasons', function (Blueprint $table) {
            $table->foreign(['trip_id'])->references(['id'])->on('trips')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trip_toll_reasons', function (Blueprint $table) {
            $table->dropForeign('trip_toll_reasons_trip_id_foreign');
        });
    }
};
