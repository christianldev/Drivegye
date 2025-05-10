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
        Schema::table('help', function (Blueprint $table) {
            $table->foreign(['category_id'])->references(['id'])->on('help_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('help', function (Blueprint $table) {
            $table->dropForeign('help_category_id_foreign');
        });
    }
};
