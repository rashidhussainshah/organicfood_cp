<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrdersFarmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::table('orders_farm', function (Blueprint $table) {

            $table->timestamp('deleted_at')->nullable();
          
      
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
           
            $table->dropColumn('deleted_at');
            
        });
    }
}
