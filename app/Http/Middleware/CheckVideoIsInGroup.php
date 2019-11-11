<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Services\GroupUserService\GroupUserServiceInterface;
use App\Http\Controllers\Services\GroupVideoService\GroupVideoServiceInterface;
use App\Http\Controllers\Services\VideoService\VideoServiceInterface;
use Closure;

class CheckVideoIsInGroup
{
    protected $videoService;
    protected $groupUserService;
    protected $groupVideoService;

    public function __construct(VideoServiceInterface $videoService,
                                GroupUserServiceInterface $groupUserService,
                                GroupVideoServiceInterface $groupVideoService)
    {
        $this->videoService = $videoService;
        $this->groupUserService = $groupUserService;
        $this->groupVideoService = $groupVideoService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $videoId = $request->video_id;
        $video = $this->videoService->getById($videoId);
        if ($video->is_in_group == 1) {
            return redirect()->back();
        } else {
            return $next($request);
        }
    }
}
