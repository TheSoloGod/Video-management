<?php

use Illuminate\Database\Seeder;
use App\Models\GroupVideo;
//use App\GroupVideo;

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
        $groupVideo->video_id = '9';
        $groupVideo->save();

        $groupVideo = new GroupVideo();
        $groupVideo->group_id = '1';
        $groupVideo->video_id = '10';
        $groupVideo->save();

        $groupVideo = new GroupVideo();
        $groupVideo->group_id = '1';
        $groupVideo->video_id = '11';
        $groupVideo->save();

        $groupVideo = new GroupVideo();
        $groupVideo->group_id = '2';
        $groupVideo->video_id = '9';
        $groupVideo->save();

        $groupVideo = new GroupVideo();
        $groupVideo->group_id = '2';
        $groupVideo->video_id = '12';
        $groupVideo->save();
    }
}
