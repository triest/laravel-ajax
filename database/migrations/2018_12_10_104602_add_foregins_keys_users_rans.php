<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeginsKeysUsersRans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_rands', function (Blueprint $table) {
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('rands_id')->references('id')->on('a');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_rands', function (Blueprint $table) {
            $table->dropForeign('rands_id');
            $table->dropForeign('users_id');
        });
    }
}
