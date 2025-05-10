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
        Schema::create('users_promo_code', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('users_promo_code_user_id_foreign');
            $table->unsignedInteger('promo_code_id')->index('users_promo_code_promo_code_id_foreign');
            $table->integer('trip_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_promo_code');
    }
};
