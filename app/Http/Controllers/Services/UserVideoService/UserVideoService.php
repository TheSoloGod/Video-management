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
}
