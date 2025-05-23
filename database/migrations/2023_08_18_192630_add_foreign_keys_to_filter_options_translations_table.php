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
        Schema::table('filter_options_translations', function (Blueprint $table) {
            $table->foreign(['filter_option_id'])->references(['id'])->on('filter_options')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('filter_options_translations', function (Blueprint $table) {
            $table->dropForeign('filter_options_translations_filter_option_id_foreign');
        });
    }
};
