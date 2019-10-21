<?php


namespace App\Http\Controllers\Services\VideoService;


use App\Http\Controllers\Repositories\VideoRepository\VideoRepositoryInterface;

class VideoService implements VideoServiceInterface
{

    protected $videoRepository;

    public function __construct(VideoRepositoryInterface $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }
}
