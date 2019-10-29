<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_video', function (Blueprint $table) {
            $table->unsignedInteger('group_id');
            $table->unsignedBigInteger('video_id');
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('video_id')->references('id')->on('videos');
            $table->primary(array('group_id', 'video_id'));
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
        Schema::dropIfExists('group_video');
    }
}
