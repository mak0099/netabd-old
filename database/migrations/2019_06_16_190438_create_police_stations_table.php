<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoliceStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('police_stations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('districts_id');
            $table->integer('thanas_id');
            $table->string('name');
            $table->foreign('districts_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('thanas_id')->references('id')->on('thanas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('police_stations');
    }
}
