<?php

namespace App\Http\Middleware;

use App\Services\GroupUserService\GroupUserServiceInterface;
use App\Services\GroupVideoService\GroupVideoServiceInterface;
use App\Services\VideoService\VideoServiceInterface;
use Closure;

class CheckUserVideoIsInGroup
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
            if ($this->checkUserIsInGroup($request->user_id, $request->group_id)
                && $this->checkVideoIsInGroup($request->video_id, $request->group_id)) {
                return $next($request);
            } else {
                return redirect()->back()->with('error', 'Please join other group to see this video');
            }
        } else {
            return $next($request);
        }
    }


    public function checkUserIsInGroup($userId, $groupId)
    {
        $groupUser = $this->groupUserService->getByUserGroupId($userId, $groupId);
        if ($groupUser == null) {
            return false;
        } else {
            return true;
        }
    }

    public function checkVideoIsInGroup($videoId, $groupId)
    {
        $groupVideo = $this->groupVideoService->getByGroupVideoId($videoId, $groupId);
        if ($groupVideo == null) {
            return false;
        } else {
            return true;
        }
    }
}
