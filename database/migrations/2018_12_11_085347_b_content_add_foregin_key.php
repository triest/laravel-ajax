<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BContentAddForeginKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('b_content', function (Blueprint $table) {
            $table->integer('b_id')->unsigned()->index();
            $table->foreign('b_id')->references('id')->on('b');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('b_content', function (Blueprint $table) {
            $table->dropForeign('b_id');
        });
    }
}
