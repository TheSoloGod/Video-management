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
        $video->status = 'upload success';
        $video->views = '10';
        $video->is_display = '1';
        $video->name = 'video1';
        $video->path = '1on5uJG4_tTbP_K3fYf6KjfAL72oyF6Oi';
        $video->save();

        $video = new Video();
        $video->title = 'video 2';
        $video->description = 'this is video 2';
        $video->type = '0';
        $video->status = 'upload success';
        $video->views = '20';
        $video->is_display = '1';
        $video->name = 'video2';
        $video->path = '1on5uJG4_tTbP_K3fYf6KjfAL72oyF6Oi';
        $video->save();

        $video = new Video();
        $video->title = 'video 3';
        $video->description = 'this is video 3';
        $video->type = '0';
        $video->status = 'upload success';
        $video->views = '30';
        $video->is_display = '1';
        $video->name = 'video3';
        $video->path = '1on5uJG4_tTbP_K3fYf6KjfAL72oyF6Oi';
        $video->save();

        $video = new Video();
        $video->title = 'video 4';
        $video->description = 'this is video 4';
        $video->type = '0';
        $video->status = 'upload success';
        $video->views = '10';
        $video->is_display = '1';
        $video->is_in_group = '0';
        $video->name = 'video4';
        $video->path = '1on5uJG4_tTbP_K3fYf6KjfAL72oyF6Oi';
        $video->save();

        $video = new Video();
        $video->title = 'video 5';
        $video->description = 'this is video 5';
        $video->type = '0';
        $video->status = 'upload success';
        $video->views = '15';
        $video->is_display = '1';
        $video->is_in_group = '0';
        $video->name = 'video5';
        $video->path = '1on5uJG4_tTbP_K3fYf6KjfAL72oyF6Oi';
        $video->save();

        $video = new Video();
        $video->title = 'video 6';
        $video->description = 'this is video 6';
        $video->type = '1';
        $video->status = 'upload success';
        $video->views = '12';
        $video->is_display = '1';
        $video->is_in_group = '0';
        $video->name = 'video6';
        $video->path = '1on5uJG4_tTbP_K3fYf6KjfAL72oyF6Oi';
        $video->save();

        $video = new Video();
        $video->title = 'video 7';
        $video->description = 'this is video 7';
        $video->type = '1';
        $video->status = 'upload success';
        $video->views = '22';
        $video->is_display = '1';
        $video->is_in_group = '0';
        $video->name = 'video7';
        $video->path = '1on5uJG4_tTbP_K3fYf6KjfAL72oyF6Oi';
        $video->save();

        $video = new Video();
        $video->title = 'video 8';
        $video->description = 'this is video 8';
        $video->type = '1';
        $video->status = 'upload success';
        $video->views = '32';
        $video->is_display = '1';
        $video->is_in_group = '0';
        $video->name = 'video8';
        $video->path = '1on5uJG4_tTbP_K3fYf6KjfAL72oyF6Oi';
        $video->save();

        $video = new Video();
        $video->title = 'video 9';
        $video->description = 'this is video 9';
        $video->type = '1';
        $video->status = 'upload success';
        $video->views = '150';
        $video->is_display = '1';
        $video->is_in_group = '1';
        $video->name = 'video9';
        $video->path = '1on5uJG4_tTbP_K3fYf6KjfAL72oyF6Oi';
        $video->save();

        $video = new Video();
        $video->title = 'video 10';
        $video->description = 'this is video 10';
        $video->type = '1';
        $video->status = 'upload success';
        $video->views = '35';
        $video->is_display = '1';
        $video->is_in_group = '1';
        $video->name = 'video10';
        $video->path = '1on5uJG4_tTbP_K3fYf6KjfAL72oyF6Oi';
        $video->save();

        $video = new Video();
        $video->title = 'video 11';
        $video->description = 'this is video 11';
        $video->type = '1';
        $video->status = 'upload success';
        $video->views = '67';
        $video->is_display = '1';
        $video->is_in_group = '1';
        $video->name = 'video11';
        $video->path = '1on5uJG4_tTbP_K3fYf6KjfAL72oyF6Oi';
        $video->save();

        $video = new Video();
        $video->title = 'video 12';
        $video->description = 'this is video 12';
        $video->type = '1';
        $video->status = 'upload success';
        $video->views = '177';
        $video->is_display = '1';
        $video->is_in_group = '1';
        $video->name = 'video12';
        $video->path = '1on5uJG4_tTbP_K3fYf6KjfAL72oyF6Oi';
        $video->save();
    }
}
