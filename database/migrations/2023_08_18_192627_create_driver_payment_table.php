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
        Schema::create('driver_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('driver_id')->index('driver_payment_driver_id_foreign');
            $table->unsignedInteger('last_trip_id');
            $table->string('currency_code', 10);
            $table->decimal('paid_amount', 7)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver_payment');
    }
};
