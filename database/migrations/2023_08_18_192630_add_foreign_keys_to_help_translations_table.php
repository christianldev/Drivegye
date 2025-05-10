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
        Schema::table('help_translations', function (Blueprint $table) {
            $table->foreign(['help_id'])->references(['id'])->on('help')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('help_translations', function (Blueprint $table) {
            $table->dropForeign('help_translations_help_id_foreign');
        });
    }
};
