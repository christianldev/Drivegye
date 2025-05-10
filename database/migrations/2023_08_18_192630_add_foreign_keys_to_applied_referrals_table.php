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
        Schema::table('applied_referrals', function (Blueprint $table) {
            $table->foreign(['user_id'])->references(['id'])->on('users');
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
        Schema::table('applied_referrals', function (Blueprint $table) {
            $table->dropForeign('applied_referrals_user_id_foreign');
            $table->dropForeign('applied_referrals_currency_code_foreign');
        });
    }
};
