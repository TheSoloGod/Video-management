<?php

use Illuminate\Database\Seeder;
use App\GroupVideo;

class GroupVideoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groupVideo = new GroupVideo();
        $groupVideo->group_id = '1';
        $groupVideo->video_id = '1';
        $groupVideo->save();

        $groupVideo = new GroupVideo();
        $groupVideo->group_id = '1';
        $groupVideo->video_id = '2';
        $groupVideo->save();

        $groupVideo = new GroupVideo();
        $groupVideo->group_id = '1';
        $groupVideo->video_id = '3';
        $groupVideo->save();

        $groupVideo = new GroupVideo();
        $groupVideo->group_id = '2';
        $groupVideo->video_id = '2';
        $groupVideo->save();

        $groupVideo = new GroupVideo();
        $groupVideo->group_id = '2';
        $groupVideo->video_id = '3';
        $groupVideo->save();
    }
}
