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
        Schema::create('rating', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('trip_id')->index('rating_trip_id_foreign');
            $table->unsignedInteger('user_id')->index('rating_user_id_foreign');
            $table->unsignedInteger('driver_id')->index('rating_driver_id_foreign');
            $table->integer('rider_rating');
            $table->text('rider_comments');
            $table->integer('driver_rating');
            $table->text('driver_comments');
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
        Schema::dropIfExists('rating');
    }
};
