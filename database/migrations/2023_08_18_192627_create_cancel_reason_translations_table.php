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
        Schema::create('cancel_reason_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cancel_reason_id');
            $table->string('locale', 5)->index();
            $table->string('reason');
            $table->timestamps();

            $table->unique(['cancel_reason_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cancel_reason_translations');
    }
};
