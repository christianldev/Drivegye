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
        Schema::create('company_payout_credentials', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->index('company_payout_credentials_company_id_foreign');
            $table->string('preference_id', 10);
            $table->enum('default', ['no', 'yes']);
            $table->string('type', 30);
            $table->string('payout_id', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_payout_credentials');
    }
};
