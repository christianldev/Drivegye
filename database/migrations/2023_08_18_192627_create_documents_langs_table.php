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
        Schema::create('documents_langs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('documents_id');
            $table->string('document_name');
            $table->string('locale', 5)->index();

            $table->unique(['documents_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents_langs');
    }
};
