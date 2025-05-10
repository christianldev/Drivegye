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
        Schema::create('referral_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 25);
            $table->string('value', 25);
            $table->enum('user_type', ['Driver', 'Rider']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referral_settings');
    }
};
