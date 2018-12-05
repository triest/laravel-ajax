<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image_name', 50)->nullable(false);
            $table->integer('main_id')->unsigned()->index();
            $table->timestamps();
        });
        /*
        Schema::table('images', function (Blueprint $table) {
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
        Schema::dropIfExists('image');
    }
}
