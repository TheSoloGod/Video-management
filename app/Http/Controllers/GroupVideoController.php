<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\GroupVideoService\GroupVideoServiceInterface;
use Illuminate\Http\Request;

class GroupVideoController extends Controller
{
    protected $groupVideoService;

    public function __construct(GroupVideoServiceInterface $groupVideoService)
    {
        $this->groupVideoService = $groupVideoService;
    }

    public function showAllVideo($groupId)
    {
        $videos = $this->groupVideoService->getAllVideoPaginate($groupId);
        return view('admin.group.video.video-management', compact('videos', 'groupId'));
    }

    public function removeVideo($groupId, $videoId)
    {
        $this->groupVideoService->removeVideo($groupId, $videoId);
        return redirect()->back();
    }

    public function addVideo($groupId)
    {
        $videos = $this->groupVideoService->getVideoNotInGroup($groupId);
        return view('admin.group.video.add-video', compact('groupId', 'videos'));
    }

    public function showAdditionVideoList($groupId)
    {
        return view('admin.group.video.addition-list', compact('groupId'));
    }

    public function addVideoToAdditionList($groupId, $videoId)
    {
        $this->groupVideoService->addVideoToAdditionList($groupId, $videoId);
        return redirect()->back();
    }

    public function removeVideoFromAdditionList($groupId, $videoId)
    {
        $hasAdditionVideoList = $this->groupVideoService->removeVideoFromAdditionList($groupId, $videoId);
        if ($hasAdditionVideoList) {
            return redirect()->back();
        } else {
            return redirect()->route('group.video.add', compact('groupId'));
        }
    }

    public function addVideoConfirm($groupId)
    {
        $this->groupVideoService->addVideoConfirm($groupId);
        // send noti to users
        $this->groupVideoService->sendNotificationToUsers($groupId);
        return redirect()->back();
    }
}
