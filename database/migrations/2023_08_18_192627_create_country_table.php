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
        Schema::create('country', function (Blueprint $table) {
            $table->increments('id');
            $table->string('short_name', 5)->unique();
            $table->string('long_name', 100);
            $table->string('iso3', 10)->nullable();
            $table->string('num_code', 10)->nullable();
            $table->string('phone_code', 10);
            $table->enum('stripe_country', ['Yes', 'No'])->default('No');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country');
    }
};
