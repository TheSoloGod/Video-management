<?php

namespace App\Http\Middleware;

use App\Services\VideoService\VideoServiceInterface;
use Closure;

class CheckVideoPublic
{
    protected $videoService;

    public function __construct(VideoServiceInterface $videoService)
    {
        $this->videoService = $videoService;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $videoId = $request->video_id;
        $video = $this->videoService->getById($videoId);
        if ($video->type == 1) {
            return redirect()->back()->with('error', 'Please register to see this video');
        }
        return $next($request);
    }
}
