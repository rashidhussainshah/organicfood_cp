<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableTagsAddUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {            Schema::table('tags', function (Blueprint $table) {
                  $table->bigInteger('user_id')->unsigned()->after('name');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('product_id')->unsigned()->after('name');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

        });
          
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('product_id');
        });
    }
}
