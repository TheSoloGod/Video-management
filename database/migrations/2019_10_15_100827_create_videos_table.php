<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('description');
            $table->string('type')->default(0);
            $table->string('status');
            $table->bigInteger('views')->default(0);
            $table->bigInteger('favorite')->default(0);
            $table->string('image')->default('preview-default.jpg');
            $table->tinyInteger('is_display')->default(0);
            $table->dateTime('delete_at')->nullable();
            $table->string('name');
            $table->string('path')->nullable();
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
        Schema::dropIfExists('videos');
    }
}
