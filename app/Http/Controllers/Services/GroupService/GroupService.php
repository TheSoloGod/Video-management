<?php


namespace App\Http\Controllers\Services\GroupService;

use App\Http\Controllers\Repositories\GroupRepository\GroupRepositoryInterface;

class GroupService implements GroupServiceInterface
{
    protected $groupRepository;

    public function __construct(GroupRepositoryInterface $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }
}
