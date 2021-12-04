<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('coupon_id');
            $table->string('coupon_name');
            $table->string('coupon_code')->unique();
            $table->integer('coupon_type');
            $table->integer('coupon_value');
            $table->integer('coupon_min_value');
            $table->dateTime('expired_on');
            $table->integer('coupon_status');
            $table->dateTime('added_on');
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
        Schema::dropIfExists('coupons');
    }
}
