<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('bids', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->nullable(false);
            $table->string('femili', 50)->nullable(false);
            $table->string('phone', 50)->nullable(false);
            $table->string('email', 50)->nullable(false);
            $table->string('description', 3000)->nullable(false);
            $table->integer('edication_id')->unsigned()->index();

            $table->timestamps();
        });
        /*
        Schema::table('bids', function (Blueprint $table) {
            $table->foreign('edication_id')->references('id')->on('educations')->onDelete('set null');
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
        Schema::dropIfExists('image');
    }
}
