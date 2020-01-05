<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareMoment extends Migration
{
    
    public function up()
    {
        Schema::create('share_moment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('image');
            $table->text('content');
            $table->integer('love')->nullable();
            $table->integer('status');
            $table->integer('id_user'); 
            $table->string('slug');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('share_moment');
    }
}
