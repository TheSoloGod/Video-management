<?php


namespace App\Http\Controllers\Services\GroupUserService;


use App\Http\Controllers\Repositories\GroupUserRepository\GroupUserRepositoryInterface;
use App\Http\Controllers\Services\UserService\UserServiceInterface;
use App\InvitationList;
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

    public function __construct(GroupUserRepositoryInterface $groupUserRepository,
                                UserServiceInterface $userService)
    {
        $this->groupUserRepository = $groupUserRepository;
        $this->userService = $userService;
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

    public function getUserNotInGroup($groupId, $number)
    {
        $users =  $this->userService->getUserNotInGroup($groupId, $number);
        return $users;
    }

    public function addUserToInvitationList($groupId, $userId)
    {
        if(session()->has('invitationList')){
            $oldInvitationList = Session::get('invitationList');
        }else{
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
        if(Session::has('invitationList')){
            $oldInvitationList = Session::get('invitationList');
            if(count($oldInvitationList->users) > 1){
                $invitationList = new InvitationList($oldInvitationList);
                $invitationList->removeUserFromInvitationList($userId);
                Session::put('invitationList', $invitationList);
                Session::flash('status', 'Remove user from invitation list success');
                return true;
            }else{
                Session::forget('invitationList');
                return false;
            }
        }else{
            return false;
        }
    }

    public function inviteUser($groupId, $userId)
    {
//        $arrayUserToInvite = Session::get('invitationList')->users;
//        foreach ($arrayUserToInvite as $key => $value){
            $token = Str::random(10);
            $this->dispatch(new SendInviteEmail('testlaravel20@gmail.com', $groupId, $userId, $token));

            $data = [];
            $data['user_id'] = $userId;
            $data['group_id'] = $groupId;
            $data['token'] = $token;
            $this->groupUserRepository->create($data);
//        }
    }

    public function verifyInvitationEmail($groupId, $userId, $token)
    {
        $tokenDB = $this->groupUserRepository->getToken($groupId, $userId)->token;
        if ($tokenDB == $token){
            $this->groupUserRepository->verifyMember($groupId, $userId);
            return true;
        }else{
            return false;
        }
    }
}
