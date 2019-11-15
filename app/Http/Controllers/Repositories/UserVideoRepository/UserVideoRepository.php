<?php


namespace App\Http\Controllers\Repositories\UserVideoRepository;


use App\Http\Controllers\Repositories\Eloquent\EloquentRepository;
use App\Models\UserVideo;
//use App\UserVideo;

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
