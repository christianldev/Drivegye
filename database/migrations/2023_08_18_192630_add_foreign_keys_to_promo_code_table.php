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
        Schema::table('promo_code', function (Blueprint $table) {
            $table->foreign(['currency_code'])->references(['code'])->on('currency');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('promo_code', function (Blueprint $table) {
            $table->dropForeign('promo_code_currency_code_foreign');
        });
    }
};
