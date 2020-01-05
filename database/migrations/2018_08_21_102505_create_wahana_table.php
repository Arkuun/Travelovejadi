<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWahanaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wahana', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_wisata');
            $table->integer('id_user');
            $table->integer('id_kat_wahana');
            $table->string('name');
            $table->text('description');
            $table->string('image');
            $table->string('htm')->nullable();
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
        Schema::dropIfExists('wahana');
    }
}
