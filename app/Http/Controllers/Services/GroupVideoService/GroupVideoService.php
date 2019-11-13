<?php


namespace App\Http\Controllers\Services\GroupVideoService;


use App\AdditionVideoList;
use App\Http\Controllers\Repositories\GroupUserRepository\GroupUserRepositoryInterface;
use App\Http\Controllers\Repositories\GroupVideoRepository\GroupVideoRepositoryInterface;
use App\Http\Controllers\Repositories\VideoRepository\VideoRepositoryInterface;
use App\Notifications\NewVideoInGroup;
use App\Services\SessionService;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class GroupVideoService implements GroupVideoServiceInterface
{
    protected $groupVideoRepository;
    protected $groupUserRepository;
    protected $videoRepository;
    protected $sessionService;

    public function __construct(GroupVideoRepositoryInterface $groupVideoRepository,
                                GroupUserRepositoryInterface $groupUserRepository,
                                VideoRepositoryInterface $videoRepository,
                                SessionService $sessionService)
    {
        $this->groupVideoRepository = $groupVideoRepository;
        $this->groupUserRepository = $groupUserRepository;
        $this->videoRepository = $videoRepository;
        $this->sessionService = $sessionService;
    }

    public function getAllVideoPaginate($groupId)
    {
        $number = 4;
        $videos = $this->groupVideoRepository->getAllVideoPaginate($groupId, $number);
        return $videos;
    }

    public function removeVideo($groupId, $videoId)
    {
        $this->groupVideoRepository->removeVideo($groupId, $videoId);
        $groups = $this->groupVideoRepository->getAllGroup($videoId);
        if (count($groups) == 0) {
            $this->videoRepository->unmarkVideoInGroup($videoId);
        }
        Session::flash('status', 'Remove video success');
    }

    public function getVideoNotInGroup($groupId)
    {
        $number = 5;
        $users = $this->videoRepository->getPaginateVideoNotInGroup($groupId, $number);
        return $users;
    }

    public function addVideoToAdditionList($groupId, $videoId)
    {
        if (session()->has('additionVideoList')) {
            $oldAdditionVideoList = Session::get('additionVideoList');
        } else {
            $oldAdditionVideoList = null;
        }
        $user = $this->videoRepository->getById($videoId);
        $additionVideoList = new AdditionVideoList($oldAdditionVideoList);
        $additionVideoList->addVideoToAdditionVideoList($groupId, $user);

        session()->put('additionVideoList', $additionVideoList);
        session()->flash('status', 'Add video to addition video list success');
    }

    public function removeVideoFromAdditionList($groupId, $videoId)
    {
        if (Session::has('additionVideoList')) {
            $oldAdditionVideoList = Session::get('additionVideoList');
            if (count($oldAdditionVideoList->videos) > 1) {
                $additionVideoList = new AdditionVideoList($oldAdditionVideoList);
                $additionVideoList->removeVideoFromAdditionVideoList($videoId);
                Session::put('additionVideoList', $additionVideoList);
                Session::flash('status', 'Remove video from addition video list success');
                return true;
            } else {
                Session::forget('additionVideoList');
                return false;
            }
        } else {
            return false;
        }
    }

    public function addVideoConfirm($groupId)
    {
        $arrayVideoToAdd = Session::get('additionVideoList')->videos;
        foreach ($arrayVideoToAdd as $key => $value) {
            $data = [];
            $data['group_id'] = $groupId;
            $data['video_id'] = $value->id;
            $this->groupVideoRepository->create($data);
        }
        $this->sessionService->forgetSession('additionVideoList');
        Session::flash('status', 'Add video to group success');
    }

    public function countVideo($groupId)
    {
        $videos = $this->groupVideoRepository->getAllVideo($groupId);
        $totalVideos = count($videos);
        return $totalVideos;
    }

    public function getAllGroup($videoId)
    {
        $groups = $this->groupVideoRepository->getAllGroup($videoId);
        return $groups;
    }

    public function sendNotificationToUsers($groupId)
    {
        $userGroups = $this->groupUserRepository->getAllMember($groupId);
        foreach ($userGroups as $key => $value) {
            Notification::send($value->user, new NewVideoInGroup($groupId));
        }
    }

    public function getByGroupVideoId($videoId, $groupId)
    {
        $groupVideo = $this->groupVideoRepository->getByGroupVideoId($videoId, $groupId);
        return $groupVideo;
    }
}
