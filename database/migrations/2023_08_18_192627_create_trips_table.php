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
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('trips_user_id_foreign');
            $table->unsignedInteger('pool_id');
            $table->string('pickup_latitude', 100);
            $table->string('pickup_longitude', 100);
            $table->string('drop_latitude', 100);
            $table->string('drop_longitude', 100);
            $table->string('pickup_location', 255);
            $table->string('drop_location', 255);
            $table->unsignedInteger('car_id')->index('trips_car_id_foreign');
            $table->unsignedInteger('request_id')->index('trips_request_id_foreign');
            $table->unsignedInteger('driver_id')->index('trips_driver_id_foreign');
            $table->text('trip_path');
            $table->text('map_image');
            $table->unsignedTinyInteger('seats');
            $table->decimal('total_time', 7);
            $table->decimal('total_km', 7);
            $table->decimal('time_fare', 11);
            $table->decimal('distance_fare', 11);
            $table->decimal('base_fare', 11);
            $table->unsignedInteger('additional_rider');
            $table->decimal('additional_rider_amount', 11);
            $table->decimal('peak_fare', 11);
            $table->decimal('peak_amount', 11);
            $table->decimal('driver_peak_amount', 11);
            $table->decimal('schedule_fare', 11);
            $table->decimal('access_fee', 11);
            $table->decimal('tips', 11)->default(0);
            $table->decimal('waiting_charge', 11)->default(0);
            $table->unsignedInteger('toll_reason_id')->nullable()->index('trips_toll_reason_id_foreign');
            $table->decimal('toll_fee', 11)->default(0);
            $table->decimal('wallet_amount', 11);
            $table->decimal('promo_amount', 11);
            $table->decimal('subtotal_fare', 11);
            $table->decimal('total_fare', 11);
            $table->decimal('driver_payout', 11);
            $table->decimal('driver_or_company_commission', 11);
            $table->decimal('owe_amount', 11);
            $table->decimal('remaining_owe_amount', 11);
            $table->decimal('applied_owe_amount', 11);
            $table->string('to_trip_id', 100);
            $table->timestamp('arrive_time')->default('0000-00-00 00:00:00');
            $table->timestamp('begin_trip')->default('0000-00-00 00:00:00');
            $table->timestamp('end_trip')->default('0000-00-00 00:00:00');
            $table->text('paykey');
            $table->string('payment_mode', 50)->default('Braintree');
            $table->enum('payment_status', ['Pending', 'Completed', 'Trip Cancelled'])->default('Pending');
            $table->enum('is_calculation', ['1', '0'])->default('0');
            $table->string('currency_code', 10)->index('trips_currency_code_foreign');
            $table->text('fare_estimation');
            $table->enum('status', ['Scheduled', 'Cancelled', 'Begin trip', 'End trip', 'Payment', 'Rating', 'Completed', 'Null'])->default('Null');
            $table->string('otp', 10)->default('Null');
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
        Schema::dropIfExists('trips');
    }
};
