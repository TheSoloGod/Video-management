<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\CategoryService\CategoryServiceInterface;
use App\Http\Controllers\Services\DateVideoService\DateVideoServiceInterface;
use App\Http\Controllers\Services\VideoService\VideoServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    protected $videoService;
    protected $categoryService;
    protected $dateVideoService;

    public function __construct(VideoServiceInterface $videoService,
                                CategoryServiceInterface $categoryService,
                                DateVideoServiceInterface $dateVideoService)
    {
        $this->videoService = $videoService;
        $this->categoryService = $categoryService;
        $this->dateVideoService = $dateVideoService;
    }

    public function index()
    {
        $publicVideos = $this->videoService->getPaginateAllVideoPublic();
        $categories = $this->categoryService->getAll();
        return view('welcome', compact('publicVideos', 'categories'));
    }

    public function showVideo($videoId)
    {
        $this->dateVideoService->incrementVideoView($videoId);
        $video = $this->videoService->getById($videoId);
        $recommendedVideos = $this->videoService->getRecommendedPublicVideos();
        $categories = $this->categoryService->getAll();
        $favoriteStatus = false;
        return view('public.show-video', compact('video', 'recommendedVideos', 'categories', 'favoriteStatus'));
    }
}
