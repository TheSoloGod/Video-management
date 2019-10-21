<?php


namespace App\Http\Controllers\Services\GroupVideoService;


use App\Http\Controllers\Repositories\GroupVideoRepository\GroupVideoRepositoryInterface;

class GroupVideoService implements GroupVideoServiceInterface
{
    protected $groupVideoRepository;

    public function __construct(GroupVideoRepositoryInterface $groupVideoRepository)
    {
        $this->groupVideoRepository = $groupVideoRepository;
    }
}
