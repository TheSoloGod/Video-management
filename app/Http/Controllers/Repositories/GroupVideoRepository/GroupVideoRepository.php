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
}
