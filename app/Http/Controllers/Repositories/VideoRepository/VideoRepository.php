<?php


namespace App\Http\Controllers\Repositories\VideoRepository;


use App\Http\Controllers\Repositories\Eloquent\EloquentRepository;
use App\Video;

class VideoRepository extends EloquentRepository implements VideoRepositoryInterface
{

    public function getModel()
    {
        return Video::class;
    }
}
