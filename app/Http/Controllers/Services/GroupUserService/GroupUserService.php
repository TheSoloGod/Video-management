<?php


namespace App\Http\Controllers\Services\GroupUserService;


use App\Http\Controllers\Repositories\GroupUserRepository\GroupUserRepositoryInterface;
use App\Http\Controllers\Repositories\UserRepository\UserRepositoryInterface;
use App\Http\Controllers\Services\UserService\UserServiceInterface;
use App\InvitationList;
use App\Services\SessionService;
use Illuminate\Support\Facades\Session;
use App\Jobs\SendInviteEmail;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Str;
use App\Mail\EmailInvite;
use Illuminate\Support\Facades\Mail;

class GroupUserService implements GroupUserServiceInterface
{
    use DispatchesJobs;

    protected $groupUserRepository;
    protected $userService;
    protected $userRepository;
    protected $sessionService;

    public function __construct(GroupUserRepositoryInterface $groupUserRepository,
                                UserServiceInterface $userService,
                                UserRepositoryInterface $userRepository,
                                SessionService $sessionService)
    {
        $this->groupUserRepository = $groupUserRepository;
        $this->userService = $userService;
        $this->userRepository = $userRepository;
        $this->sessionService = $sessionService;
    }

    public function getAllMemberPaginate($groupId)
    {
        $number = 5;
        $members = $this->groupUserRepository->getAllMemberPaginate($groupId, $number);
        return $members;
    }

    public function removeMember($groupId, $userId)
    {
        $this->groupUserRepository->removeMember($groupId, $userId);
        $groups = $this->groupUserRepository->getAllGroup($userId);
        if (count($groups) == 0) {
            $this->unmarkUserInGroup($userId);
        }
        Session::flash('status', 'Remove member success');
    }

    public function getUserNotInGroup($groupId)
    {
        $number = 5;
        $users = $this->userService->getUserNotInGroup($groupId, $number);
        return $users;
    }

    public function addUserToInvitationList($groupId, $userId)
    {
        if (session()->has('invitationList')) {
            $oldInvitationList = Session::get('invitationList');
        } else {
            $oldInvitationList = null;
        }
        $user = $this->userService->getById($userId);
        $invitationList = new InvitationList($oldInvitationList);
        $invitationList->addUserToInvitationList($groupId, $user);

        session()->put('invitationList', $invitationList);
        session()->flash('status', 'Add user to invitation list success');
    }

    public function removeUserFromInvitationList($groupId, $userId)
    {
        if (Session::has('invitationList')) {
            $oldInvitationList = Session::get('invitationList');
            if (count($oldInvitationList->users) > 1) {
                $invitationList = new InvitationList($oldInvitationList);
                $invitationList->removeUserFromInvitationList($userId);
                Session::put('invitationList', $invitationList);
                Session::flash('status', 'Remove user from invitation list success');
                return true;
            } else {
                Session::forget('invitationList');
                return false;
            }
        } else {
            return false;
        }
    }

    public function inviteUser($groupId)
    {
        $arrayUserToInvite = Session::get('invitationList')->users;
        foreach ($arrayUserToInvite as $key => $value) {
            $token = Str::random(10);
            $this->dispatch(new SendInviteEmail($value->email, $groupId, $value->id, $token));

            $data = [];
            $data['user_id'] = $value->id;
            $data['group_id'] = $groupId;
            $data['token'] = $token;
            $this->groupUserRepository->create($data);
        }
        $this->sessionService->forgetSession('invitationList');
        Session::flash('status', 'Send invitation mail success');
    }

    public function verifyInvitationEmail($groupId, $userId, $token)
    {
        $tokenDB = $this->groupUserRepository->getToken($groupId, $userId)->token;
        if ($tokenDB == $token) {
            $this->groupUserRepository->verifyMember($groupId, $userId);
            $this->markUserInGroup($userId);
            return true;
        } else {
            return false;
        }
    }

    public function getInvitedUser($groupId)
    {
        $number = 5;
        $users = $this->groupUserRepository->getInvitedUser($groupId, $number);
        return $users;
    }

    public function countMember($groupId)
    {
        $members = $this->groupUserRepository->getAllMember($groupId);
        $totalMembers = count($members);
        return $totalMembers;
    }

    public function getAllGroup($userId)
    {
        $groups = $this->groupUserRepository->getAllGroup($userId);
        return $groups;
    }

    public function getByUserGroupId($userId, $groupId)
    {
        $groupUser = $this->groupUserRepository->getByUserGroupId($userId, $groupId);
        return $groupUser;
    }

    public function markUserInGroup($userId)
    {
        $this->userRepository->markUserInGroup($userId);
    }

    public function unmarkUserInGroup($userId)
    {
        $this->userRepository->unmarkUserInGroup($userId);
    }
}
