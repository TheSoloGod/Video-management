<?php


namespace App\Http\Controllers\Services\UserVideoService;


use App\Http\Controllers\Repositories\UserVideoRepository\UserVideoRepositoryInterface;

class UserVideoService implements UserVideoServiceInterface
{
    protected $userVideoRepository;

    public function __construct(UserVideoRepositoryInterface $userVideoRepository)
    {
        $this->userVideoRepository = $userVideoRepository;
    }

    public function favorite($request)
    {
        $userId = $request->user_id;
        $videoId = $request->video_id;
        if (!$this->checkFavorited($userId, $videoId)) {
            $this->createFavorite($request);
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
}
