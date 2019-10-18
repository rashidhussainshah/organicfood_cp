<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrdersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('group_id')->after('user_id');
           $table->enum('type', ['hold','cash'])->default('hold')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('order', function (Blueprint $table) {
            $table->dropColumn('group_id');
            $table->dropColumn('farmer_id');
            $table->dropColumn('type');
        });
    }

}
