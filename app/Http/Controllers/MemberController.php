<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\CategoryService\CategoryServiceInterface;
use App\Http\Controllers\Services\DateVideoService\DateVideoServiceInterface;
use App\Http\Controllers\Services\GroupService\GroupServiceInterface;
use App\Http\Controllers\Services\UserService\UserServiceInterface;
use App\Http\Controllers\Services\VideoService\VideoServiceInterface;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    protected $videoService;
    protected $groupService;
    protected $userService;
    protected $categoryService;
    protected $dateVideoService;

    public function __construct(VideoServiceInterface $videoService,
                                GroupServiceInterface $groupService,
                                UserServiceInterface $userService,
                                CategoryServiceInterface $categoryService,
                                DateVideoServiceInterface $dateVideoService)
    {
        $this->videoService = $videoService;
        $this->groupService = $groupService;
        $this->userService = $userService;
        $this->categoryService = $categoryService;
        $this->dateVideoService = $dateVideoService;
    }

    public function index()
    {
        $memberVideos = $this->videoService->getPaginateAllVideoMember();
        $allVideos = $this->videoService->getPaginateVideoDisplayShow();
        $categories = $this->categoryService->getAll();
        return view('home', compact('memberVideos', 'allVideos', 'categories'));
    }

    public function getGroup($userId)
    {
        $groups = $this->groupService->getPaginateGroupMember($userId);
        $otherGroups = $this->groupService->getPaginateOtherGroup($userId);
        $categories = $this->categoryService->getAll();
        return view('member.group.group-list', compact('groups', 'otherGroups', 'categories'));
    }

    public function getVideoOfGroup($userId, $groupId)
    {
        $groupVideos = $this->videoService->getPaginateVideoOfGroup($groupId);
        $group = $this->groupService->getById($groupId);
        $members = $this->userService->getUserOfGroup($groupId);
        $categories = $this->categoryService->getAll();
        return view('member.group.video-list', compact('groupVideos','group', 'members', 'categories'));
    }

    public function showVideo($userId, $videoId)
    {
        $this->dateVideoService->incrementVideoView($videoId);
        $video = $this->videoService->getById($videoId);
        $recommendedVideos = $this->videoService->getRecommendedMemberVideos();
        $categories = $this->categoryService->getAll();
        return view('public.show-video', compact('video', 'recommendedVideos', 'categories'));
    }

    public function info($userId)
    {
        $user = $this->userService->getById($userId);
        $groups = $this->groupService->getAllGroupOfUser($userId);
        $categories = $this->categoryService->getAll();
        return view('member.info', compact('user', 'groups', 'categories'));
    }
}
