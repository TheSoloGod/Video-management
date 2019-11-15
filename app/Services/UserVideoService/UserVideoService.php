<?php


namespace App\Services\UserVideoService;


use App\Repositories\UserVideoRepository\UserVideoRepositoryInterface;
use App\Repositories\VideoRepository\VideoRepositoryInterface;

class UserVideoService implements UserVideoServiceInterface
{
    protected $userVideoRepository;
    protected $videoRepository;

    public function __construct(UserVideoRepositoryInterface $userVideoRepository,
                                VideoRepositoryInterface $videoRepository)
    {
        $this->userVideoRepository = $userVideoRepository;
        $this->videoRepository = $videoRepository;
    }

    public function favorite($request)
    {
        $userId = $request->user_id;
        $videoId = $request->video_id;
        if (!$this->checkFavorited($userId, $videoId)) {
            $this->createFavorite($request);
            $this->incrementVideoTotalFavorite($videoId);
            return true;
        } else {
            return false;
        }
    }

    public function createFavorite($request)
    {
        $this->userVideoRepository->create($request->all());
    }

    public function checkFavorited($userId, $videoId)
    {
        $favorite = $this->userVideoRepository->getFavorite($userId, $videoId);
        if ($favorite == null) {
            return false;
        } else {
            return true;
        }
    }

    public function incrementVideoTotalFavorite($videoId)
    {
        $this->videoRepository->incrementVideoTotalFavorite($videoId);
    }
}
