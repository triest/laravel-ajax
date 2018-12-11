<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('a', function (Blueprint $table) {
            $table->string('name', 50)->nullable(true);
            $table->string('femili', 50)->nullable(true);
            $table->string('phone', 50)->nullable(true);
            $table->string('email', 50)->nullable(true);
            // $table->text('description')->nullable(true);
            $table->integer('education_id')->unsigned()->index();
            $table->string('ip')->nullable(true);
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
        Schema::table('a', function (Blueprint $table) {
            $table->dropColumn('admin');
            $table->dropColumn('name');
            $table->dropColumn('femili');
            $table->dropColumn('phone');
            $table->dropColumn('email');
            $table->dropColumn('description');
            $table->dropColumn('education_id');
            $table->dropColumn('ip');
        });
    }
}
