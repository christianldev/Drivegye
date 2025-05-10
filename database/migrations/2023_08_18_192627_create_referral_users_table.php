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
        Schema::create('referral_users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('referral_users_user_id_foreign');
            $table->unsignedInteger('referral_id')->index('referral_users_referral_id_foreign');
            $table->enum('user_type', ['Rider', 'Driver']);
            $table->unsignedInteger('days');
            $table->unsignedInteger('trips');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('currency_code', 10)->nullable()->index('referral_users_currency_code_foreign');
            $table->decimal('amount', 11);
            $table->decimal('pending_amount', 11);
            $table->enum('payment_status', ['Pending', 'Expired', 'Completed'])->default('Pending');
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
        Schema::dropIfExists('referral_users');
    }
};
