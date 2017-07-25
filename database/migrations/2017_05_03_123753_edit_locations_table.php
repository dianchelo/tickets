<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('locations', function (Blueprint $table) {
            $table->string('name', '255');
            $table->integer('capacity')->unsigned();
            $table->string('street', '255');
            $table->integer('number')->unsigned();
            $table->string('additional');
            $table->string('city', '255');
            $table->string('zipcode');
            $table->string('country', '100');
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
    }
}
