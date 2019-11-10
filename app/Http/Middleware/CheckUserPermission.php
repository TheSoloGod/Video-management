<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Services\VideoService\VideoServiceInterface;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserPermission
{
    protected $videoService;

    public function __construct(VideoServiceInterface $videoService)
    {
        $this->videoService = $videoService;
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
        $user = Auth::user();

        if ($user == null) {
            // plan B
        }

        return $next($request);
    }

    public function checkVideoPermission($video)
    {
        if ($video->type == 0) {
            return $videoPermission = 0;
        } elseif ($video->is_in_group == 0) {
            return $videoPermission = 1;
        } else {
            return $videoPermission = 2;
        }
    }

    public function checkUserPermission($user) {
        if ($user == null) {
            return $userPermission = 0;
        } elseif ($user->email_verified_at == null) {
            return $userPermission = 0;
        } elseif ($user->is_in_group == 0) {
            return $userPermission = 1;
        } else {
            return $userPermission = 2;
        }
    }

}
