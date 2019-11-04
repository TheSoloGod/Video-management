<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\GroupService\GroupServiceInterface;
use App\Http\Controllers\Services\VideoService\VideoServiceInterface;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    protected $videoService;
    protected $groupService;

    public function __construct(VideoServiceInterface $videoService,
                                GroupServiceInterface $groupService)
    {
        $this->videoService = $videoService;
        $this->groupService = $groupService;
    }

    public function index()
    {
        $memberVideos = $this->videoService->getPaginateAllVideoMember();
        $allVideos = $this->videoService->getPaginateVideoDisplayShow();
        return view('home', compact('memberVideos', 'allVideos'));
    }

    public function getGroup($userId)
    {
        $groups = $this->groupService->getPaginateGroupMember($userId);
        $otherGroups = $this->groupService->getPaginateOtherGroup($userId);
        return view('member.group.group-list', compact('groups', 'otherGroups'));
    }

    public function getVideoOfGroup($userId, $groupId)
    {
        $groupVideos = $this->videoService->getPaginateVideoOfGroup($groupId);
        return view('member.group.video-list', compact('groupVideos'));
    }

    public function showVideo($userId, $videoId)
    {
        $video = $this->videoService->getById($videoId);
        $recommendedVideos = $this->videoService->getRecommendedMemberVideos();
        return view('public.show-video', compact('video', 'recommendedVideos'));
    }
}
