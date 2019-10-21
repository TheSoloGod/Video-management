<?php


namespace App\Http\Controllers\Repositories\CategoryVideoRepository;


use App\CategoryVideo;
use App\Http\Controllers\Repositories\Eloquent\EloquentRepository;

class CategoryVideoRepository extends EloquentRepository implements CategoryVideoRepositoryInterface
{

    public function getModel()
    {
        return CategoryVideo::class;
    }
}
