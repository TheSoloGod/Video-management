<?php

use Illuminate\Database\Seeder;
use App\Models\CategoryVideo;

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

        $categoryVideo = new CategoryVideo();
        $categoryVideo->category_id = '1';
        $categoryVideo->video_id = '12';
        $categoryVideo->save();

        $categoryVideo = new CategoryVideo();
        $categoryVideo->category_id = '1';
        $categoryVideo->video_id = '19';
        $categoryVideo->save();

        $categoryVideo = new CategoryVideo();
        $categoryVideo->category_id = '2';
        $categoryVideo->video_id = '16';
        $categoryVideo->save();

        $categoryVideo = new CategoryVideo();
        $categoryVideo->category_id = '2';
        $categoryVideo->video_id = '8';
        $categoryVideo->save();

        $categoryVideo = new CategoryVideo();
        $categoryVideo->category_id = '2';
        $categoryVideo->video_id = '13';
        $categoryVideo->save();

        $categoryVideo = new CategoryVideo();
        $categoryVideo->category_id = '3';
        $categoryVideo->video_id = '20';
        $categoryVideo->save();

        $categoryVideo = new CategoryVideo();
        $categoryVideo->category_id = '3';
        $categoryVideo->video_id = '18';
        $categoryVideo->save();

        $categoryVideo = new CategoryVideo();
        $categoryVideo->category_id = '4';
        $categoryVideo->video_id = '1';
        $categoryVideo->save();

        $categoryVideo = new CategoryVideo();
        $categoryVideo->category_id = '4';
        $categoryVideo->video_id = '11';
        $categoryVideo->save();

        $categoryVideo = new CategoryVideo();
        $categoryVideo->category_id = '4';
        $categoryVideo->video_id = '6';
        $categoryVideo->save();

        $categoryVideo = new CategoryVideo();
        $categoryVideo->category_id = '5';
        $categoryVideo->video_id = '12';
        $categoryVideo->save();

        $categoryVideo = new CategoryVideo();
        $categoryVideo->category_id = '5';
        $categoryVideo->video_id = '7';
        $categoryVideo->save();

        $categoryVideo = new CategoryVideo();
        $categoryVideo->category_id = '5';
        $categoryVideo->video_id = '15';
        $categoryVideo->save();
    }
}
