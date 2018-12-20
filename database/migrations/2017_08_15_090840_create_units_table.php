<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unit_name');
            $table->string('area_code')->unique();
            $table->string('phone')->nullable();
            $table->string('email');
            $table->text('address')->nullable();
            $table->string('unit_type');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->boolean('publication_status')->default(TRUE);
            $table->boolean('deletation_status')->default(FALSE);
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
        Schema::dropIfExists('units');
    }
}
