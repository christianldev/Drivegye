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
        Schema::create('driver_owe_amount_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('driver_owe_amount_payments_user_id_foreign');
            $table->string('transaction_id', 70)->nullable();
            $table->decimal('amount', 11)->nullable();
            $table->string('currency_code', 50)->nullable();
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('driver_owe_amount_payments');
    }
};
