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

    public function incrementVideoView($date, $videoId)
    {
        $this->model->where('date', $date)
                    ->where('video_id', $videoId)
                    ->increment('today_views');
    }

    public function updateViewRate($date, $videoId, $viewRate)
    {
        $this->model->where('date', $date)
                    ->where('video_id', $videoId)
                    ->update([
                        'view_rate' => $viewRate
                    ]);
    }

    public function getByDateVideoId($date, $videoId)
    {
        $viewDateVideo = $this->model->where('date', $date)
                                     ->where('video_id', $videoId)
                                     ->first();
        return $viewDateVideo;
    }

    public function createNewViewDateVideo($date, $videoId, $yesterdayViews)
    {
        $viewDateVideo = new DateVideo();
        $viewDateVideo->date = $date;
        $viewDateVideo->video_id = $videoId;
        $viewDateVideo->today_views = 0;
        $viewDateVideo->yesterday_views = $yesterdayViews;
        $viewDateVideo->save();
    }

    public function getByDate($date)
    {
        $viewDate = $this->model->where('date', $date)
                                ->get();
        return $viewDate;
    }
}
