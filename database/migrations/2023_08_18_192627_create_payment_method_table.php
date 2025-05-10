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
        Schema::create('payment_method', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('payment_method_user_id_foreign');
            $table->string('customer_id', 100)->nullable();
            $table->string('intent_id', 100)->nullable();
            $table->string('payment_method_id', 100)->nullable();
            $table->string('brand', 20)->nullable();
            $table->string('last4', 5)->nullable();
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
        Schema::dropIfExists('payment_method');
    }
};
