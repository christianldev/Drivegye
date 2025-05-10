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
        Schema::table('documents_langs', function (Blueprint $table) {
            $table->foreign(['documents_id'])->references(['id'])->on('documents')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documents_langs', function (Blueprint $table) {
            $table->dropForeign('documents_langs_documents_id_foreign');
        });
    }
};
