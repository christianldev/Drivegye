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
        Schema::table('cancel_reason_translations', function (Blueprint $table) {
            $table->foreign(['cancel_reason_id'])->references(['id'])->on('cancel_reasons')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cancel_reason_translations', function (Blueprint $table) {
            $table->dropForeign('cancel_reason_translations_cancel_reason_id_foreign');
        });
    }
};
