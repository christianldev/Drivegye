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
        Schema::table('help_sub_category_lang', function (Blueprint $table) {
            $table->foreign(['sub_category_id'])->references(['id'])->on('help_subcategory')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('help_sub_category_lang', function (Blueprint $table) {
            $table->dropForeign('help_sub_category_lang_sub_category_id_foreign');
        });
    }
};
