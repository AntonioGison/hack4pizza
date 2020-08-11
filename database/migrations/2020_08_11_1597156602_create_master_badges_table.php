<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterBadgesTable extends Migration
{
    public function up()
    {
        Schema::create('master_badges', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name',191);
            $table->integer('number');
            $table->string('pic',191)->nullable();
            $table->text('description')->nullable();
            $table->integer('badge_id')->unsigned();
            $table->timestamps();
            $table->foreign('badge_id')->references('id')->on('badges')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_badges');
    }
}
