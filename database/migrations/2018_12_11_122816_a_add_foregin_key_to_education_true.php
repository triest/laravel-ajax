<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AAddForeginKeyToEducationTrue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('a', function (Blueprint $table) {
            $table->foreign('education_id')->references('id')->on('education');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('a', function (Blueprint $table) {
            $table->dropForeign('education_id');
        });
    }
}