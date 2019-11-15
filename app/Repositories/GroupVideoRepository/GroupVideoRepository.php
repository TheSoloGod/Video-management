<?php


namespace App\Repositories\GroupVideoRepository;


use App\Models\GroupVideo;
use App\Repositories\Eloquent\EloquentRepository;

class GroupVideoRepository extends EloquentRepository implements GroupVideoRepositoryInterface
{

    public function getModel()
    {
        return GroupVideo::class;
    }

    public function getAllVideoPaginate($groupId, $number)
    {
        $videos = $this->model->where('group_id', $groupId)
                              ->paginate($number);
        return $videos;
    }

    public function getAllVideo($groupId)
    {
        $videos = $this->model->where('group_id', $groupId)
                              ->get();
        return $videos;
    }

    public function removeVideo($groupId, $videoId)
    {
        $this->model->where('group_id', $groupId)
                    ->where('video_id', $videoId)
                    ->delete();
    }

    public function getAllGroup($videoId)
    {
        $groups = $this->model->where('video_id', $videoId)
                              ->get();
        return $groups;
    }

    public function getByGroupVideoId($videoId, $groupId)
    {
        $groupVideo = $this->model->where('group_id', $groupId)
                                  ->where('video_id', $videoId)
                                  ->first();
        return $groupVideo;
    }
}
