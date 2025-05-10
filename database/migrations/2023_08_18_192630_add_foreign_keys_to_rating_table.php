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
        Schema::table('rating', function (Blueprint $table) {
            $table->foreign(['trip_id'])->references(['id'])->on('trips')->onDelete('CASCADE');
            $table->foreign(['driver_id'])->references(['id'])->on('users')->onDelete('CASCADE');
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
        Schema::table('rating', function (Blueprint $table) {
            $table->dropForeign('rating_trip_id_foreign');
            $table->dropForeign('rating_driver_id_foreign');
            $table->dropForeign('rating_user_id_foreign');
        });
    }
};
