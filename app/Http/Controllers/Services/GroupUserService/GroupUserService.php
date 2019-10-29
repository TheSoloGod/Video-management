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

    public function getAllMember($groupId, $number)
    {
        $members = $this->groupUserRepository->getAllMember($groupId, $number);
        return $members;
    }

    public function removeMember($groupId, $userId)
    {
        $this->groupUserRepository->removeMember($groupId, $userId);
    }
}
