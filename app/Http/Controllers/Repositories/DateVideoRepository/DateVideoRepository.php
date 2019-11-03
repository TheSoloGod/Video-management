<?php


namespace App\Http\Controllers\Repositories\DateVideoRepository;


use App\DateVideo;
use App\Http\Controllers\Repositories\Eloquent\EloquentRepository;

class DateVideoRepository extends EloquentRepository implements DateVideoRepositoryInterface
{
    public function getModel()
    {
        return DateVideo::class;
    }

    public function getVideoView($date, $number)
    {
        $videos = $this->model->where('date', $date)
                              ->orderBy('created_at', 'desc')
                              ->paginate($number);
        return $videos;
    }
}
