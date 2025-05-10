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
        Schema::create('emergency_sos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('emergency_sos_user_id_foreign');
            $table->string('name', 100);
            $table->string('country_code', 5)->nullable();
            $table->string('mobile_number', 20);
            $table->unsignedInteger('country_id')->nullable()->index('emergency_sos_country_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emergency_sos');
    }
};
