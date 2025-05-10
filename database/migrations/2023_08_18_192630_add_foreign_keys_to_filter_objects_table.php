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
        Schema::table('filter_objects', function (Blueprint $table) {
            $table->foreign(['filter_id'])->references(['id'])->on('filter_options')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('filter_objects', function (Blueprint $table) {
            $table->dropForeign('filter_objects_filter_id_foreign');
        });
    }
};
