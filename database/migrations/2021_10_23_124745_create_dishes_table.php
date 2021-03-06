<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->bigIncrements('dish_id')->unsigned()->autoIncrement();
            $table->unsignedBigInteger('category_id');
            $table->string('dish_name');
            $table->longText('dish_detail');
            $table->text('dish_image');
            $table->integer('dish_status');
            $table->dateTime('added_on');
            $table->float('full_price', 10, 2)->nullable();
            $table->float('half_price', 10, 2)->nullable();
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('dishes');
    }
}
