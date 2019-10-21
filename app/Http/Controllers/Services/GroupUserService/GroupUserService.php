<?php


namespace App\Http\Controllers\Services\GroupUserService;


use App\Http\Controllers\Repositories\GroupUserRepository\GroupUserRepositoryInterface;

class GroupUserService implements GroupUserServiceInterface
{
    protected $groupUserRepository;

    public function __construct(GroupUserRepositoryInterface $groupUserRepository)
    {
        $this->groupUserRepository = $groupUserRepository;
    }
}
