<?php


namespace App\Repositories\UserVideoRepository;


use App\Repositories\Eloquent\EloquentRepository;
use App\Models\UserVideo;

class UserVideoRepository extends EloquentRepository implements UserVideoRepositoryInterface
{

    public function getModel()
    {
        return UserVideo::class;
    }

    public function getFavorite($userId, $videoId)
    {
        $favorite = $this->model->where('user_id', $userId)
                                ->where('video_id', $videoId)
                                ->first();
        return $favorite;
    }
}
