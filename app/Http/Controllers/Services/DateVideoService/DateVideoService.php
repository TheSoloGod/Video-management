<?php


namespace App\Http\Controllers\Services\DateVideoService;


use App\Http\Controllers\Repositories\DateVideoRepository\DateVideoRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class DateVideoService implements DateVideoServiceInterface
{
    protected $dateVideoRepository;

    public function __construct(DateVideoRepositoryInterface $dateVideoRepository)
    {
        $this->dateVideoRepository = $dateVideoRepository;
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
        $today = Carbon::now()->toDateString();
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
}
