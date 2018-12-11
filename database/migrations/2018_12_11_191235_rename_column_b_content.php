<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnBContent extends Migration
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
            $table->renameColumn('content_id', 'b_content');
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
            $table->renameColumn('b_id', 'content_id');
        });
    }
}
