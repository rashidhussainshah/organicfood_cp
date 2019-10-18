<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProductAddLocationId extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('products', function (Blueprint $table) {


            $table->bigInteger('location_id')->unsigned()->after('user_id');
            $table->foreign('location_id')->references('id')->on('user_locations')->onDelete('cascade');
//             $table->boolean('is_draft')->after('quantity')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('products', function (Blueprint $table) {

            $table->dropColumn('location_id');
        });
    }

}
