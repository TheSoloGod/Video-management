<?php

use Illuminate\Database\Seeder;
use App\Models\UserVideo;

class UserVideoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userVideo = new UserVideo();
        $userVideo->user_id = '1';
        $userVideo->video_id = '1';
        $userVideo->save();

        $userVideo = new UserVideo();
        $userVideo->user_id = '1';
        $userVideo->video_id = '2';
        $userVideo->save();

        $userVideo = new UserVideo();
        $userVideo->user_id = '1';
        $userVideo->video_id = '3';
        $userVideo->save();

        $userVideo = new UserVideo();
        $userVideo->user_id = '2';
        $userVideo->video_id = '4';
        $userVideo->save();

        $userVideo = new UserVideo();
        $userVideo->user_id = '3';
        $userVideo->video_id = '1';
        $userVideo->save();

        $userVideo = new UserVideo();
        $userVideo->user_id = '3';
        $userVideo->video_id = '3';
        $userVideo->save();

        $userVideo = new UserVideo();
        $userVideo->user_id = '3';
        $userVideo->video_id = '5';
        $userVideo->save();
    }
}
