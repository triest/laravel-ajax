<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeginsKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users_bids', function (Blueprint $table) {
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('bids_id')->references('id')->on('bids');
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
        Schema::table('users_bids', function (Blueprint $table) {
            $table->dropForeign('users_id');
            $table->dropForeign('users_id');
        });
    }
}
