<?php

use Illuminate\Database\Seeder;
use App\Video;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $video = new Video();
        $video->title = 'video 1';
        $video->description = 'this is video 1';
        $video->type = '0';
        $video->status = 'success';
        $video->views = '10';
        $video->is_display = '1';
        $video->name = 'video1';
        $video->path = '1nQae7HTgBtSoQgzTF3ljXa8c_SwF_rZ_';
        $video->save();

        $video = new Video();
        $video->title = 'video 2';
        $video->description = 'this is video 2';
        $video->type = '0';
        $video->status = 'success';
        $video->views = '20';
        $video->is_display = '1';
        $video->name = 'video2';
        $video->path = '1nQae7HTgBtSoQgzTF3ljXa8c_SwF_rZ_';
        $video->save();

        $video = new Video();
        $video->title = 'video 3';
        $video->description = 'this is video 3';
        $video->type = '0';
        $video->status = 'success';
        $video->views = '30';
        $video->is_display = '1';
        $video->name = 'video3';
        $video->path = '1nQae7HTgBtSoQgzTF3ljXa8c_SwF_rZ_';
        $video->save();

        $video = new Video();
        $video->title = 'video 4';
        $video->description = 'this is video 4';
        $video->type = '1';
        $video->status = 'success';
        $video->views = '10';
        $video->is_display = '1';
        $video->name = 'video4';
        $video->path = '1nQae7HTgBtSoQgzTF3ljXa8c_SwF_rZ_';
        $video->save();

        $video = new Video();
        $video->title = 'video 5';
        $video->description = 'this is video 5';
        $video->type = '1';
        $video->status = 'success';
        $video->views = '15';
        $video->is_display = '1';
        $video->name = 'video5';
        $video->path = '1nQae7HTgBtSoQgzTF3ljXa8c_SwF_rZ_';
        $video->save();

        $video = new Video();
        $video->title = 'video 6';
        $video->description = 'this is video 6';
        $video->type = '0';
        $video->status = 'success';
        $video->views = '150';
        $video->is_display = '1';
        $video->name = 'video6';
        $video->path = '1nQae7HTgBtSoQgzTF3ljXa8c_SwF_rZ_';
        $video->save();
    }
}
