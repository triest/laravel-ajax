<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeginKeyInContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rand_content', function (Blueprint $table) {
            //
            $table->integer('rand_id')->unsigned()->index();
            $table->foreign('rand_id')->references('id')->on('a');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rand_content', function (Blueprint $table) {
            $table->dropForeign('rand_id');
        });
    }
}
