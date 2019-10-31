<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\GroupUserService\GroupUserServiceInterface;
use Illuminate\Http\Request;

class GroupUserController extends Controller
{
    protected $groupUserService;

    public function __construct(GroupUserServiceInterface $groupUserService)
    {
        $this->groupUserService = $groupUserService;
    }

    public function index($groupId)
    {
        $members = $this->groupUserService->getAllMember($groupId, 5);
        return view('admin.group..member.member-management', compact('members', 'groupId'));
    }

    public function removeMember($groupId, $userId)
    {
        $this->groupUserService->removeMember($groupId, $userId);
        return redirect()->back()->with('status', 'Remove member sucess');
    }

    public function addMember($groupId)
    {
        $users = $this->groupUserService->getUserNotInGroup($groupId, 5);
        return view('admin.group.member.add-member', compact('groupId', 'users'));
    }

    public function showInvitationList($groupId)
    {
        return view('admin.group.member.invitation-list', compact('groupId'));
    }

    public function addUserToInvitationList($groupId, $userId)
    {
        $this->groupUserService->addUserToInvitationList($groupId, $userId);
        return redirect()->back();
    }

    public function removeUserFromInvitationList($groupId, $userId)
    {
        $hasInvitationList = $this->groupUserService->removeUserFromInvitationList($groupId, $userId);
        if ($hasInvitationList) {
            return redirect()->back();
        } else {
            return redirect()->route('group.member.add', compact('groupId'));
        }
    }

    public function inviteUser($groupId, $userId)
    {
        $this->groupUserService->inviteUser($groupId, $userId);
        return redirect()->back()->with('status', 'OK');
    }

    public function verifyInvitationEmail($groupId, $userId, $token)
    {
        $verifyResult = $this->groupUserService->verifyInvitationEmail($groupId, $userId, $token);
        if ($verifyResult) {
            dd('dieu huong den trang loi token');
        } else {
            dd(' dieu huong den trang front end group');
        }
    }
}
