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
        Schema::table('peak_fare_details', function (Blueprint $table) {
            $table->foreign(['fare_id'])->references(['id'])->on('manage_fare');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('peak_fare_details', function (Blueprint $table) {
            $table->dropForeign('peak_fare_details_fare_id_foreign');
        });
    }
};
