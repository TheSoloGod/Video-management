<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDateVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('date_video', function (Blueprint $table) {
            $table->date('date');
            $table->unsignedBigInteger('video_id');
            $table->bigInteger('today_views');
            $table->bigInteger('yesterday_views');
            $table->string('view_rate')->nullable();
            $table->foreign('video_id')->references('id')->on('videos');
            $table->primary(array('date', 'video_id'));
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
        Schema::dropIfExists('date_video');
    }
}
