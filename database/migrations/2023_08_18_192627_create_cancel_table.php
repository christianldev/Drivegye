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
        Schema::create('cancel', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('trip_id')->index('cancel_trip_id_foreign');
            $table->unsignedInteger('user_id')->index('cancel_user_id_foreign');
            $table->unsignedInteger('cancel_reason_id')->index('cancel_cancel_reason_id_foreign');
            $table->text('cancel_comments');
            $table->enum('cancelled_by', ['Rider', 'Driver'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cancel');
    }
};
