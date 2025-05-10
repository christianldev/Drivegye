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
        Schema::table('cancel', function (Blueprint $table) {
            $table->foreign(['trip_id'])->references(['id'])->on('trips')->onDelete('CASCADE');
            $table->foreign(['cancel_reason_id'])->references(['id'])->on('cancel_reasons')->onDelete('CASCADE');
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
        Schema::table('cancel', function (Blueprint $table) {
            $table->dropForeign('cancel_trip_id_foreign');
            $table->dropForeign('cancel_cancel_reason_id_foreign');
            $table->dropForeign('cancel_user_id_foreign');
        });
    }
};
