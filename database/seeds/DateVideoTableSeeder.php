<?php

use Illuminate\Database\Seeder;
use App\Models\DateVideo;

class DateVideoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dateVideo = new DateVideo();
        $dateVideo->date = '2019-10-10';
        $dateVideo->video_id = '1';
        $dateVideo->today_views = '10';
        $dateVideo->yesterday_views = '0';
        $dateVideo->view_rate = 'not calculated';
        $dateVideo->save();

        $dateVideo = new DateVideo();
        $dateVideo->date = '2019-10-10';
        $dateVideo->video_id = '2';
        $dateVideo->today_views = '20';
        $dateVideo->yesterday_views = '0';
        $dateVideo->view_rate = 'not calculated';
        $dateVideo->save();

        $dateVideo = new DateVideo();
        $dateVideo->date = '2019-10-11';
        $dateVideo->video_id = '1';
        $dateVideo->today_views = '60';
        $dateVideo->yesterday_views = '10';
        $dateVideo->view_rate = '500%';
        $dateVideo->save();

        $dateVideo = new DateVideo();
        $dateVideo->date = '2019-10-11';
        $dateVideo->video_id = '2';
        $dateVideo->today_views = '66';
        $dateVideo->yesterday_views = '20';
        $dateVideo->view_rate = '220%';
        $dateVideo->save();

        $dateVideo = new DateVideo();
        $dateVideo->date = '2019-10-11';
        $dateVideo->video_id = '3';
        $dateVideo->today_views = '55';
        $dateVideo->yesterday_views = '0';
        $dateVideo->view_rate = 'not calculated';
        $dateVideo->save();

        $dateVideo = new DateVideo();
        $dateVideo->date = '2019-10-12';
        $dateVideo->video_id = '1';
        $dateVideo->today_views = '15';
        $dateVideo->yesterday_views = '60';
        $dateVideo->view_rate = '-75%';
        $dateVideo->save();

        $dateVideo = new DateVideo();
        $dateVideo->date = '2019-10-12';
        $dateVideo->video_id = '5';
        $dateVideo->today_views = '25';
        $dateVideo->yesterday_views = '0';
        $dateVideo->view_rate = 'not calculated';
        $dateVideo->save();

        $dateVideo = new DateVideo();
        $dateVideo->date = '2019-10-12';
        $dateVideo->video_id = '4';
        $dateVideo->today_views = '40';
        $dateVideo->yesterday_views = '0';
        $dateVideo->view_rate = 'not calculated';
        $dateVideo->save();

        $dateVideo = new DateVideo();
        $dateVideo->date = '2019-10-15';
        $dateVideo->video_id = '2';
        $dateVideo->today_views = '22';
        $dateVideo->yesterday_views = '0';
        $dateVideo->view_rate = 'not calculated';
        $dateVideo->save();

        $dateVideo = new DateVideo();
        $dateVideo->date = '2019-10-15';
        $dateVideo->video_id = '4';
        $dateVideo->today_views = '44';
        $dateVideo->yesterday_views = '0';
        $dateVideo->view_rate = 'not calculated';
        $dateVideo->save();

        $dateVideo = new DateVideo();
        $dateVideo->date = '2019-10-20';
        $dateVideo->video_id = '3';
        $dateVideo->today_views = '33';
        $dateVideo->yesterday_views = '0';
        $dateVideo->view_rate = 'not calculated';
        $dateVideo->save();

        $dateVideo = new DateVideo();
        $dateVideo->date = '2019-11-1';
        $dateVideo->video_id = '1';
        $dateVideo->today_views = '11';
        $dateVideo->yesterday_views = '0';
        $dateVideo->view_rate = 'not calculated';
        $dateVideo->save();
    }
}
