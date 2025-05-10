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
        Schema::create('wallet', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->unique();
            $table->integer('accountno', true)->unique('accountno');
            $table->decimal('amount', 7);
            $table->string('currency_code', 10)->index('wallet_currency_code_foreign');
            $table->text('paykey')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet');
    }
};
