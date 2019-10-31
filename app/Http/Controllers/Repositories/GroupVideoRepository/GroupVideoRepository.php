<?php


namespace App\Http\Controllers\Repositories\GroupVideoRepository;


use App\GroupVideo;
use App\Http\Controllers\Repositories\Eloquent\EloquentRepository;

class GroupVideoRepository extends EloquentRepository implements GroupVideoRepositoryInterface
{

    public function getModel()
    {
        return GroupVideo::class;
    }

    public function getAllVideo($groupId, $number)
    {
        $videos = $this->model->where('group_id', $groupId)
                              ->paginate($number);
        return $videos;
    }

    public function removeVideo($groupId, $videoId)
    {
        $this->model->where('group_id', $groupId)
                    ->where('video_id', $videoId)
                    ->delete();
    }
}
