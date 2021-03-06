<?php

namespace App\Http\Controllers\Frontend\Member;

use App\Http\Controllers\Controller;
use App\Services\CategoryService\CategoryServiceInterface;
use App\Services\DateVideoService\DateVideoServiceInterface;
use App\Services\GroupService\GroupServiceInterface;
use App\Services\UserService\UserServiceInterface;
use App\Services\UserVideoService\UserVideoService;
use App\Services\VideoService\VideoServiceInterface;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    protected $videoService;
    protected $groupService;
    protected $userService;
    protected $categoryService;
    protected $dateVideoService;
    protected $userVideoService;

    public function __construct(VideoServiceInterface $videoService,
                                GroupServiceInterface $groupService,
                                UserServiceInterface $userService,
                                CategoryServiceInterface $categoryService,
                                DateVideoServiceInterface $dateVideoService,
                                UserVideoService $userVideoService)
    {
        $this->videoService = $videoService;
        $this->groupService = $groupService;
        $this->userService = $userService;
        $this->categoryService = $categoryService;
        $this->dateVideoService = $dateVideoService;
        $this->userVideoService = $userVideoService;
    }

    public function index()
    {
        $memberVideos = $this->videoService->getPaginateAllVideoMember();
        $allVideos = $this->videoService->getPaginateVideoDisplayShow();
        $categories = $this->categoryService->getAll();
        return view('front_end.member.home', compact('memberVideos', 'allVideos', 'categories'));
    }

    public function getGroup($userId)
    {
        $groups = $this->groupService->getPaginateGroupMember($userId);
        $otherGroups = $this->groupService->getPaginateOtherGroup($userId);
        $categories = $this->categoryService->getAll();
        return view('front_end.member.group.group-list', compact('groups', 'otherGroups', 'categories'));
    }

    public function getVideoOfGroup($userId, $groupId)
    {
        $groupVideos = $this->videoService->getPaginateVideoOfGroup($groupId);
        $group = $this->groupService->getById($groupId);
        $members = $this->userService->getUserOfGroup($groupId);
        $categories = $this->categoryService->getAll();
        return view('front_end.member.group.video-list', compact('groupVideos', 'group', 'members', 'categories'));
    }

    public function showVideo($userId, $videoId)
    {
        $this->dateVideoService->incrementVideoView($videoId);
        $video = $this->videoService->getById($videoId);
        $recommendedVideos = $this->videoService->getRecommendedMemberVideos();
        $categories = $this->categoryService->getAll();
        $favoriteStatus = $this->userVideoService->checkFavorited($userId, $videoId);
        return view('front_end.public.show-video', compact('video', 'recommendedVideos', 'categories', 'favoriteStatus'));
    }

    public function info($userId)
    {
        $user = $this->userService->getById($userId);
        $groups = $this->groupService->getAllGroupOfUser($userId);
        $categories = $this->categoryService->getAll();
        return view('front_end.member.user.info', compact('user', 'groups', 'categories'));
    }

    public function favorite(Request $request)
    {
        $status = $this->userVideoService->favorite($request);
        $data = ['status' => $status];
        return $data;
    }

    public function getPaginateVideoFavorite($userId)
    {
        $videos = $this->videoService->getPaginateVideoFavorite($userId);
        $categories = $this->categoryService->getAll();
        return view('front_end.member.favorite.video-favorite', compact('videos', 'categories'));
    }

    public function showVideoFavorite($userId, $videoId)
    {
        $video = $this->videoService->getById($videoId);
        return $video;
    }

    public function showVideoInGroup($userId, $groupId, $videoId)
    {
        $this->dateVideoService->incrementVideoView($videoId);
        $video = $this->videoService->getById($videoId);
        $recommendedVideos = $this->videoService->getRecommendedMemberVideos();
        $categories = $this->categoryService->getAll();
        $favoriteStatus = $this->userVideoService->checkFavorited($userId, $videoId);
        return view('front_end.public.show-video', compact('video', 'recommendedVideos', 'categories', 'favoriteStatus'));
    }
}
