<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFaregensKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
     /*   Schema::table('bids', function (Blueprint $table) {
            $table->foreign('edication_id')->references('id')->on('educations')->onDelete('set null');
        });*/
      /*  Schema::table('images', function (Blueprint $table) {
            $table->foreign('main_id')->references('id')->on('main_page')->onDelete('set null');
        }
        );*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
