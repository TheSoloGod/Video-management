<?php

namespace App\Http\Controllers\Backend\GroupVideo;

use App\Http\Controllers\Controller;
use App\Services\GroupVideoService\GroupVideoServiceInterface;
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
        return view('back_end.group.video.video-management', compact('videos', 'groupId'));
    }

    public function removeVideo($groupId, $videoId)
    {
        $this->groupVideoService->removeVideo($groupId, $videoId);
        return redirect()->back();
    }

    public function addVideo($groupId)
    {
        $videos = $this->groupVideoService->getVideoNotInGroup($groupId);
        return view('back_end.group.video.add-video', compact('groupId', 'videos'));
    }

    public function showAdditionVideoList($groupId)
    {
        return view('back_end.group.video.addition-list', compact('groupId'));
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
        $this->groupVideoService->sendNotificationToUsers($groupId);
        return redirect()->back();
    }
}
