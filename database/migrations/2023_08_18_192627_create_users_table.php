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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 100);
            $table->string('country_code', 100);
            $table->enum('gender', ['1', '2'])->nullable();
            $table->string('mobile_number', 20);
            $table->string('password')->nullable();
            $table->enum('user_type', ['Rider', 'Driver'])->nullable();
            $table->unsignedInteger('company_id')->nullable()->index('users_company_id_foreign');
            $table->rememberToken();
            $table->text('firebase_token')->nullable();
            $table->string('fb_id', 50)->nullable()->unique();
            $table->string('google_id', 50)->nullable()->unique();
            $table->string('apple_id')->nullable()->unique();
            $table->enum('status', ['Active', 'Inactive', 'Pending', 'Car_details', 'Document_details'])->nullable();
            $table->enum('device_type', ['1', '2'])->nullable();
            $table->text('device_id');
            $table->string('referral_code', 12);
            $table->string('used_referral_code', 12)->nullable();
            $table->string('currency_code', 10)->nullable();
            $table->string('language', 50);
            $table->unsignedInteger('country_id')->nullable()->index('users_country_id_foreign');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'user_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
