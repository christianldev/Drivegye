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
        Schema::create('filter_options_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('filter_option_id')->index('filter_options_translations_filter_option_id_foreign');
            $table->string('name', 255);
            $table->string('locale', 5);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filter_options_translations');
    }
};
