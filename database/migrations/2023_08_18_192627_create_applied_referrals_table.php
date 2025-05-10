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
        Schema::create('applied_referrals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('applied_referrals_user_id_foreign');
            $table->decimal('amount', 11);
            $table->string('currency_code', 10)->nullable()->index('applied_referrals_currency_code_foreign');
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
        Schema::dropIfExists('applied_referrals');
    }
};
