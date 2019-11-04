<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\VideoService\VideoServiceInterface;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    protected $videoService;

    public function __construct(VideoServiceInterface $videoService)
    {
        $this->videoService = $videoService;
    }

    public function index()
    {
        $videos = $this->videoService->getPaginateAllVideoPublic();
        return view('welcome', compact('videos'));
    }

    public function showVideo($videoId)
    {
        $video = $this->videoService->getById($videoId);
        $recommendedVideos = $this->videoService->getRecommendedPublicVideos();
        return view('public.show-video', compact('video', 'recommendedVideos'));
    }
}
