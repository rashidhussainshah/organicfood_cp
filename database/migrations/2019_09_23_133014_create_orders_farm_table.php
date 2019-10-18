<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersFarmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_farm', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->double('price')->default('0');
            $table->integer('quantity')->nullable();
            $table->bigInteger('farm_id')->unsigned();
            $table->foreign('farm_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->enum('status', ['onhold', 'processing', 'completed','cancelled','trash'])->default('processing');
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
        Schema::dropIfExists('orders_farm');
    }
}
