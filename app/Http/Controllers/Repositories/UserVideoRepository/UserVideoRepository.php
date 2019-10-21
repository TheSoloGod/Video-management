<?php


namespace App\Http\Controllers\Repositories\UserVideoRepository;


use App\Http\Controllers\Repositories\Eloquent\EloquentRepository;
use App\UserVideo;

class UserVideoRepository extends EloquentRepository implements UserVideoRepositoryInterface
{

    public function getModel()
    {
        return UserVideo::class;
    }
}
