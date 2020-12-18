<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('channel_id');
            $table->foreign('channel_id')->references('id')->on('channels');
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
            $table->string('title');
            $table->text('description');
            $table->unsignedBigInteger('comments');
            $table->unsignedBigInteger('dislikes');
            $table->unsignedBigInteger('likes');
            $table->unsignedBigInteger('views');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
