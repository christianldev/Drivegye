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
        Schema::create('transactions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('user_id', 120);
            $table->string('payment_id', 120);
            $table->decimal('amount', 11);
            $table->string('currency', 120);
            $table->string('pay_for', 120);
            $table->string('payment_type', 120);
            $table->string('transaction_id', 255)->nullable();
            $table->string('payment_desc', 255)->nullable();
            $table->enum('status', ['Pending', 'Paid', 'Failed'])->default('Pending');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
