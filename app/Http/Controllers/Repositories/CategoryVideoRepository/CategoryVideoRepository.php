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

    public function getAllCategory($videoId)
    {
        $categories = $this->model->where('video_id', $videoId)
                                  ->get();
        return $categories;
    }

    public function getAllVideo($categoryId)
    {
        $videos = $this->model->where('category_id', $categoryId)
                              ->get();
        return $videos;
    }
}
