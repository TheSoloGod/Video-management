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
        $video->type = 'public';
        $video->status = 'success';
        $video->views = '10';
        $video->image = 'image1';
        $video->is_display = '1';
        $video->is_in_group = '1';
        $video->save();

        $video = new Video();
        $video->title = 'video 2';
        $video->description = 'this is video 2';
        $video->type = 'public';
        $video->status = 'success';
        $video->views = '20';
        $video->image = 'image2';
        $video->is_display = '1';
        $video->is_in_group = '1';
        $video->save();

        $video = new Video();
        $video->title = 'video 3';
        $video->description = 'this is video 3';
        $video->type = 'public';
        $video->status = 'success';
        $video->views = '30';
        $video->image = 'image3';
        $video->is_display = '1';
        $video->is_in_group = '1';
        $video->save();

        $video = new Video();
        $video->title = 'video 4';
        $video->description = 'this is video 4';
        $video->type = 'member';
        $video->status = 'success';
        $video->views = '10';
        $video->image = 'image4';
        $video->is_display = '1';
        $video->is_in_group = '1';
        $video->save();

        $video = new Video();
        $video->title = 'video 5';
        $video->description = 'this is video 5';
        $video->type = 'member';
        $video->status = 'success';
        $video->views = '15';
        $video->image = 'image5';
        $video->is_display = '1';
        $video->is_in_group = '1';
        $video->save();
    }
}
