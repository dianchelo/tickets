<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', '100');
            $table->string('url_name', '150');
            $table->string('hash');
            $table->text('description');
            $table->datetime('event_date');
            $table->integer('location_id')->unsigned();
            $table->integer('amount_tickets')->unsigned();
            $table->string('event_colour');
            $table->ipAddress('creator');
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
        Schema::dropIfExists('events');
    }
}
