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

    public function showAllMember($groupId)
    {
        $invited = false;
        $members = $this->groupUserService->getAllMemberPaginate($groupId);
        return view('admin.group..member.member-management', compact('members', 'groupId', 'invited'));
    }

    public function removeMember($groupId, $userId)
    {
        $this->groupUserService->removeMember($groupId, $userId);
        return redirect()->back();
    }

    public function addMember($groupId)
    {
        $users = $this->groupUserService->getUserNotInGroup($groupId);
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

    public function inviteUser($groupId)
    {
        $this->groupUserService->inviteUser($groupId);
        return redirect()->back();
    }

    public function verifyInvitationEmail($groupId, $userId, $token)
    {
        $verifyResult = $this->groupUserService->verifyInvitationEmail($groupId, $userId, $token);
        if ($verifyResult) {
            return redirect()->route('member.group.video.all', [$userId, $groupId]);
        } else {
            return redirect()->route('home.member.index', compact('userId'));
        }
    }

    public function showInvitedUser($groupId)
    {
        $invited = true;
        $members = $this->groupUserService->getInvitedUser($groupId);
        return view('admin.group.member.member-management', compact('members', 'groupId', 'invited'));
    }
}
