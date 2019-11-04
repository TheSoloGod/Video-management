<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\VideoService\VideoServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    protected $videoService;

    public function __construct(VideoServiceInterface $videoService)
    {
        $this->videoService = $videoService;
    }

    public function index()
    {
        $publicVideos = $this->videoService->getPaginateAllVideoPublic();
        return view('welcome', compact('publicVideos'));
    }

    public function showVideo($videoId)
    {
        $video = $this->videoService->getById($videoId);
        $recommendedVideos = $this->videoService->getRecommendedPublicVideos();
        return view('public.show-video', compact('video', 'recommendedVideos'));
    }
}
