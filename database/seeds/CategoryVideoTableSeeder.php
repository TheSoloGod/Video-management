<?php

use Illuminate\Database\Seeder;
use App\CategoryVideo;

class CategoryVideoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryVideo = new CategoryVideo();
        $categoryVideo->category_id = '1';
        $categoryVideo->video_id = '1';
        $categoryVideo->save();

        $categoryVideo = new CategoryVideo();
        $categoryVideo->category_id = '2';
        $categoryVideo->video_id = '1';
        $categoryVideo->save();

        $categoryVideo = new CategoryVideo();
        $categoryVideo->category_id = '3';
        $categoryVideo->video_id = '2';
        $categoryVideo->save();

        $categoryVideo = new CategoryVideo();
        $categoryVideo->category_id = '4';
        $categoryVideo->video_id = '2';
        $categoryVideo->save();

        $categoryVideo = new CategoryVideo();
        $categoryVideo->category_id = '1';
        $categoryVideo->video_id = '4';
        $categoryVideo->save();

        $categoryVideo = new CategoryVideo();
        $categoryVideo->category_id = '3';
        $categoryVideo->video_id = '4';
        $categoryVideo->save();

        $categoryVideo = new CategoryVideo();
        $categoryVideo->category_id = '5';
        $categoryVideo->video_id = '4';
        $categoryVideo->save();
    }
}
