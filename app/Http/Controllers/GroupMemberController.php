<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\GroupUserService\GroupUserServiceInterface;
use Illuminate\Http\Request;

class GroupMemberController extends Controller
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
        $users = $this->groupMemberService->getUserIdOutOfGroup($groupId, 5);
        return view('admin.group.member.add-member', compact('users'));
    }

    public function addUserToInvitationList($userId)
    {
        $this->groupMemberService->addUserToInvitationList($userId);
    }
}
