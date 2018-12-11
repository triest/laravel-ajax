<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeginsKeyForContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('a_content', function (Blueprint $table) {
            $table->foreign('content_id')->references('id')->on('a');
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
        Schema::table('a_content', function (Blueprint $table) {
            $table->dropForeign('content_id');
        });
    }
}
