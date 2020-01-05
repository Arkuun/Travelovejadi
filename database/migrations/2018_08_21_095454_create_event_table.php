<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_wisata');
            $table->string('id_user');
            $table->string('nama');
            $table->string('image');
            $table->text('description');
            $table->integer('love')->nullable();
            $table->date('date_end');
            $table->date('date_start');
            $table->string('slug_event');
            $table->string('tag')->null();
            $table->integer('status');
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
        Schema::dropIfExists('event');
    }
}
