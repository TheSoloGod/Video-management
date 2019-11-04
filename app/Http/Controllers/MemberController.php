<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\VideoService\VideoServiceInterface;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    protected $videoService;

    public function __construct(VideoServiceInterface $videoService)
    {
        $this->videoService = $videoService;
    }

    public function index()
    {
        $memberVideos = $this->videoService->getPaginateAllVideoMember();
        $allVideos = $this->videoService->getPaginateVideoDisplayShow();
        return view('home', compact('memberVideos', 'allVideos'));
    }
}
