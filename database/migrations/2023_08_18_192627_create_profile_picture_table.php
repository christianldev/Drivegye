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
        Schema::create('profile_picture', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->unique();
            $table->text('src');
            $table->enum('photo_source', ['Facebook', 'Google', 'Local'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_picture');
    }
};
