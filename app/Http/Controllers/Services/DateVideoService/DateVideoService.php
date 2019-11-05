<?php


namespace App\Http\Controllers\Services\DateVideoService;


use App\DateVideo;
use App\Http\Controllers\Repositories\DateVideoRepository\DateVideoRepositoryInterface;
use App\Http\Controllers\Repositories\VideoRepository\VideoRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class DateVideoService implements DateVideoServiceInterface
{
    protected $dateVideoRepository;
    protected $videoRepository;

    public function __construct(DateVideoRepositoryInterface $dateVideoRepository,
                                VideoRepositoryInterface $videoRepository)
    {
        $this->dateVideoRepository = $dateVideoRepository;
        $this->videoRepository = $videoRepository;
    }

    public function getAllVideoViewHistory()
    {
        $number = 5;
        $allVideoViewHistory = $this->dateVideoRepository->paginate($number);
        return $allVideoViewHistory;
    }

    public function checkHaveDateInRequest($request)
    {
        $date = $request->date;
        if ($date == null) {
            return false;
        } else {
            if ($this->checkFutureDateInRequest($date)) {
                return true;
            } else {
                Session::flash('error', 'Must choose a day before today');
                return false;
            }
        }
    }

    public function checkFutureDateInRequest($date)
    {
        $today = Carbon::today()->toDateString();
        if ($date <= $today) {
            return true;
        } else {
            return false;
        }
    }

    public function getResultSearchByDate($date)
    {
        $number = 5;
        $videos = $this->dateVideoRepository->getVideoView($date, $number);
        return $videos;
    }

    public function checkTodayViewExist($videoId)
    {
        $today = Carbon::today()->toDateString();
        $viewVideoToday = $this->dateVideoRepository->getByDateVideoId($today, $videoId);
        if ($viewVideoToday == null) {
            return false;
        } else {
            return true;
        }
    }

    public function getYesterdayViews($videoId)
    {
        $yesterday = Carbon::yesterday()->toDateString();
        $videoYesterday = $this->dateVideoRepository->getByDateVideoId($yesterday, $videoId);
        if ($videoYesterday == null) {
            return $yesterdayViews = 0;
        } else {
            return $yesterdayViews = $videoYesterday->today_views;
        }
    }

    public function incrementVideoView($videoId)
    {
        $today = Carbon::today()->toDateString();
        if (!$this->checkTodayViewExist($videoId)) {
            $yesterdayViews = $this->getYesterdayViews($videoId);
            $this->dateVideoRepository->createNewViewDateVideo($today, $videoId, $yesterdayViews);
        }

        //check session has video key exist? Only increment view when video key not exist!
        $videoKey = 'video-' . $videoId;
        if (!Session::has($videoKey)) {
            $this->dateVideoRepository->incrementVideoView($today, $videoId);
            $this->videoRepository->incrementVideoTotalView($videoId);
            $this->updateViewRate($today, $videoId);
            Session::put($videoKey, 1);
        }

    }

    public function calculateViewRate($date, $videoId)
    {
        $viewDateVideo = $this->dateVideoRepository->getByDateVideoId($date, $videoId);
        if ($viewDateVideo->yesterday_views == 0) {
            return $viewRate = 'have no view of the day before this day';
        } else {
            return $viewRate = round(($viewDateVideo->today_views - $viewDateVideo->yesterday_views) / $viewDateVideo->yesterday_views * 100) . '%';
        }
    }

    public function updateViewRate($date, $videoId)
    {
        $viewRate = $this->calculateViewRate($date, $videoId);
        $this->dateVideoRepository->updateViewRate($date, $videoId, $viewRate);
    }
}
