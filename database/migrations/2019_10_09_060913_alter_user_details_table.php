
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_details', function (Blueprint $table) {
           
            $table->longText('about')->after('description')->nullable();
            $table->longText('delievery')->after('description')->nullable();
            $table->longText('return')->after('description')->nullable();
            $table->string('linkedin')->after('description')->nullable();
            $table->string('facebook')->after('description')->nullable();
            $table->string('twitter')->after('description')->nullable();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
           Schema::table('user_details', function (Blueprint $table) {
            $table->dropColumn('about');
            $table->dropColumn('delievery');
            $table->dropColumn('return');
            $table->dropColumn('linkedin');
            $table->dropColumn('facebook');
            $table->dropColumn('twitter');
        });
    }
}
