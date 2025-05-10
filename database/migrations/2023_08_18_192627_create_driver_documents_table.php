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
        Schema::create('driver_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['Driver', 'Vehicle'])->default('Driver');
            $table->unsignedInteger('vehicle_id');
            $table->unsignedInteger('user_id');
            $table->string('document_id', 50);
            $table->text('document');
            $table->enum('status', ['0', '1', '2'])->default('0');
            $table->date('expired_date')->nullable();

            $table->index(['type', 'vehicle_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver_documents');
    }
};
