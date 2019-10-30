<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\GroupUserService\GroupUserServiceInterface;
use Illuminate\Http\Request;

class GroupUserController extends Controller
{
    protected $groupMemberService;

    public function __construct(GroupUserServiceInterface $groupUserService)
    {
        $this->groupMemberService = $groupUserService;
    }

    public function index($groupId)
    {
        $members = $this->groupMemberService->getAllMember($groupId, 5);
        return view('admin.group..member.member-management', compact('members', 'groupId'));
    }

    public function removeMember($groupId, $userId)
    {
        $this->groupMemberService->removeMember($groupId, $userId);
        return redirect()->back()->with('status', 'Remove member sucess');
    }

    public function addMember($groupId)
    {
        $users = $this->groupMemberService->getUserNotInGroup($groupId, 5);
        return view('admin.group.member.add-member', compact('groupId', 'users'));
    }

    public function showInvitationList($groupId)
    {
        return view('admin.group.member.invitation-list', compact('groupId'));
    }

    public function addUserToInvitationList($groupId, $userId)
    {
        $this->groupMemberService->addUserToInvitationList($groupId, $userId);
        return redirect()->back();
    }

    public function removeUserFromInvitationList($groupId, $userId)
    {
        $hasInvitationList = $this->groupMemberService->removeUserFromInvitationList($groupId, $userId);
        if($hasInvitationList){
            return redirect()->back();
        }else{
            return redirect()->route('group.member.add', compact('groupId'));
        }
    }

    public function inviteUser($groupId)
    {
        $this->groupMemberService->inviteUser($groupId);
        return redirect()->back()->with('status', 'OK');
    }

    public function invite($groupId)
    {
        $this->groupMemberService->inviteUser($groupId);
    }
}
