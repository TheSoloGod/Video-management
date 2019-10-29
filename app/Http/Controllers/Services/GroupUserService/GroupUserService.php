<?php


namespace App\Http\Controllers\Services\GroupUserService;


use App\Http\Controllers\Repositories\GroupUserRepository\GroupUserRepositoryInterface;
use Illuminate\Support\Facades\Session;

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

    public function getUserIdOutOfGroup($groupId, $number)
    {
        $users =  $this->groupUserRepository->getUserIdOutOfGroup($groupId, $number);
        return $users;
    }

    public function addUserToInvitationList($userId)
    {
        if(session()->has('invitationList')){
            $oldInvitationList = Session::get('invitationList');
        }else{
            $oldInvitationList = null;
        }

        //viet tiep class invitation list
    }
}
