<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->text('body')->nullable();
            $table->integer('to');
            $table->integer('from');
            $table->string('file_name')->nullable();
            $table->string('file_directory')->nullable();
            $table->boolean('publication_status')->default(true);
            $table->boolean('deletation_status')->default(false);
            $table->integer('created_by');
            $table->integer('seen_by')->nullable();
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
        Schema::dropIfExists('messages');
    }
}
