<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RanameColumnsRandContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('rand_content', function (Blueprint $table) {
            $table->renameColumn('rand_id', 'b_id');
            //$table->renameColumn('randOrganizer', 'bOrganizer');
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
        Schema::table('rand_content', function (Blueprint $table) {
            $table->renameColumn('b_id', 'rand_id');
            //$table->renameColumn('randOrganizer', 'bOrganizer');
        });
    }
}
