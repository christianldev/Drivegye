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
        Schema::create('help_sub_category_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sub_category_id');
            $table->string('name');
            $table->longText('description');
            $table->string('locale', 5)->index();
            $table->timestamps();

            $table->unique(['sub_category_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('help_sub_category_lang');
    }
};
