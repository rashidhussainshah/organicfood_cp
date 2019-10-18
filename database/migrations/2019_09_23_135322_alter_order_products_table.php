<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::table('order_products', function (Blueprint $table) {

            $table->bigInteger('order_farm_id')->unsigned()->after('product_id');
            $table->foreign('order_farm_id')->references('id')->on('orders_farm')->onDelete('cascade');
      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('order_products', function (Blueprint $table) {
           
            $table->dropColumn('order_farm_id');
            
        });
    }
}
