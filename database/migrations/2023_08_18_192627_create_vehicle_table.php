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
        Schema::create('vehicle', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('vehicle_user_id_foreign');
            $table->unsignedInteger('company_id')->nullable()->index('vehicle_company_id_foreign');
            $table->integer('vehicle_make_id');
            $table->integer('vehicle_model_id');
            $table->string('vehicle_id', 255);
            $table->string('vehicle_type', 100);
            $table->string('vehicle_name', 100);
            $table->string('vehicle_number');
            $table->boolean('is_active')->default(false);
            $table->string('year');
            $table->string('color');
            $table->enum('default_type', ['0', '1'])->default('0');
            $table->enum('status', ['Active', 'Inactive'])->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle');
    }
};
