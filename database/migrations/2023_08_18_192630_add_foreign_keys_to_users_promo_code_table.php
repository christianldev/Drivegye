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
        Schema::table('users_promo_code', function (Blueprint $table) {
            $table->foreign(['user_id'])->references(['id'])->on('users');
            $table->foreign(['promo_code_id'])->references(['id'])->on('promo_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_promo_code', function (Blueprint $table) {
            $table->dropForeign('users_promo_code_user_id_foreign');
            $table->dropForeign('users_promo_code_promo_code_id_foreign');
        });
    }
};
