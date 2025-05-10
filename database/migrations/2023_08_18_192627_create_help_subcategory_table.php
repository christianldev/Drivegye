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
        Schema::create('help_subcategory', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id')->index('help_subcategory_category_id_foreign');
            $table->string('name', 25);
            $table->text('description');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('help_subcategory');
    }
};
